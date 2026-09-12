<?php
require_once CORE_PATH . 'Database.php';

class Productos extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    // Obtener todas las categorías

    public function getAll()
    {
        $sql = 'SELECT * FROM productos';
        $stmt = $this->pdo->query('SELECT * FROM productos');
        //return $stmt->fetchAll( PDO::FETCH_ASSOC );
        return $this->pdo->query($sql)->fetchAll();
    }

    public function getAllByDate()
    {
        $sql = 'SELECT * FROM productos ORDER BY updated_at DESC';
        $stmt = $this->pdo->query($sql);
        //return $stmt->fetchAll( PDO::FETCH_ASSOC );
        return $this->pdo->query($sql)->fetchAll();
    }


    // Método para obtener todos los productos de una categoría

    public function getProductsByCategory($categoria_id)
    {
        //echo '<br>'.$categoria_id;
        // Aquí puedes agregar tu lógica de conexión a la base de datos
        $sql = 'SELECT * FROM productos WHERE categoria_id = :categoria_id';
        //$sql = 'SELECT * FROM productos ';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['categoria_id' => $categoria_id]);

        // Ejecutar la consulta con el parámetro
        // Ejecutar la consulta y devolver los resultados
        //return $this->pdo->query($sql)->fetchAll();
        return $stmt->fetchAll();
    }

    public function getProductById($id){
        $sql = 'SELECT * FROM productos WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(['id' => $id]);
        return $stmt->fetch();
    }

    public function getProductsByName($nombre)
    {
        // Preparamos la consulta SQL usando LIKE para buscar coincidencias parciales
        $sql = 'SELECT * FROM productos WHERE nombre LIKE :nombre';

        // Preparamos la consulta
        $stmt = $this->pdo->prepare($sql);

        // Ejecutamos la consulta con el parámetro
        // '%$nombre%' permite buscar productos que contengan la palabra ingresada
        $stmt->execute(['nombre' => '%' . $nombre . '%']);

        // Devolver los resultados
        return $stmt->fetchAll();
    }
    public function updateProduct($data){
        $sql = 'UPDATE productos SET nombre = :nombre, descripcion = :descripcion, precio =
        :precio, categoria_id = :categoria_id WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute($data);
        return $stmt->rowCount();
    }

    public function insertProduct($nombre, $descripcion, $precio, $stock, $categoria, $foto, $video, $estado) {
        try {
            $sql = "INSERT INTO productos (nombre, descripcion, precio, stock, categoria_id, foto, video, estado) 
                    VALUES (:nombre, :descripcion, :precio, :stock, :categoria, :foto, :video, :estado)";
            
            $stmt = $this->pdo->prepare($sql);
            
            // Ejecutamos la consulta directamente pasando los valores en un array asociativo
            return $stmt->execute([
                ':nombre' => $nombre,
                ':descripcion' => $descripcion,
                ':precio' => $precio,      // Los decimales se manejan como strings
                ':stock' => $stock,
                ':categoria' => $categoria,
                ':foto' => $foto,
                ':video' => $video,
                ':estado' => $estado
            ]);
            
        } catch (PDOException $e) {
            // Manejo de errores
            error_log('Error al insertar el productos: ' . $e->getMessage());
            return false; // Retornar false si hubo algún error
        }
    }
}
