<?php

// Récupérer toutes les activités disponibles
$stmt = $db->prepare("SELECT id, intitule_fr FROM activities");
$stmt->execute();
$availableActivities = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<form method="POST">
    <label>Date : <input type="date" name="date" required></label>
    <label>Temps :
        <select name="time">
            <option value="morning">Matin</option>
            <option value="afternoon">Après-midi</option>
        </select>
    </label>
    <label>Activité :
        <select name="activity_id">
            <?php foreach ($availableActivities as $activity): ?>
                <option value="<?= $activity['id'] ?>"><?= htmlspecialchars($activity['intitule_fr']) ?></option>
            <?php endforeach; ?>
        </select>
    </label>
    <button type="submit">Ajouter l'activité</button>
</form>