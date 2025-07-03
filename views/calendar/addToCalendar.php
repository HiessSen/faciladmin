<?php
$lang = getLanguage();
if (isset($success)) echo "<p style='color: green;'>$success</p>";
if (isset($error)) echo "<p style='color: red;'>$error</p>";

// Débogage
try {
  // Test de la connexion
  if (!isset($GLOBALS['db'])) {
    throw new Exception("La connexion à la base de données n'est pas établie");
  }

  // Test de la requête time
  $timeStmt = $GLOBALS['db']->query("SELECT id, label_fr, label_eng FROM time");
  if (!$timeStmt) {
    throw new Exception("Erreur lors de la requête time: " . $GLOBALS['db']->errorInfo()[2]);
  }
  $timeCount = $timeStmt->rowCount();

  // Test de la requête activities
  $activityStmt = $GLOBALS['db']->query("SELECT id, intitule_fr, intitule_eng FROM activities");
  if (!$activityStmt) {
    throw new Exception("Erreur lors de la requête activities: " . $GLOBALS['db']->errorInfo()[2]);
  }
  $activityCount = $activityStmt->rowCount();
} catch (Exception $e) {
  echo "<p style='color: red;'>Erreur : " . $e->getMessage() . "</p>";
}
?>
<form method="POST" class="calendar-form">
  <div class="form-group">
    <label for="scheduled_date"><?= $lang === 'fr' ? 'Date' : 'Date' ?> :</label>
    <input type="date" id="scheduled_date" name="scheduled_date" required class="form-control">
  </div>

  <div class="form-group">
    <label for="time_id"><?= $lang === 'fr' ? 'Demi-journée' : 'Half-day' ?> :</label>
    <select id="time_id" name="time_id" class="form-control" required>
      <?php
      try {
        $stmt = $GLOBALS['db']->query("SELECT id, label_fr, label_eng FROM time");
        while ($time = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<option value='" . htmlspecialchars($time['id']) . "'>" .
            htmlspecialchars($lang === 'fr' ? $time['label_fr'] : $time['label_eng']) .
            "</option>";
        }
      } catch (PDOException $e) {
        echo "<option value=''>" . ($lang === 'fr' ? 'Erreur de chargement' : 'Loading error') . "</option>";
      }
      ?>
    </select>
  </div>

  <div class="form-group">
    <label for="activity_id"><?= $lang === 'fr' ? 'Activité' : 'Activity' ?> :</label>
    <select id="activity_id" name="activity_id" class="form-control" required>
      <?php
      try {
        $stmt = $GLOBALS['db']->query("SELECT id, intitule_fr, intitule_eng FROM activities");
        while ($activity = $stmt->fetch(PDO::FETCH_ASSOC)) {
          echo "<option value='" . htmlspecialchars($activity['id']) . "'>" .
            htmlspecialchars($lang === 'fr' ? $activity['intitule_fr'] : $activity['intitule_eng']) .
            "</option>";
        }
      } catch (PDOException $e) {
        echo "<option value=''>" . ($lang === 'fr' ? 'Erreur de chargement' : 'Loading error') . "</option>";
      }
      ?>
    </select>
  </div>

  <button type="submit" class="btn btn-primary">
    <?= $lang === 'fr' ? 'Ajouter l\'activité au calendrier' : 'Add activity to calendar' ?>
  </button>
</form>

<style>
.calendar-form {
    max-width: 600px;
    margin: 20px auto;
    padding: 20px;
    background: white;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.form-group {
    margin-bottom: 15px;
}

.form-group label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

.form-control {
    width: 100%;
    padding: 8px;
    border: 1px solid #ddd;
    border-radius: 4px;
    font-size: 16px;
}

.btn {
    padding: 10px 20px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-size: 16px;
}

.btn-primary {
    background-color: #007bff;
    color: white;
}

.btn-primary:hover {
    background-color: #0056b3;
}
</style>