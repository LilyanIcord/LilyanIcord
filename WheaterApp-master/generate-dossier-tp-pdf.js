/**
 * Génère un PDF portfolio : synthèse TP + extraits de code réels + figures (terminal / navigateur).
 * Dépendances : pdfkit (images PNG dans ./pdf-assets)
 * Lancer : node generate-dossier-tp-pdf.js
 */

const fs = require("fs");
const path = require("path");
const PDFDocument = require("pdfkit");

const ROOT = __dirname;
const ASSETS = path.join(ROOT, "pdf-assets");
const OUT_MAIN = path.join(ROOT, "Dossier_TP_WeatherApp_Portfolio.pdf");
const OUT_RECAP = path.join(ROOT, "Recap_Projet_WeatherApp_Portfolio.pdf");

const COURSE_PDFS = [
  "Intro NodeJs.pdf",
  "Programmation Javascript côté serveur avec NodeJs.pdf",
];

function readSnippet(relPath, maxChars = 3200) {
  const full = path.join(ROOT, relPath);
  if (!fs.existsSync(full)) return `[Fichier introuvable : ${relPath}]`;
  let s = fs.readFileSync(full, "utf8");
  if (s.length > maxChars) {
    s = s.slice(0, maxChars) + "\n\n[... extrait tronqué pour le PDF ...]";
  }
  return s;
}

function safeImage(doc, filename, opts = {}) {
  const p = path.join(ASSETS, filename);
  if (!fs.existsSync(p)) {
    doc.fontSize(10).fillColor("#b91c1c").text(`(Image absente : ${filename} — placez le fichier dans pdf-assets/)`, opts);
    doc.fillColor("#000000");
    return;
  }
  doc.image(p, {
    fit: opts.fit || [500, 260],
    align: "center",
  });
}

function heading(doc, text, level = 1) {
  if (doc.y > 720) doc.addPage();
  const size = level === 1 ? 16 : 13;
  doc.moveDown(level === 1 ? 0.8 : 0.5);
  doc.font("Helvetica-Bold").fontSize(size).fillColor("#0f172a").text(text);
  doc.font("Helvetica").fontSize(11).fillColor("#000000");
  doc.moveDown(0.35);
}

function body(doc, text) {
  if (doc.y > 760) doc.addPage();
  doc.font("Helvetica").fontSize(11).fillColor("#1f2937").text(text, {
    align: "justify",
    lineGap: 2,
  });
  doc.moveDown(0.4);
}

function codeBlock(doc, title, content) {
  if (doc.y > 620) doc.addPage();
  doc.font("Helvetica-Bold").fontSize(11).text(title);
  doc.moveDown(0.2);
  doc
    .font("Courier")
    .fontSize(7.5)
    .fillColor("#111827")
    .text(content, {
      width: 495,
      lineGap: 1,
      indent: 0,
    });
  doc.fillColor("#000000").font("Helvetica");
  doc.moveDown(0.6);
}

