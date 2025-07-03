<?php
require_once 'config/db.php'; // Connexion à la BDD
require_once 'models/User.php';

class UserController extends BaseController {
  private $userModel;

  public function __construct() {
    $this->userModel = new User();
  }

  public function login() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $email = $_POST['email'];
      $password = $_POST['password'];

      $user = $this->userModel->getUserByEmail($email);

      if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = [
          'id' => $user['id'],
          'first_name' => $user['first_name'],
          'last_name' => $user['last_name'],
          'email' => $user['email'],
          'join_date' => $user['join_date'],
          'last_presence' => $user['last_presence'],
          'intitule_fr' => $user['intitule_fr'], // Ajoute le rôle à la session en français
          'intitule_eng' => $user['intitule_eng'], // Ajoute le rôle à la session en anglais
        ];
        $this->redirect('profile');
      } else {
        $this->setData('error', "Email ou mot de passe incorrect");
        $this->render('user/login'); // Chargement depuis views/user/
      }
    } else {
      $this->setData('title_fr', 'Inscrivez-vous !');
      $this->setData('title_eng', 'Login!');
      $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
      $this->setData('date_eng', 'Today : ' . date('m/d/Y'));
      $this->render('user/login');
    }
  }

  public function profile() {
    if (!isset($_SESSION['user'])) {
      $this->redirect('login');
      return;
    }

    $user = $_SESSION['user'];

    // Passer les données à la vue
    $this->setData('user', $user);
    $this->setData('title_fr', 'Bienvenue, ' . htmlspecialchars($user['first_name']) . ' !');
    $this->setData('title_eng', 'Welcome, ' . htmlspecialchars($user['first_name']) . ' !');
    $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
    $this->setData('date_eng', 'Today : ' . date('m/d/Y'));

    // Afficher la vue
    $this->render('user/profile');
  }

  public function logout() {
    // Détruire la session
    session_start();
    session_destroy();

    // Rediriger vers la page de connexion
    $this->redirect('login');
  }

  public function register() {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
      $first_name = $_POST['first_name'];
      $last_name = $_POST['last_name'];
      $email = $_POST['email'];
      $password = $_POST['password'];
      $role_id = isset($_POST['role_id']) ? $_POST['role_id'] : 2;


      // Vérifier si l'email existe déjà
      if ($this->userModel->getUserByEmail($email)) {
        $this->setData('error', "Cet email est déjà utilisé.");
        $this->render('user/register');
        return;
      }

      // Insérer l'utilisateur en BDD
      if ($this->userModel->createUser($first_name, $last_name, $email, $password, $role_id)) {
        // Rediriger vers login si inscription réussie
        $this->redirect('login');
      } else {
        $this->setData('error', "Erreur lors de l'inscription.");
        $this->render('user/register');
      }
    } else {
      $this->render('user/register');
    }
  }

}
?>