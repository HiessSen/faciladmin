<?php
class Router {
    private $routes = [];

    public function addRoute($path, $controller, $method) {
        $this->routes[$path] = [
            'controller' => $controller,
            'method' => $method
        ];
    }

    public function handleRequest() {
        // Récupérer le chemin de l'URL
        $path = $this->getPath();
        
        // Debugage : Afficher le chemin et les routes disponibles
//        echo "Chemin demandé: '" . $path . "'<br>";
//        echo "Routes disponibles: <pre>";
//        print_r($this->routes);
//        echo "</pre>";

        // Vérifier si la route existe
        if (isset($this->routes[$path])) {
            $route = $this->routes[$path];
            $controllerName = $route['controller'];
            $methodName = $route['method'];

            // Debugage : Afficher les informations du contrôleur
//            echo "Contrôleur trouvé: " . $controllerName . "<br>";
//            echo "Méthode trouvée: " . $methodName . "<br>";

            // Créer une instance du contrôleur
            if (class_exists($controllerName)) {
                $controller = new $controllerName();

                // Appeler la méthode
                if (method_exists($controller, $methodName)) {
                    $controller->$methodName();
                } else {
                    echo "Erreur: La méthode $methodName n'existe pas dans le contrôleur $controllerName<br>";
                    $this->handleError404();
                }
            } else {
                echo "Erreur: Le contrôleur $controllerName n'existe pas<br>";
                $this->handleError404();
            }
        } else {
//            echo "Erreur: Aucune route trouvée pour le chemin '$path'<br>";
            $this->handleError404();
        }
    }

    private function getPath() {
        // Récupérer l'URL demandée
        $requestUri = $_SERVER['REQUEST_URI'];
        
        // Debugage : Afficher l'URI brute
//        echo "URI brute: " . $requestUri . "<br>";
        
        // Nettoyer l'URL
        $path = parse_url($requestUri, PHP_URL_PATH);
        
        // Supprimer le chemin de base si présent
        if (strpos($path, BASE_URL) === 0) {
            $path = substr($path, strlen(BASE_URL));
        }
        
        // Si l'URL est vide ou contient juste un slash, retourner une chaîne vide
        if ($path === '/' || $path === '') {
            return '';
        }
        
        return trim($path, '/');
    }

    private function handleError404() {
        http_response_code(404);
        include __DIR__ . '/../views/layout/404.php';
    }
}
?>
