<?php
//Classe Database qui permet la connexion à la BDD sur toutes les pages
class Database {
  private $host = "localhost";
  private $dbname = "facil_admin";
  private $username = "root";
  private $password = "";

  public function connect() {
    try {
      $pdo = new PDO("mysql:host=$this->host;dbname=$this->dbname;charset=utf8mb4", $this->username, $this->password);
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      return $pdo;
    } catch (PDOException $e) {
      die("Erreur de connexion : " . $e->getMessage());
    }
  }
}
$database = new Database();
$GLOBALS['db'] = $database->connect();
?>