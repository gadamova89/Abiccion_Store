<?php
class Usuarios extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }
    public function readById($id)
    {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
        return $stmt->fetch();
    }


    public function create($data)
    {
        $createData = [
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'celular' => $data['celular'],
            'email' => $data['email'],
            'nombre_usuario' => $data['nombre_usuario'],
            'password' => $data['password'],
            'estado' => $data['estado'],
            'rol_id' => $data['rol_id']
        ];

        $sql = "INSERT INTO usuarios 
        (nombres, apellidos, celular, email, nombre_usuario, password, estado, rol_id) 
        VALUES 
        (:nombres, :apellidos, :celular, :email, :nombre_usuario, :password, :estado, :rol_id)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($createData);

        return $this->pdo->lastInsertId();
    }

    public function readAll()
    {
        $sql = "SELECT
            U.id,
            U.nombres,
            U.apellidos,
            U.celular,
            U.email,
            U.nombre_usuario,
            U.estado,
            R.nombre AS rol_id
        FROM
            usuarios U
        INNER JOIN roles R ON
            R.id = U.rol_id
        ORDER BY U.id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function readAllwithPassword()
    {
        //$sql = "SELECT * FROM usuarios";
        $sql = "SELECT
            U.id,
            U.nombres,
            U.apellidos,
            U.celular,
            U.email,
            U.nombre_usuario,
            U.estado,
            U.password,
            R.nombre AS rol_id
        FROM
            usuarios U
        INNER JOIN roles R ON
            R.id = U.rol_id
        ORDER BY U.id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function readCustomers()
    {
        $sql = "SELECT
            U.id,
            U.nombres,
            U.apellidos,
            U.celular,
            U.email,
            U.nombre_usuario,
            U.estado,
            R.nombre AS rol_id
        FROM
            usuarios U
        INNER JOIN roles R ON
            R.id = U.rol_id
        WHERE
            R.nombre = 'cliente'
        ORDER BY U.id
        ";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }
    public function readPersonal()
    {
        $sql = "SELECT
                U.id,
                U.nombres,
                U.apellidos,
                U.celular,
                U.email,
                U.nombre_usuario,
                U.estado,
                R.nombre AS rol_id
            FROM
                usuarios U
            INNER JOIN roles R ON
                R.id = U.rol_id
            WHERE
                R.nombre != 'cliente' 
            ORDER BY U.id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll();
    }

    public function createCustomer($createData)
    {
        // Primero, obtenemos el ID del rol de 'cliente'
        $sqlRoleId = "SELECT id FROM roles WHERE nombre = :rol_nombre";
        $stmtRole = $this->pdo->prepare($sqlRoleId);
        $stmtRole->execute([':rol_nombre' => 'cliente']);
        $rolId = $stmtRole->fetchColumn();

        // Comprobamos si se encontró el rol
        if (!$rolId) {
            throw new Exception("Rol 'cliente' no encontrado.");
        }

        // Ahora, podemos proceder a insertar el nuevo usuario
        $sql = "INSERT INTO usuarios 
            (nombres, apellidos, celular, email, nombre_usuario, password, estado, rol_id)
            VALUES 
            (:nombres, :apellidos, :celular, :email, :nombre_usuario, :password, :estado, :rol_id)";

        // Preparamos la consulta
        $stmt = $this->pdo->prepare($sql);

        // Ejecutamos la consulta vinculando los parámetros desde el array
        $stmt->execute([
            ':nombres' => $createData['nombre'],
            ':apellidos' => $createData['apellidos'],
            ':celular' => $createData['celular'],
            ':email' => $createData['email'],
            ':nombre_usuario' => $createData['nombre_usuario'],
            ':password' => password_hash($createData['password'], PASSWORD_DEFAULT), // Hasheamos la contraseña
            ':estado' => 1, // 1 = estado activo
            ':rol_id' => $rolId // Usamos el ID del rol obtenido
        ]);
    }


    public function deleteById($id)
    {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            ':id' => $id
        ]);
    }

    public function updateCustomer($data)
    {
        // Prepara los datos para la actualización
        $updateData = [
            'id' => $data['id'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'celular' => $data['celular'],
            'email' => $data['email'],
            'nombre_usuario' => $data['nombre_usuario'],
            'estado' => $data['estado'],
            'password' => $data['password'] // Asegúrate de manejar adecuadamente la contraseña
        ];

        $sql = "UPDATE 
                usuarios 
                SET 
                nombres = :nombres, 
                apellidos = :apellidos, 
                celular = :celular, 
                email = :email, 
                nombre_usuario = :nombre_usuario,
                estado = :estado, 
                password = :password 
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($updateData);
        //return $stmt->rowCount(); // Devuelve la cantidad de filas afectadas
    }
    public function updatePersonal($data)
    {
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";
        // echo "<br>";
        $sql = "UPDATE 
                usuarios 
                SET 
                nombres = :nombres, 
                apellidos = :apellidos, 
                celular = :celular, 
                email = :email, 
                nombre_usuario = :nombre_usuario, 
                password = :password, 
                estado = :estado,
                rol_id = :rol_id
                WHERE id = :id";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'id' => $data['id'],
            'nombres' => $data['nombres'],
            'apellidos' => $data['apellidos'],
            'celular' => $data['celular'],
            'email' => $data['email'],
            'nombre_usuario' => $data['nombre_usuario'],
            'password' => $data['password'],
            'estado' => $data['estado'],
            'rol_id' => $data['rol_id']
        ]);
    }
}
