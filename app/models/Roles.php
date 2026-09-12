<?php
class Roles extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }
    public function getRolIdCliente()
    {
        $sql = "SELECT id FROM roles WHERE nombre = 'cliente'";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    // Obtener todas las categorías

    public function getAllRoles()
    {
        $sql = 'SELECT * FROM roles';
        return $this->pdo->query($sql)->fetchAll();
    }

    public function create($createData)
    {
        try {
            $sql = "INSERT INTO `roles` (nombre)
            VALUES (:nombre)";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute($createData);

            return $this->pdo->lastInsertId();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }
}
