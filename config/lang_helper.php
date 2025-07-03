<?php
// Fonction qui permet de récuperer le contenu en fonction de la langue
function setLanguage($lang) {
  $_SESSION['lang'] = ($lang === 'eng') ? 'eng' : 'fr'; // Sécuriser le choix de la langue
}
function getLanguage() {
  return $_SESSION['lang'] ?? 'fr'; // Valeur par défaut : 'fr'
}
