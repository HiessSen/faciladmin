<?php
require_once 'config/db.php';
require_once 'models/Activity.php';

class ActivityController extends BaseController {
  private $userActivity;

  public function __construct() {
    $this->userActivity = new Activity();
  }
  public function index() {
    $activityModel = new Activity();
    $activities = $activityModel->getAll();

    $this->setData('activities', $activities);
    $this->setData('title_fr', 'Toutes les activités');
    $this->setData('title_eng', 'All activities');
    $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
    $this->setData('date_eng', 'Today :' . date('m/d/Y'));

    $this->render('activities/all_activities'); // Vérifie que tu passes bien le bon chemin ici !
  }

  public function calendar() {
    $this->setData('title_fr', 'Le calendrier de l\'association');
    $this->setData('title_eng', 'The calendar of the association');
    $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
    $this->setData('date_eng', 'Today : ' . date('m/d/Y'));

    $this->render('calendar/calendar');
  }
}