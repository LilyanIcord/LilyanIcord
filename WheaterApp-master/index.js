const sqlite3 = require('sqlite3').verbose();
const fs = require('fs');
const express = require('express');
const app = express();
require('dotenv').config();

app.use((request, response, next) => {
    response.header('Access-Control-Allow-Origin', '*');
    response.header('Access-Control-Allow-Headers', 'Origin, X-Requested-With, Content-Type, Accept');
    response.header('Access-Control-Allow-Methods', 'GET, POST, OPTIONS');
    if (request.method === 'OPTIONS') {
        return response.sendStatus(200);
    }
    next();
});

app.use(express.static('public'));
app.use(express.json({limit:'1mb'}));

console.log(process.env.WEATHER_API_KEY);


const db = new sqlite3.Database('./weatherApp.db', (err)=>{
    if (err){
        console.log(err.message);
    }else{
        console.log('Connecté à la base de données SQLite')
    }
});

db.serialize(function() {
    let sql='CREATE TABLE IF NOT EXISTS geoloc(id INTEGER PRIMARY KEY, latitude TEXT NOT NULL, longitude TEXT NOT NULL, timestamp REAL NOT NULL, mood TEXT, city TEXT, country TEXT, condition TEXT, temperature TEXT, defra TEXT, pm25 TEXT)';
    db.run(sql,(err) =>{
        if (err){
            console.log(err.message)
        } else {
            console.log('Création de la table geoloc')
        }
    });
    

    const columnsToAdd = [
        {name: 'city', sql: 'ALTER TABLE geoloc ADD COLUMN city TEXT'},
        {name: 'country', sql: 'ALTER TABLE geoloc ADD COLUMN country TEXT'},
        {name: 'condition', sql: 'ALTER TABLE geoloc ADD COLUMN condition TEXT'},
        {name: 'temperature', sql: 'ALTER TABLE geoloc ADD COLUMN temperature TEXT'},
        {name: 'defra', sql: 'ALTER TABLE geoloc ADD COLUMN defra TEXT'},
        {name: 'pm25', sql: 'ALTER TABLE geoloc ADD COLUMN pm25 TEXT'}
    ];
    
    columnsToAdd.forEach(col => {
        db.run(col.sql, (err) => {
            if (err && !err.message.includes('duplicate column name')) {
                console.log(`Erreur lors de l'ajout de la colonne ${col.name}:`, err.message);
            }
        });
    });
});

function inserer(latitude, longitude, mood, date, city, country, condition, temperature, defra, pm25){
    db.serialize(function(){
        const stmt = db.prepare('INSERT INTO geoloc(latitude, longitude, mood, timestamp, city, country, condition, temperature, defra, pm25) VALUES (?,?,?,?,?,?,?,?,?,?)');
        stmt.run(latitude, longitude, mood, new Date(date).getTime(), city, country, condition, temperature, defra, pm25, function(err) {
            if (err) {
                console.log('Erreur INSERT geoloc:', err.message);
            } else {
                console.log(`Insert réussi. ID=${this.lastID}`);
            }
        });
        stmt.finalize((err)=>{
            if (err){
                console.log('Erreur finalize statement:', err.message);
            } else {
                console.log('Statement finalisé.');
            }
        });  
    });
}

function afficher(){
    db.serialize(function(){
        db.each("SELECT id, latitude, longitude, timestamp, mood, city, country, condition, temperature, defra, pm25 FROM geoloc", (err,row)=> {
            if (err) {
                console.log(err.message);
            } else {
                console.log(row.id + ". Lat: " + row.latitude + " Long: " + row.longitude + " Mood: " + row.mood + " City: " + row.city + " Country: " + row.country + " Temp: " + row.temperature + "°C Defra: " + row.defra + " PM2.5: " + row.pm25);
            }
        });
    });
}


app.post('/api', (request, response)=>{
    console.log('POST /api reçu');
    console.log('Payload:', request.body);

    const data = request.body;
    inserer(
        data.latitude, 
        data.longitude, 
        data.mood, 
        data.date || new Date().toISOString(),
        data.city,
        data.country,
        data.condition,
        data.temperature,
        data.defra,
        data.pm25
    );

    const result = {
        status: 'success',
        latitude: data.latitude,
        longitude: data.longitude,
        mood: data.mood,
        city: data.city,
        country: data.country,
        condition: data.condition,
        temperature: data.temperature,
        defra: data.defra,
        pm25: data.pm25,
        date: data.date
    };
    console.log('Réponse envoyée au client:', result);
    response.json(result);
});


app.get('/api', (request, response)=>{
    db.serialize(function(){
        db.all("SELECT id, latitude, longitude, timestamp, mood, city, country, condition, temperature, defra, pm25 FROM geoloc", (err, rows)=> {
            if (err) {
                console.log(err.message);
                response.json({status: 'error', message: err.message});
            } else {
                const formattedRows = rows.map(row => ({
                    id: row.id,
                    latitude: row.latitude,
                    longitude: row.longitude,
                    mood: row.mood,
                    city: row.city,
                    country: row.country,
                    condition: row.condition,
                    temperature: row.temperature,
                    defra: row.defra,
                    pm25: row.pm25,
                    date: new Date(row.timestamp).toISOString()
                }));
                response.json(formattedRows);
            }
        });
    });
});


app.get('/weather/:lat/:long', async (request, response) => {
    console.log('I got a GET request for /weather');
    console.log(request.params);
    const lat = request.params.lat;
    const long = request.params.long;
    try {
        const apiKey = process.env.WEATHER_API_KEY;
        if (!apiKey) {
            return response.status(500).json({
                status: "GET Error",
                message: "WEATHER_API_KEY manquante dans le fichier .env"
            });
        }

        const apiUrl = `https://api.weatherapi.com/v1/current.json?key=${apiKey}&q=${lat},${long}&aqi=yes`;
        const fetchResponse = await fetch(apiUrl);
        const json = await fetchResponse.json();
        if (!fetchResponse.ok || json.error) {
            return response.status(fetchResponse.status || 500).json({
                status: "GET Error",
                message: json?.error?.message || "Erreur lors de la récupération météo"
            });
        }

        response.json(json);
        console.log(json);
    } catch(error) {
        console.error('Erreur API WeatherApi:', error);
        return response.json({
            status: "GET Error",
            message: error.message
        });
    }
});

const PORT = 3000;

app.listen(PORT, () => {
    console.log(`Serveur lancé sur http://localhost:${PORT}`);
});
