<?php
require_once __DIR__ . '/../config/db.php'; // Connexion à la BDD
//Modèle du calendrier
class Calendar {
  private $db;

  public function __construct() {
    global $db; // Récupération de la connexion globale
    $this->db = $db;
  }

  public function isActivityScheduled($scheduled_date, $time_id, $activity_id) {
    $stmt = $this->db->prepare("
      SELECT COUNT(*) as count 
      FROM activity_schedules 
      WHERE scheduled_date = ? 
      AND time_id = ? 
      AND activity_id = ?
    ");
    $stmt->execute([$scheduled_date, $time_id, $activity_id]);
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    return $result['count'] > 0;
  }

  public function addCalendar($scheduled_date, $time_id, $activity_id, $user_id) {
    // Vérifier si l'activité existe déjà pour cette date et cette période
    if ($this->isActivityScheduled($scheduled_date, $time_id, $activity_id)) {
      return false; // L'activité existe déjà
    }

    $stmt = $this->db->prepare("
            INSERT INTO activity_schedules (scheduled_date, time_id, activity_id)
            VALUES (?, ?, ?)
        ");
    return $stmt->execute([$scheduled_date, $time_id, $activity_id]);
  }

  public function getAllCalendar() {
    $stmt = $this->db->query("
        SELECT DISTINCT
            asch.scheduled_date,
            CASE 
                WHEN t.code = 'morning' THEN 'Matin'
                WHEN t.code = 'afternoon' THEN 'Après-midi'
            END as time_fr,
            CASE 
                WHEN t.code = 'morning' THEN 'Morning'
                WHEN t.code = 'afternoon' THEN 'Afternoon'
            END as time_eng,
            a.intitule_fr AS activity_fr,
            a.intitule_eng AS activity_eng
        FROM activity_schedules asch
        JOIN time t ON asch.time_id = t.id
        JOIN activities a ON asch.activity_id = a.id
        ORDER BY asch.scheduled_date, t.code
    ");

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

//  public function getUserCalendar($user_id) {
//    $stmt = $this->db->prepare("
//            SELECT asch.scheduled_date, t.label_fr AS time_fr, t.label_eng AS time_eng, a.intitule_fr
//            FROM activity_registrations ar
//            JOIN activity_schedules asch ON ar.activity_schedule_id = asch.id
//            JOIN time t ON asch.time_id = t.id
//            JOIN activities a ON asch.activity_id = a.id
//            WHERE ar.user_id = ?
//            ORDER BY asch.scheduled_date
//        ");
//    $stmt->execute([$user_id]);
//    return $stmt->fetchAll(PDO::FETCH_ASSOC);
//  }

  /**
   * Récupère les activités du jour avec la liste des membres inscrits pour chaque demi-journée
   */
  public function getTodayActivitiesWithMembers($date = null) {
    if ($date === null) {
      $date = date('Y-m-d');
    }
    $sql = "
        SELECT
            t.code AS time_code,
            t.label_fr AS time_fr,
            t.label_eng AS time_eng,
            a.id AS activity_id,
            a.intitule_fr,
            a.intitule_eng,
            u.id AS user_id,
            u.first_name,
            u.last_name
        FROM activity_schedules asch
        JOIN time t ON asch.time_id = t.id
        JOIN activities a ON asch.activity_id = a.id
        LEFT JOIN presence p ON p.date = asch.scheduled_date AND p.time = t.code
        LEFT JOIN users u ON u.id = p.user_id
        WHERE asch.scheduled_date = ?
        ORDER BY t.code, a.id, u.last_name, u.first_name
    ";
    $stmt = $this->db->prepare($sql);
    $stmt->execute([$date]);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Organiser les données par demi-journée puis activité
    $data = [
        'morning' => [],
        'afternoon' => []
    ];
    foreach ($results as $row) {
        $time = $row['time_code'];
        $activityId = $row['activity_id'];
        if (!isset($data[$time][$activityId])) {
            $data[$time][$activityId] = [
                'intitule_fr' => $row['intitule_fr'],
                'intitule_eng' => $row['intitule_eng'],
                'members' => []
            ];
        }
        if ($row['user_id']) {
            $data[$time][$activityId]['members'][] = [
                'first_name' => $row['first_name'],
                'last_name' => $row['last_name']
            ];
        }
    }
    return $data;
  }
}
?>