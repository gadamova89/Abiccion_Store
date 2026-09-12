<?php
class LoginController
{
    private $LoginModel;

    public function __construct()
    {
        $this->LoginModel = new LoginModel();
    }
    
    public function login()
    {
        // Verificar si el usuario ya tiene sesión activa
        if (Helpers::validarSesion()) {
            // Redirigir al dashboard si ya está logueado
            header('Location: ' . APP_URL . 'dashboard/'.$_SESSION['rol']); // O cualquier otra ruta del dashboard
            exit; // Termina la ejecución después de la redirección
        }
        require_once VIEWS_PATH . 'Login/login.php';
    }

    public function validarUsuario()
    {
        $mensaje="";
        $nombreUsuario = $_POST['usuario'];
        $password = $_POST['password'];
        // echo "<br>";
        // var_dump($_POST['usuario']);
        // echo "<br>";
        // var_dump($_POST['password']);
        // echo "<br>";
        //exit;
        // Aquí iría la lógica para verificar el usuario y la contraseña
        $LoginController = new LoginController();

        $dbUsuario = $LoginController->existeNombreUsuario($nombreUsuario);
        # Validando si existe el Nombre de Usuario
        if ($dbUsuario) {

            $nombreUsuario = $dbUsuario['nombre_usuario'];
            $estadoUsuario = $dbUsuario['estado'];
            # Validando el Estado del Usuario
            if ($estadoUsuario == 1) {
                # Obteniendo y validando el Password considerando el Nombre de Usuario
                $dbPasswordHash = $LoginController->obtenerPasswordHash($nombreUsuario);
                //echo "Desde la bd es: ";
                //var_dump($dbPasswordHash);
                //if ($LoginController->verificarPassword($password, $dbPasswordHash)) {
                if ($password == $dbPasswordHash) {
                    //echo "INICIANDO SESIÓN...";
                    $LoginController->iniciarSesionUsuario($nombreUsuario);
                    sleep(2);
                    $mensaje= "Iniciando Sesion";

                    switch ($_SESSION['rol']) {
                        case 'admin':
                            header('Location: ' . APP_URL . 'dashboard/admin');
                            exit;
                            break;
                        case 'vendedor':
                            header('Location: ' . APP_URL . 'dashboard/vendedor');
                            exit;
                            break;
                        case 'cliente':
                            header('Location: ' . APP_URL . 'dashboard/cliente');
                            exit;
                            break;
                    }
                } else {
                    $mensaje= "CONTRASEÑA INCORRECTA";
                    require_once VIEWS_PATH . "Login/login.php";
                }
            } else {
                $mensaje= "USUARIO INACTIVO";
                require_once VIEWS_PATH . "Login/login.php";
            }
        } else {
            $mensaje= "USUARIO NO REGISTRADO";
            require_once VIEWS_PATH . "Login/login.php";
        }

    }

    public function logout()
    {
        session_destroy();
        header('Location: ' . APP_URL . 'login/login');
        //header('Location: ' . BASE_URL);
        //require_once VIEWS_PATH . "Login/login.php";
    }
    ////////////////recicled

    public function existeNombreUsuario($nombreUsuario): array | bool
    {
        try {
            return $this->LoginModel->usernameExists($nombreUsuario);
        } catch (\PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function obtenerPasswordHash($nombreUsuario): string
    {
        try {
            return $this->LoginModel->getDBPassword($nombreUsuario);
        } catch (\PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function verificarPassword($password, $dbPasswordHash): bool
    {
        try {
            return $this->LoginModel->passwordVerify($password, $dbPasswordHash);
        } catch (\PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function iniciarSesionUsuario($nombreUsuario): void
    {
        try {
            $this->LoginModel->initUserSession($nombreUsuario);
        } catch (\PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }
}
