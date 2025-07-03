<?php
$lang = getLanguage();
?>
<?php
if (!isset($_SESSION['user'])) {
  header("Location: " . BASE_URL . "/login");
  exit();
}
$user = $_SESSION['user'];
//var_dump($user); DEBUGGAGE
?>
<section class="profileSection">
  <h3><?= htmlspecialchars($user['first_name']) . " " . htmlspecialchars($user['last_name']) ?></h3>
  <article>
    <h3><?= $lang === 'fr' ? 'Vous êtes connecté en tant que ' . $user['intitule_fr'] : 'You are connected as a ' . $user['intitule_eng'] ?></h3>
<!--    <h3>Vous êtes connecté en tant que --><?php //= htmlspecialchars($user['intitule_fr'])?><!--.</h3>-->
    <p>Email : <?= htmlspecialchars($user['email']) ?></p>
    <p><?= $lang === 'fr' ? 'Date d\'inscription : Le ' : 'Date of subscrption : ' ?><?= date('d/m/Y', strtotime($user['join_date'])) ?></p>
  </article>
  <h3><?= $lang === 'fr' ? 'Prochaines activités :' : 'Next activities'?></h3>
  <article>
    <p><?= $lang === 'fr' ? 'activité 1 : <span>Le 03/06/2025</span>' : 'activity 1 : <span>06/03/2025</span>'?></p>
    <p><?= $lang === 'fr' ? 'activité 2 : <span>Le 21/06/2025</span>' : 'activity 1 : <span>06/03/2025</span>'?></p>
    <p><?= $lang === 'fr' ? 'activité 3 : <span>Le 17/11/2025</span>' : 'activity 1 : <span>11/17/2025</span>'?></p>
  </article>
</section>
<a href="<?= BASE_URL ?>/logout">Se déconnecter</a>