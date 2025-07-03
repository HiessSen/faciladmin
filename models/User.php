<?php
require_once __DIR__ . '/../config/db.php'; // Connexion à la BDD

class User {
  private $db;

  public function __construct() {
    global $db;

//    if (!$db) {
//      die("Erreur : Connexion à la BDD est introuvable.");
//    }

    $this->db = $db;
  }

  public function getUserByEmail($email) {
    $stmt = $this->db->prepare("SELECT users.*, role.intitule_fr, role.intitule_eng 
                                FROM users 
                                LEFT JOIN role ON users.role_id = role.id
                                WHERE users.email = ?");
    $stmt->execute([$email]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function getUserById($id) {
    $stmt = $this->db->prepare("SELECT * , role.intitule_fr, role.intitule_eng
                                FROM users
                                LEFT JOIN role ON users.role_id = role.id
                                WHERE id = ?");
    $stmt->execute([$id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public function createUser($first_name, $last_name, $email, $password, $role_id = null) {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Si aucun rôle n'est fourni, assigner "Utilisateur" par défaut
    if (!$role_id) {
      $stmt = $this->db->prepare("SELECT id FROM role WHERE intitule_fr = 'Utilisateur'");
      $stmt->execute();
      $role = $stmt->fetch(PDO::FETCH_ASSOC);
      $role_id = $role['id'];
    }

    $stmt = $this->db->prepare("INSERT INTO users (first_name, last_name, email, password, role_id, join_date) VALUES (?, ?, ?, ?, ?, CURRENT_TIMESTAMP)");
    return $stmt->execute([$first_name, $last_name, $email, $hashedPassword, $role_id]);
  }

}
?>