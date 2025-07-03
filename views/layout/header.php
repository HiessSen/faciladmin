<?php
$lang = getLanguage();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($title) ? htmlspecialchars($title) : 'Mon Site' ?></title>
  <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>
  <header class="main_background">
    <img src="assets/img/icones/logo_facil_admin.jpg" alt="Logo du site Facil'Admin" class="logo">
    <nav>
      <ul>
        <li><a href="home">
            <?= $lang === 'fr' ? 'Accueil' : 'Home'?>
          </a></li>
        <li><a href="today">
            <?= $lang === 'fr' ? 'Actualités' : 'Today'?>
          </a></li>
        <li><a href="calendar">
            <?= $lang === 'fr' ? 'Calendrier' : 'Calendar'?>
          </a></li>
          <li class="menuParent">
            <a href="activities">
              <?= $lang === 'fr' ? 'Activités' : 'Activities'?>
            </a>
            <ul class="sousMenu">
                <li><a href="#">
                    <?= $lang === 'fr' ? 'Activité 1' : 'Activity 1'?>
                  </a></li>
                <li><a href="#">
                    <?= $lang === 'fr' ? 'Activité 2' : 'Activity 2'?>
                  </a></li>
                <li><a href="#">
                    <?= $lang === 'fr' ? 'Activité 3' : 'Activity 3'?>
                  </a></li>
            </ul>
          </li>
        <?php if (isset($_SESSION['user'])) : ?>
          <li><a href="<?= BASE_URL ?>/profile">
              <?= $lang === 'fr' ? 'Profil' : 'Profile'?>
            </a></li>
        <?php else : ?>
          <li><a href="<?= BASE_URL ?>/login">Connexion</a></li>
        <?php endif; ?>
      </ul>
      <?php
      if ($lang === 'fr'): ?>
        <a class="langue" href="?lang=eng"><img src="assets/img/icones/lang_eng.png" alt="English"></a>
      <?php else: ?>
        <a class="langue" href="?lang=fr"><img src="assets/img/icones/lang_fr.png" alt="Français"></a>
      <?php endif; ?>
    </nav>
  </header>