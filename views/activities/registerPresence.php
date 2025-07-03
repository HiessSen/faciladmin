<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $date = $_POST['date'];
  $time = $_POST['time'];
  $userId = $_SESSION['user']['id'];

  $stmt = $this->db->prepare("INSERT INTO presence (user_id, date, time) VALUES (?, ?, ?)");
  $stmt->execute([$userId, $date, $time]);

  header("Location: calendar.php");
  exit();
}
?>

<form method="POST">
  <input type="hidden" name="date" value="<?= $_GET['date'] ?>">
  <input type="hidden" name="time" value="<?= $_GET['time'] ?>">
  <button type="submit">Confirmer la présence</button>
</form>