<?php


class Utils {
    
    // Método para eliminar una sesión especifica, pasada por el parámetro $name
    public static function deleteSession($name) {
        if (isset($_SESSION[$name])) {
            $_SESSION[$name] = null;
            unset($_SESSION[$name]);
        }
        return $name;
    }

    // Método para comprobar si un usuario tiene rol de Admin
    public static function isAdmin() {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== 'admin') {
            header("Location: " . BASE_URL . "Login/login");
            exit;
        } else {
            return true;
        }
    }

    // Método para comprobar si el usuario está logueado
    public static function isIdentity() {
        if (!isset($_SESSION['identity'])) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        } else {
            return true;
        }
    }

    // Método para verificar si el usuario tiene un rol específico
    public static function hasRole($requiredRole) {
        if (!isset($_SESSION['rol']) || $_SESSION['rol'] !== $requiredRole) {
            header("Location: " . BASE_URL . "/auth/login");
            exit;
        } else {
            return true;
        }
    }
}
?>