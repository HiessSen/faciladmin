<?php
class HomeController extends BaseController {

    public function index() {
      // Préparer les données pour la vue
      $this->setData('title_fr', 'facil\'admin : bienvenue !');
      $this->setData('title_eng', 'facil\'admin : welcome!');
      $this->setData('date_fr', 'Aujourd\'hui, le ' . date('d/m/Y'));
      $this->setData('date_eng', 'Today : ' . date('m/d/Y'));

      // Rendre la vue
      $this->render('home');
  }
}
?>