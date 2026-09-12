<?php
require_once CORE_PATH."Database.php";
class Categorias extends Database{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }
    // Obtener todas las categorías
    public function getAll()
    {
        $stmt = $this->pdo->query("SELECT * FROM categorias ORDER BY nombre ASC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    public function getById($id_categoria){
        $sql = 'SELECT * FROM categorias WHERE id=:id_categoria';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_categoria' => $id_categoria]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function getEnableCategories()
    {
        $sql = 'SELECT * FROM categorias WHERE estado = 1 ORDER BY nombre ASC;';
        return $this->pdo->query($sql)->fetchAll();
    }
    public function getNameByCategoria($id_categoria){
        $sql = 'SELECT nombre FROM categorias WHERE id = :id_categoria';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':id_categoria' => $id_categoria]);

        return $stmt->fetch();
    }

    public function create($data){
        $sql = 'INSERT INTO categorias (nombre, estado) VALUES (:nombre,
        :estado)';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':nombre' => $data['nombre'], ':estado' => $data['estado']]);
        return $this->pdo->lastInsertId();
    }

    public function update($data){
        $sql = 'UPDATE categorias SET nombre = :nombre, estado = :estado WHERE id = :id';
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([':nombre' => $data['nombre'], ':estado' => $data['estado'], ':id' => $data['id']]);
        return $stmt->rowCount();
    }

    // public function deleteById($id){
    //     $sql = 'DELETE FROM categorias WHERE id = :id';
    //     $stmt = $this->pdo->prepare($sql);
    //     $stmt->execute([':id' => $id]);
    // }

    public function deleteById($id) {
        // Comprobar si existen productos en la categoría antes de eliminarla
        $sqlCheck = 'SELECT COUNT(*) FROM productos WHERE categoria_id = :id';
        $stmtCheck = $this->pdo->prepare($sqlCheck);
        $stmtCheck->execute([':id' => $id]);
        $productCount = $stmtCheck->fetchColumn();
    
        if ($productCount > 0) {
            // Lanza una excepción o devuelve un mensaje de error si hay productos asociados
            throw new Exception("No se puede eliminar la categoría porque tiene productos asociados.");
        }
    
        // Si no hay productos, procede con la eliminación de la categoría
        $sqlDelete = 'DELETE FROM categorias WHERE id = :id';
        $stmtDelete = $this->pdo->prepare($sqlDelete);
        $stmtDelete->execute([':id' => $id]);
    
        return "Categoría eliminada exitosamente.";
    }
    


}
?>

