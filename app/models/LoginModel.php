<?php

class LoginModel extends Database
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = parent::connect();
    }

    public function readAll(): array
    {
        $sql = "SELECT * FROM roles";
        return $this->pdo->query($sql)->fetchAll();
    }

    public function usernameExists(string $userName): array | bool
    {
        try {
            $sql = "SELECT
                nombre_usuario,
                estado
            FROM
                `usuarios`
            WHERE
                BINARY `nombre_usuario` = :nombre_usuario LIMIT 1";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$userName]);

            return $stmt->fetch();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function getDBPassword(string $userName): string
    {
        try {
            $sql  = "SELECT password FROM usuarios WHERE nombre_usuario = :nombre_usuario";

            $stmt = $this->pdo->prepare($sql);

            $stmt->execute([$userName]);

            return $stmt->fetch()['password'];
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function passwordVerify($password, $dbPasswordHash): bool
    {
        try {
            return ($dbPasswordHash && password_verify($password, $dbPasswordHash));
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }

    public function initUserSession($userName)
    {
        try {
            $sql = "SELECT
                U.id,
                U.nombres,
                U.apellidos,
                U.estado,
                R.nombre AS rol,
                password
            FROM
                usuarios U
            INNER JOIN roles R ON
                R.id = U.rol_id
            WHERE
                U.nombre_usuario = '{$userName}'";

            $datosUsuario = $this->pdo->query($sql)->fetch();

            $_SESSION['nombres']    = $datosUsuario['nombres'];
            $_SESSION['apellidos']  = $datosUsuario['apellidos'];
            $_SESSION['rol']        = $datosUsuario['rol'];
            $_SESSION['estado']     = $datosUsuario['estado'];
            $_SESSION['status']     = 'OK';
            $_SESSION['login_time'] = time();
        } catch (PDOException $e) {
            die("<p>ERROR!<br>{$e->getMessage()}</p>");
        }
    }
}
