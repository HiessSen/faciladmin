<?php
require_once 'config/db.php'; // Connexion à la BDD
require_once 'models/Calendar.php';

class CalendarController extends BaseController {
  private $model;
  private $db;

  public function __construct() {
    global $db;
    $this->db = $db;
    $this->model = new Calendar();
  }

  // Récupérer toutes les activités enregistrées
  public function getCalendar() {
    $this->setData('title_fr', 'Calendrier général');
    $this->setData('title_eng', 'General Calendar');
    $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
    $this->setData('date_eng', 'Today : ' . date('m/d/Y'));

    $this->setData('schedules', $this->model->getAllCalendar());
    $this->render('calendar/calendar');
  }

  // Ajouter une activité
  public function addToCalendar() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $scheduled_date = $_POST['scheduled_date'];
      $time_id = $_POST['time_id'];
      $activity_id = $_POST['activity_id'];

      // Vérifier si l'activité existe déjà
      if ($this->model->isActivityScheduled($scheduled_date, $time_id, $activity_id)) {
        $this->setData('error', "Cette activité est déjà programmée pour cette date et cette période.");
      } else {
        if ($this->model->addCalendar($scheduled_date, $time_id, $activity_id, null)) {
          // Ajouter l'utilisateur connecté comme présent si connecté
          if (isset($_SESSION['user'])) {
            $user_id = $_SESSION['user']['id'];
            // Récupérer le code de la demi-journée (morning/afternoon) à partir de l'id
            $stmt = $this->db->prepare("SELECT code FROM time WHERE id = ?");
            $stmt->execute([$time_id]);
            $time_code = $stmt->fetchColumn();
            // Insérer dans presence
            $stmt = $this->db->prepare("INSERT INTO presence (user_id, date, time) VALUES (?, ?, ?)");
            $stmt->execute([$user_id, $scheduled_date, $time_code]);
          }
          $this->setData('success', "Activité ajoutée avec succès !");
        } else {
          $this->setData('error', "Erreur lors de l'ajout de l'activité.");
        }
      }
    }

    // Passer la connexion à la base de données à la vue
    $this->setData('db', $this->db);
    
    $this->setData('title_fr', 'Ajouter une activité');
    $this->setData('title_eng', 'Add a new activity');
    $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
    $this->setData('date_eng', 'Today : ' . date('m/d/Y'));
    $this->render('calendar/addToCalendar');
  }
}