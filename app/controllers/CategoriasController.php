<?php
class CategoriasController
{
    private $categorias;
    public function __construct()
    {
        $this->categorias = new Categorias();
    }

    public function obtenerCategorias()
    {
        try {
            return $this->categorias->getAll();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    public function obtenerCategoriasporId($id) //json
    {
        try {
            $registro = $this->categorias->getById($id);
            //var_dump($registro);
            echo json_encode($registro);
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
    public function administrarCategorias()
    {

        $registros = $this->categorias->getAll();
        require_once VIEWS_PATH . "Categorias/editorCategorias.php";
    }
    public function crearCategoria()
    {
        $nombre = $_POST['nombre'];
        $estado = isset($_POST['estado']) ? 1 : 0;

        $createData = [
            "nombre" => $nombre,
            "estado" => $estado
        ];
        //var_dump($createData);
        $this->categorias->create($createData);
        $registros = $this->categorias->getAll();
        require_once VIEWS_PATH . "Categorias/editorCategorias.php";
    }

    public function editarCategoria()
    {
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $estado = isset($_POST['estado']) ? 1 : 0;

        $updateData = [
            "id" => $id,
            "nombre" => $nombre,
            "estado" => $estado
        ];
        $this->categorias->update($updateData);
        $registros = $this->categorias->getAll();
        require_once VIEWS_PATH . "Categorias/editorCategorias.php";
    }

    // public function eliminarCategoria()
    // {
    //     $id = $_POST['id'];
    //     $this->categorias->deleteById($id); //aqui obtengo los datos para la tabla
    //     $registros = $this->categorias->getAll();
    //     require_once VIEWS_PATH . "Categorias/editorCategorias.php"; //aqui simplemente la llamo

    // }
    public function eliminarCategoria()
    {
        $id = $_POST['id'];

        try {
            // Intentar eliminar la categoría
            $this->categorias->deleteById($id);

            // Obtener todos los registros de categorías para actualizar la vista
            $registros = $this->categorias->getAll();

            // Mostrar mensaje de éxito
            $mensaje = "Categoría eliminada exitosamente.";
        } catch (Exception $e) {
            // Capturar el mensaje de error si no se puede eliminar la categoría
            $mensaje = $e->getMessage();

            // Obtener los registros de categorías de nuevo para mostrar la vista actualizada
            $registros = $this->categorias->getAll();
        }

        // Cargar la vista y pasar el mensaje para mostrarlo al usuario
        require_once VIEWS_PATH . "Categorias/editorCategorias.php";
    }
}
