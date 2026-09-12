<?php

class Database
{
    // Variables estáticas para almacenar la instancia PDO
    private static $pdo;

    // Constructor privado para evitar la creación directa de instancias
    //private function __construct() {}

    // Método para obtener la instancia de la conexión
    protected static function connect()
    {
        // Si la conexión ya ha sido creada, la retorna
        if (self::$pdo !== null) {
            return self::$pdo;
        }

        // Configuración de la base de datos
        $config = [
            'host'     => 'localhost',
            'port'     => '3306',
            'dbname'   => 'abiccion',
            'user'     => 'root',
            'password' => '',
        ];

        // Opciones de la conexión PDO
        $options = [
            PDO::ATTR_EMULATE_PREPARES   => false, // Desactiva la emulación de consultas preparadas
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Lanza excepciones en caso de error
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Establece el modo de recuperación por defecto
            PDO::ATTR_STRINGIFY_FETCHES  => false, // Evita la conversión automática de números a strings
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4', // Usa el conjunto de caracteres utf8mb4
        ];

        // Intenta establecer la conexión y almacenar la instancia
        try {
            self::$pdo = new PDO(
                "mysql:host={$config['host']};
                port={$config['port']};
                dbname={$config['dbname']};
                charset=utf8mb4",
                $config['user'],
                $config['password'],
                $options
            );

            if (is_object(self::$pdo)) {
                //echo "<p>CONECTADO A: {$config['dbname']}</p>";
            }

            return self::$pdo;
        } catch (PDOException $e) {
            echo "<p>ERROR DE CONEXIÓN CON LA BASE DE DATOS: {$e->getMessage()}</p>";
            error_log('ERROR DE CONEXIÓN CON LA BASE DE DATOS: ' . $e->getMessage());
            throw new Exception('ERROR DE CONEXIÓN CON LA BASE DE DATOS');
        }
    }

    // Evita la clonación de la instancia
    private function __clone() {}

    // Evita la deserialización de la instancia
    public function __wakeup() {}
}
