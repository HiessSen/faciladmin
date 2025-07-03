<?php 
$lang = getLanguage();
?>
<?php
// todayActivities['morning'] et todayActivities['afternoon']
$times = [
    'morning' => $lang === 'fr' ? 'Matin' : 'Morning',
    'afternoon' => $lang === 'fr' ? 'Après-midi' : 'Afternoon'
];
foreach ($times as $timeKey => $timeLabel):
    $activities = $todayActivities[$timeKey] ?? [];
?>
<section class="todaySection">
  <h3><?= htmlspecialchars($timeLabel) ?></h3>
  <aside>
    <h3><?= $lang === 'fr' ? 'Adhérents inscrits :' : 'Registered members:' ?></h3>
    <ul>
      <?php
      $hasMembers = false;
      $seenMembers = [];

      foreach ($activities as $activity) {
        foreach ($activity['members'] as $member) {
          $memberKey = $member['first_name'] . '_' . $member['last_name'];

          if (!in_array($memberKey, $seenMembers)) {
            $hasMembers = true;
            $seenMembers[] = $memberKey;

            echo '<li><p>' . htmlspecialchars($member['first_name']) .
              ' <span>' . htmlspecialchars($member['last_name']) . '</span></p></li>';
          }
        }
      }

      if (!$hasMembers) {
        echo '<li><p><em>' . ($lang === 'fr' ? 'Aucun inscrit' : 'No registration') . '</em></p></li>';
      }
      ?>
    </ul>
  </aside>
  <article>
    <h3><?= $lang === 'fr' ? 'Activités programmées' : 'Scheduled activities' ?></h3>
    <?php if (!empty($activities)): ?>
      <?php foreach ($activities as $activity): ?>
        <div>
          <p><?= htmlspecialchars($lang === 'fr' ? $activity['intitule_fr'] : $activity['intitule_eng']) ?></p>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <div><p><em><?= $lang === 'fr' ? 'Aucune activité' : 'No activity' ?></em></p></div>
    <?php endif; ?>
    <div class="boutonAddActivity">
      <button type="submit" name="addActivity">
        <img src="assets/img/icones/grand_logo_ajouter.png" alt="">
      </button>
    </div>
  </article>
</section>
<div class="separateur"></div>
<?php endforeach; ?>

<?php
// Calculer la date du jour suivant
$nextDate = date('Y-m-d', strtotime($currentDate . ' +1 day'));
?>
<div style="text-align:center; margin: 30px 0;">
  <a href="?date=<?= htmlspecialchars($nextDate) ?>" class="btn btn-primary">
    <?= $lang === 'fr' ? 'Jour suivant' : 'Next day' ?>
  </a>
</div>