<?php
abstract class BaseController {
    protected $data = [];

    // Types de messages
    const MESSAGE_ERROR = 'error';
    const MESSAGE_WARNING = 'warning';
    const MESSAGE_SUCCESS = 'success';

    protected function checkAuth() {
        if (!isset($_SESSION['user'])) {
            $this->redirect('login');
        }
    }

    protected function render($view, $data = []) {
    $lang = getLanguage();
    // Fusionner les données
    $this->data = array_merge($this->data, $data);

    // Extraire les variables pour les rendre disponibles dans la vue
    extract($this->data);

    // Inclure le header
    $this->includeHeader();

    // Ouverture de la balise 'main' qui entoure le contenu de toutes les pages
    echo '<main>';
    echo '<h2 id="titrePage">' . htmlspecialchars($lang === 'fr' ? $title_fr : $title_eng) . '</h2>';
    echo '<p id="date">' . htmlspecialchars($lang === 'fr' ? $date_fr : $date_eng) . '</p>';
    // Vérifier si la vue appartient aux vues utilisateur
    $userViews = ['register', 'login', 'profile', 'editProfile', 'deleteAccount'];
    if (in_array($view, $userViews)) {
      $viewPath = 'views/user/' . $view . '.php';
    } else {
      $viewPath = 'views/' . $view . '.php';
    }

    // Inclure la vue principale
    if (file_exists($viewPath)) {
      include $viewPath;
    } else {
      echo "Vue non trouvée : " . $view;
    }

    echo '</main>';

    // Inclure le footer
    $this->includeFooter();
  }

    private function includeHeader() {
        $headerPath = 'views/layout/header.php';
        if (file_exists($headerPath)) {
            include $headerPath;
        } else {
            echo "Header non trouvé";
        }
    }

    private function includeFooter() {
        $footerPath = 'views/layout/footer.php';
        if (file_exists($footerPath)) {
            include $footerPath;
        } else {
            echo "Footer non trouvé";
        }
    }

    protected function setData($key, $value) {
        $this->data[$key] = $value;
    }

  protected function redirect($url) {
    // Construire l'URL complète
    $redirectUrl = 'http://' . $_SERVER['HTTP_HOST'] . BASE_URL;
    if (!empty($url)) {
      $redirectUrl .= '/' . ltrim($url, '/');
    }
    
    error_log("Redirection vers : " . $redirectUrl);
    header('Location: ' . $redirectUrl);
    exit();
  }

}
?>