function buildPdf() {
  const doc = new PDFDocument({
    size: "A4",
    margins: { top: 50, bottom: 50, left: 48, right: 48 },
    info: {
      Title: "Dossier TP - WeatherApp (Node.js)",
      Author: "Portfolio",
    },
  });

  const streamMain = fs.createWriteStream(OUT_MAIN);
  doc.pipe(streamMain);

  // --- Page de garde
  doc.font("Helvetica-Bold").fontSize(22).fillColor("#0f172a");
  doc.text("Dossier de réalisation — TP Node.js", { align: "center" });
  doc.moveDown(0.3);
  doc.font("Helvetica").fontSize(14).fillColor("#334155");
  doc.text("Application météo, géolocalisation, API REST et SQLite", { align: "center" });
  doc.moveDown(1.2);
  doc.fontSize(11).fillColor("#475569");
  doc.text(`Projet : WeatherApp (Express + SQLite + WeatherAPI)`, { align: "center" });
  doc.text(`Généré le : ${new Date().toLocaleString("fr-FR")}`, { align: "center" });
  doc.moveDown(1);
  body(
    doc,
    "Ce document résume la mise en œuvre du travail pratique : collecte de la position, appel d’API météo, " +
      "persistance des relevés et consultation de l’historique. Les extraits de code proviennent directement des fichiers du dépôt."
  );
  body(
    doc,
    "Figures : des illustrations de type « capture d’écran » (terminal CMD et navigateur) sont incluses pour le portfolio. " +
      "Pour un rendu 100 % fidèle à votre machine, vous pouvez remplacer les fichiers PNG dans le dossier pdf-assets/ par vos propres captures."
  );

  doc.addPage();

  heading(doc, "1. Supports de cours (références du TP)", 1);
  body(
    doc,
    "Le TP s’inscrit dans le cadre des supports suivants (fichiers présents à la racine du projet) :"
  );
  COURSE_PDFS.forEach((name) => {
    doc.font("Helvetica-Bold").fontSize(11).text(`• ${name}`, { indent: 10 });
  });
  doc.moveDown(0.3);
  body(
    doc,
    "Thématiques typiquement couvertes par ces supports : environnement Node.js, modules CommonJS, npm, " +
      "création d’un serveur HTTP avec Express, routes GET/POST, middlewares, accès fichiers / variables d’environnement, " +
      "et introduction à la persistance (ici SQLite)."
  );

  heading(doc, "2. Périmètre fonctionnel du projet", 1);
  body(
    doc,
      "• Page index.html : géolocalisation navigateur, affichage météo (ville, pays, condition, température, qualité de l’air), saisie du mood, envoi au serveur.\n" +
      "• Route serveur /weather/:lat/:long : proxy vers WeatherAPI (clé dans .env).\n" +
      "• Route POST /api : enregistrement d’un relevé dans la table geoloc.\n" +
      "• Route GET /api : lecture de tous les enregistrements pour all.html.\n" +
      "• Page all.html : affichage sous forme de cartes Bootstrap."
  );

  heading(doc, "3. Figures — Terminal et interface", 1);
  doc.font("Helvetica-Oblique").fontSize(10).fillColor("#64748b");
  doc.text("Figure A — Démarrage du serveur (nodemon / logs de connexion SQLite).", { width: 500 });
  doc.fillColor("#000000").font("Helvetica");
  doc.moveDown(0.3);
  safeImage(doc, "cmd-nodemon.png");
  doc.moveDown(0.5);

  if (doc.y > 520) doc.addPage();
  doc.font("Helvetica-Oblique").fontSize(10).fillColor("#64748b");
  doc.text("Figure B — Exemple de journalisation lors d’un POST /api (insertion en base).", { width: 500 });
  doc.fillColor("#000000").font("Helvetica");
  doc.moveDown(0.3);
  safeImage(doc, "cmd-insert.png");
  doc.moveDown(0.5);

  if (doc.y > 480) doc.addPage();
  doc.font("Helvetica-Oblique").fontSize(10).fillColor("#64748b");
  doc.text("Figure C — Consultation de l’historique (page all.html).", { width: 500 });
  doc.fillColor("#000000").font("Helvetica");
  doc.moveDown(0.3);
  safeImage(doc, "navigateur-all.png");

  doc.addPage();

  heading(doc, "4. Extraits de code — index.js (serveur)", 1);
  codeBlock(doc, "Fichier : index.js (routes /api, /weather, SQLite)", readSnippet("index.js", 4500));

  heading(doc, "5. Extraits de code — public/index.html", 1);
  codeBlock(doc, "Fichier : public/index.html (UI + fetch météo / envoi)", readSnippet(path.join("public", "index.html"), 4200));

  heading(doc, "6. Extraits de code — public/all.html", 1);
  codeBlock(doc, "Fichier : public/all.html (chargement GET /api)", readSnippet(path.join("public", "all.html"), 3800));

  doc.addPage();
  heading(doc, "7. Lancer le projet (rappel)", 1);
  body(
    doc,
      "1) Installer les dépendances : npm install\n" +
      "2) Créer un fichier .env avec WEATHER_API_KEY=...\n" +
      "3) Démarrer : nodemon index.js (ou node index.js)\n" +
      "4) Ouvrir http://localhost:3000/index.html puis http://localhost:3000/all.html\n" +
      "5) Fichier nodemon.json : ignore weatherApp.db pour éviter des redémarrages intempestifs."
  );

  heading(doc, "8. Compétences mises en avant (portfolio)", 1);
  body(
    doc,
      "API REST, consommation d’API tierce, gestion d’erreurs, persistance SQLite, intégration front (Bootstrap + JS), " +
      "configuration par variables d’environnement, documentation technique."
  );

  doc.end();

  streamMain.on("finish", () => {
    console.log("PDF généré :", OUT_MAIN);
    try {
      fs.copyFileSync(OUT_MAIN, OUT_RECAP);
      console.log("Copie portfolio :", OUT_RECAP);
    } catch (e) {
      console.warn(
        "Impossible d'écraser Recap_Projet_WeatherApp_Portfolio.pdf (fermez-le dans le lecteur PDF puis relancez npm run pdf:dossier) :",
        e.message
      );
    }
  });
  streamMain.on("error", (e) => console.error("Erreur écriture PDF :", e.message));
}

buildPdf();
