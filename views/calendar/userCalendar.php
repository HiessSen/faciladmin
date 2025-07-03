<table>
  <tr>
    <th>Date</th>
    <th><?= $lang === 'fr' ? 'Matin' : 'Morning' ?></th>
    <th><?= $lang === 'fr' ? 'Activité' : 'Activity' ?></th>
  </tr>

  <?php foreach ($calendars ?? [] as $calendar): ?>
    <tr>
      <td><?= date('d/m/Y', strtotime($calendar['scheduled_date'])) ?></td>
      <td><?= htmlspecialchars($calendar['time_fr']) ?></td>
      <td><?= htmlspecialchars($calendar['intitule_fr']) ?></td>
    </tr>
  <?php endforeach; ?>
</table>