<?php

class Router
{
    private static $ruta;

    public function __construct() {}

    public static function getRuta()
    {
        if (!Helpers::validarSesion()) {
            return 'login';
        }

        if (!isset($_GET['ruta'])) {
            return 'menu';
        }

        $ruta = trim($_GET['ruta'], '/');

        // Eliminar etiquetas HTML y PHP
        $ruta = strip_tags($ruta);

        // Escapar caracteres especiales (como comillas o signos menores que)
        return htmlspecialchars($ruta, ENT_QUOTES, 'UTF-8');
    }

    public static function renderView(): void
    {
        require_once LAYOUTS_PATH . 'header.php';

        echo $ruta = self::getRuta();

        # LISTA BLANCA DE RUTAS

        switch ($ruta) {
            case 'login':
            case 'menu':
            case 'logout':
                require_once PAGES_PATH . "{$ruta}.php";
                break;
            case 'usuarios':
                require_once MODULES_PATH . 'usuarios' . DS . 'index.php';
                break;
            case 'usuarios/nuevo':
                require_once MODULES_PATH . 'usuarios' . DS . 'create.php';
                break;

            default:
                echo "<p>ERROR</p>";
                require_once PAGES_PATH . 'error.php';
                break;
        }

        require_once LAYOUTS_PATH . 'footer.php';
    }
}
