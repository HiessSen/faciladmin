<?php
$lang = getLanguage();
?>
  <section>
    <h3><?= htmlspecialchars($lang === 'fr' ? 'Toutes les activités' : 'All activities')?></h3>
<?php
foreach ($activities as $activity){
?>
    <div class="activite">
      <h4><?= htmlspecialchars($lang === 'fr' ? $activity['intitule_fr'] : $activity['intitule_eng']) ?></h4>
      <p><?= htmlspecialchars($lang === 'fr' ? $activity['description_fr'] : $activity['description_eng']) ?></p>
    </div>
  <?php
}
?>
  </section>
