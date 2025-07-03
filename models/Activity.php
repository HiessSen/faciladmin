<?php
require_once __DIR__ . '/../config/db.php';

class Activity {

  private $db;

  public function __construct() {
    global $db;

//    if (!$db) {
//      die("Erreur : Connexion à la BDD est introuvable.");
//    }

    $this->db = $db;
  }


  public function getAll() {
    try {
      $stmt = $this->db->prepare("SELECT * FROM activities ORDER BY id DESC");
      $stmt->execute();
      return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch(PDOException $e) {
      echo "Erreur : " . $e->getMessage();
      return [];
    }
  }

//  public function getById($id) {
//    try {
//      $stmt = $this->db->prepare("SELECT * FROM activities WHERE id = :id");
//      $stmt->bindParam(':id', $id);
//      $stmt->execute();
//      return $stmt->fetch(PDO::FETCH_OBJ);
//    } catch(PDOException $e) {
//      echo "Erreur : " . $e->getMessage();
//      return null;
//    }
//  }

  public function getActivitiesByDateRange($dates) {
    $stmt = $this->db->prepare("SELECT date, time, intitule_fr FROM activities WHERE date IN (" . implode(',', array_map([$this->db, 'quote'], $dates)) . ")");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }
}
?>