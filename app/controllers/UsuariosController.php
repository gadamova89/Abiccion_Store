<?php
class UsuariosController
{
    private $categorias;
    private $productos;
    private $roles;
    private $usuarios;

    public function __construct()
    {
        $this->categorias = new Categorias();
        $this->productos = new Productos();
        $this->roles = new Roles();
        $this->usuarios = new Usuarios();
    }
    public function obtenerRolIdCliente(){
        $rolId = $this->roles->getRolIdCliente();
        return $rolId;
    }

    public function obtenerUsuarios()
    {
        $registros = $this->usuarios->readAllwithPassword();
        //print_r($registros);
        require_once VIEWS_PATH . 'Usuarios/dashboardUsuarios.php';
    }
    public function obtenerUsuarioPorId($id)//json
    {
        $registro = $this->usuarios->readById($id);
        echo json_encode($registro);
    }

    public function administrarClientes()
    {
        $registros = $this->usuarios->readCustomers();
        require_once VIEWS_PATH . "Usuarios/Clientes/controlClientes.php";
    }
    public function administrarPersonal()
    {
        $roles=$this->roles->getAllRoles();
        $registros = $this->usuarios->readPersonal();
        require_once VIEWS_PATH . "Usuarios/Personal/controlPersonal.php";
    }

    public function crearCliente()
    {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
        $celular = isset($_POST['celular']) ? $_POST['celular'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $estado=1;
        $rol_id= $this->obtenerRolIdCliente();
        
        $createData = [
            'nombre' => $nombre,
            'apellidos' => $apellidos,
            'celular' => $celular,
            'email' => $email,
            'nombre_usuario' => $nombre_usuario,
            'password' => $password,
            'rol_id'=>$rol_id,
            'estado'=>$estado

        ];
        $this->usuarios->createCustomer($createData);//aqui obtengo los datos para la tabla
        $registros = $this->usuarios->readCustomers();
        require_once VIEWS_PATH . "Usuarios/Clientes/controlClientes.php";//aqui simplemente la llamo
        //exit;
    }

    public function eliminarCliente(){
        $id = $_POST['id'];
        $this->usuarios->deleteById($id);//aqui obtengo los datos para la tabla
        $registros = $this->usuarios->readCustomers();

        require_once VIEWS_PATH . "Usuarios/Clientes/controlClientes.php";//aqui simplemente la llamo

    }
    public function eliminarPersonal(){
        $id = $_POST['id'];
        $this->usuarios->deleteById($id);//aqui obtengo los datos para la tabla
        $roles=$this->roles->getAllRoles();
        $registros = $this->usuarios->readPersonal();
        require_once VIEWS_PATH . "Usuarios/Personal/controlPersonal.php";//aqui simplemente la llamo

    }

    public function editarCliente(){
        //echo "editando cliente";
        $datos = [
            'id' => $_POST['id'],
            'nombres' => $_POST['nombres'],
            'apellidos' => $_POST['apellidos'],
            'celular' => $_POST['celular'],
            'email' => $_POST['email'],
            'nombre_usuario' => $_POST['nombre_usuario'],
            'estado' => isset($_POST['estado']) ? 1 : 0,
            'password' => $_POST['password'], // Asegúrate de manejar la contraseña correctamente
        ];
        //var_dump($datos);
        $this->usuarios->updateCustomer($datos);
        $registros = $this->usuarios->readCustomers();
        require_once VIEWS_PATH . "Usuarios/Clientes/controlClientes.php";//aqui simplemente la llamo
    }
    public function editarPersonal() {
        $datos = [
            'id' => $_POST['id'],
            'nombres' => $_POST['nombres'],
            'apellidos' => $_POST['apellidos'],
            'celular' => $_POST['celular'],
            'email' => $_POST['email'],
            'nombre_usuario' => $_POST['nombre_usuario'],
            'password' => $_POST['password'], // Asegúrate de manejar la contraseña correctamente
            //'estado' => $_POST['estado'], // Estado del personal
            'estado' => isset($_POST['estado']) ? 1 : 0,
            'rol_id' => $_POST['rol_id'] // Nuevo campo para el rol del personal
        ];
        // echo "<pre>";
        // print_r($datos);
        // echo "</pre>";
        // echo "<br>";
        $roles=$this->roles->getAllRoles();
        // Llamada al modelo para actualizar el personal
        $this->usuarios->updatePersonal($datos);
        // Obtener los registros actualizados del personal
        $registros = $this->usuarios->readPersonal();
        // Cargar la vista de la tabla de personal
        require_once VIEWS_PATH . "Usuarios/Personal/controlPersonal.php";
    }

    public function crearPersonal()
    {
        $nombres = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $apellidos = isset($_POST['apellidos']) ? $_POST['apellidos'] : null;
        $celular = isset($_POST['celular']) ? $_POST['celular'] : null;
        $email = isset($_POST['email']) ? $_POST['email'] : null;
        $nombre_usuario = isset($_POST['nombre_usuario']) ? $_POST['nombre_usuario'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        $rol_id = isset($_POST['rol_id']) ? $_POST['rol_id']:null;
        $estado=1;
        
        $createData = [
            'nombres' => $nombres,
            'apellidos' => $apellidos,
            'celular' => $celular,
            'email' => $email,
            'nombre_usuario' => $nombre_usuario,
            'password' => $password,
            'rol_id'=>$rol_id,
            'estado'=>$estado
        ];
        $roles=$this->roles->getAllRoles();
        $this->usuarios->create($createData);//aqui obtengo los datos para la tabla
        $registros = $this->usuarios->readPersonal();
        require_once VIEWS_PATH . "Usuarios/Personal/controlPersonal.php";//aqui simplemente la llamo
        //exit;
    }
}
