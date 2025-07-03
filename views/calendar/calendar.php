<?php 
$lang = getLanguage();
?>
<div class="calendar-container">
  <?php if (empty($schedules)): ?>
    <p class="no-activities">🚫 <?= $lang === 'fr' ? 'Pas d\'activité enregistrée' : 'No activities registered' ?></p>
  <?php else: ?>
    <table class="calendar-table">
      <thead>
        <tr>
          <th><?= $lang === 'fr' ? 'Date' : 'Date' ?></th>
          <th><?= $lang === 'fr' ? 'Matin' : 'Morning' ?></th>
          <th><?= $lang === 'fr' ? 'Après-midi' : 'Afternoon' ?></th>
        </tr>
      </thead>
      <tbody>
        <?php
        $groupedSchedules = [];

        // Regrouper les activités par date
        foreach ($schedules as $schedule) {
            $date = $schedule['scheduled_date'];
            $time = $schedule['time_fr'];
            // Utiliser la version dans la bonne langue
            $activity = $lang === 'fr' ? $schedule['activity_fr'] : $schedule['activity_eng'];
            
            if (!isset($groupedSchedules[$date])) {
                $groupedSchedules[$date] = [
                    'Matin' => [],
                    'Après-midi' => []
                ];
            }
            
            $groupedSchedules[$date][$time][] = $activity;
        }

        // Trier les dates
        ksort($groupedSchedules);

        // Affichage des activités groupées
        foreach ($groupedSchedules as $date => $times): 
            try {
                $formattedDate = date('d/m/Y', strtotime($date));
            } catch (Exception $e) {
                $formattedDate = $date; // Fallback si la date est invalide
            }
        ?>
          <tr>
            <td><?= htmlspecialchars($formattedDate) ?></td>
            <td>
              <?php if (!empty($times['Matin'])): ?>
                <?= implode("<br>", array_map('htmlspecialchars', $times['Matin'])) ?>
              <?php else: ?>
                <span class="no-activity"><?= $lang === 'fr' ? 'Aucune activité' : 'No activity' ?></span>
              <?php endif; ?>
            </td>
            <td>
              <?php if (!empty($times['Après-midi'])): ?>
                <?= implode("<br>", array_map('htmlspecialchars', $times['Après-midi'])) ?>
              <?php else: ?>
                <span class="no-activity"><?= $lang === 'fr' ? 'Aucune activité' : 'No activity' ?></span>
              <?php endif; ?>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  <?php endif; ?>
  <a href="addToCalendar">
      <?= $lang === 'fr' ? 'Ajouter une entrée au calendrier' : 'Add en item to calendar' ?>
  </a>
</div>

<style>
.calendar-container {
    max-width: 1200px;
    margin: 20px auto;
    padding: 20px;
}

.calendar-table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background: white;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.calendar-table th,
.calendar-table td {
    padding: 12px;
    text-align: left;
    border: 1px solid #ddd;
}

.calendar-table th {
    background-color: #f5f5f5;
    font-weight: bold;
}

.calendar-table tr:nth-child(even) {
    background-color: #f9f9f9;
}

.calendar-table tr:hover {
    background-color: #f0f0f0;
}

.no-activities {
    text-align: center;
    font-weight: bold;
    color: #666;
    padding: 20px;
    background: #f9f9f9;
    border-radius: 4px;
}

.no-activity {
    color: #999;
    font-style: italic;
}
</style>