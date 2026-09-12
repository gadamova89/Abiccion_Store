<?php

class Helpers
{

    public static function ok()
    {
        echo "<p>HELPERS OK!</p>";
    }
    // Método para formatear una fecha
    public static function formatDate($date, $format = 'd/m/Y')
    {
        $datetime = new DateTime($date);
        return $datetime->format($format);
    }

    public static function validarSesion()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        // Verifica si hay una sesión activa
        if (!empty($_SESSION) && isset($_SESSION['status']) && $_SESSION['status'] === 'OK') {
            return true;
        } else {
            return false;
            // require_once PAGES_PATH . 'logout.php';
        }
    }

    public static function validarAccesoRoles(...$rolesNoPermitidos)
    {
        if (!in_array($_SESSION['rol'], $rolesNoPermitidos, true)) {

            echo "<p>USUARIO NO AUTORIZADO!</p>";

            $menuFilePath = "./menu.php";

            if (!is_file($menuFilePath)) {
                $menuFilePath = "../menu.php";
            }

            header("refresh:2.5;url={$menuFilePath}");
            exit;
        }
    }

}
