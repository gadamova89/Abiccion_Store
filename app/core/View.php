<?php

class View
{

    public function __construct() {}

    public static function reder($ruta, $data = [])
    {
        switch ($ruta) {
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
    }
}
