<?php

// Ligne destinée à m'assurer que le dossier racine fait bien partie du chemin lorsque je traite des URL
const BASE_URL = "/projet_absence";

// Autoloader simple pour charger automatiquement les classes
spl_autoload_register(function($className) {
    $paths = [
        'controllers/',
        'models/',
        'core/'
    ];

    foreach ($paths as $path) {
        $file = $path . $className . '.php';
        if (file_exists($file)) {
            require_once $file;
            return;
        }
    }
});
?>