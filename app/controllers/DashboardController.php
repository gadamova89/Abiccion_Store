<?php
class DashboardController {
    // Método para mostrar el dashboard del administrador
    public function admin() {
        if (!Helpers::validarSesion()) {
            // Si no tiene sesión, redirigir al login
            header('Location: ' . APP_URL . 'login/login');
            exit;
        }
    
        // Aquí puedes poner cualquier lógica específica para el admin
        require_once VIEWS_PATH . 'Dashboard/dashboardAdmin.php';
    }

    // Método para mostrar el dashboard del vendedor
    public function vendedor() {
        require_once VIEWS_PATH . 'Dashboard/dashboardVendedor.php';
    }

    // Método para mostrar el dashboard del cliente
    public function cliente() {
        require_once VIEWS_PATH . 'Dashboard/dashboardClientes.php';
    }
}
