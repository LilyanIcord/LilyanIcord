const api_url = 'https://api.wheretheiss.at/v1/satellites/25544';

const map = L.map('issMap').setView([0, 0], 2);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; OpenStreetMap contributors'
}).addTo(map);

const issIcon = L.icon({
    iconUrl: 'iss.png',
    iconSize: [50, 32],
    iconAnchor: [25, 16]
});

const marker = L.marker([0, 0], { icon: issIcon }).addTo(map);

async function GetISS() {
    const response = await fetch(api_url);
    const data = await response.json();

    const { latitude, longitude, altitude, velocity } = data;

    document.getElementById('lat').textContent = latitude.toFixed(2);
    document.getElementById('lon').textContent = longitude.toFixed(2);
    document.getElementById('alt').textContent = altitude.toFixed(2);
    document.getElementById('speed').textContent = velocity.toFixed(2);

    marker.setLatLng([latitude, longitude]);
    map.setView([latitude, longitude], 4);
}

GetISS();
setInterval(GetISS, 1000);
