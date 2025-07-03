<?php
class TodayController extends BaseController {

  public function index() {
    // Préparer les données pour la vue
    $this->setData('title_fr', 'Programme du jour');
    $this->setData('title_eng', 'Today,s schedule');
    $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
    $this->setData('date_eng', 'Today ' . date('m/d/Y'));

    // Lire la date depuis l'URL ou prendre aujourd'hui
    $date = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');

    // Charger les activités du jour avec les membres inscrits
    $calendarModel = new Calendar();
    $todayActivities = $calendarModel->getTodayActivitiesWithMembers($date);
    $this->setData('todayActivities', $todayActivities);
    $this->setData('currentDate', $date);

    $this->render('today');
  }
}
?>