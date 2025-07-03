<?php
require_once __DIR__ . '/config/langHelper.php';
if (isset($_GET['lang'])) {
  setLanguage($_GET['lang']); // Utilise la fonction setLangage()
}

// Redirige vers la page précédente ou `index.php` si aucune référence
header("Location: " . ($_SERVER['HTTP_REFERER'] ?? 'index.php'));
exit();
