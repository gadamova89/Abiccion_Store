<?php
//require_once  MODELS_PATH."Productos.php";
//require_once  MODELS_PATH."Categorias.php";
final class ProductosController
{
    private $productos;
    private $categorias;
    public function __construct()
    {
        $this->productos = new Productos();
        $this->categorias = new Categorias();

    }
    //para la pagina de resultados de busqueda
    public function obtenerProductosPorCategoria($id_categoria)
    {
        //echo "<br>";
        //var_dump($id_categoria[0]);
        //echo "<br>";
        $categoriaBuscada=intval($id_categoria);
        $categorias = $this->categorias->getEnableCategories();
        $nombreCategoria= $this->categorias->getNameByCategoria($categoriaBuscada);
        $nombreCategoria= $nombreCategoria['nombre'];
        try {
            $cardsProductos=$this->productos->getProductsByCategory($categoriaBuscada);
            require_once VIEWS_PATH . "Productos/categoriaSeleccionada.php";
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    //esta la usamos en el buscador
    public function buscarProductosPorNombre() {
        //var_dump($params);
        $categorias = $this->categorias->getEnableCategories();        
        $mensaje = ""; // Inicializar el mensaje
        $productosBuscados = []; // Inicializar la variable para los productos
        $nombreProductoBuscado= $_GET['nombre'];
    
        if (isset($_GET['nombre'])) {
            $nombreProducto = trim($_GET['nombre']); // Elimina espacios en blanco alrededor
    
            if (empty($nombreProducto)) {
                $mensaje = "No se ha proporcionado un nombre válido para el producto";
            } else {
                // Llamar al modelo para obtener los productos por nombre
                $cardsProductos = $this->productos->getProductsByName($nombreProductoBuscado);
                //var_dump($cardsProductos);
    
                if (empty($cardsProductos)) {
                    // Asignamos un mensaje si no hay productos
                    $mensaje = "No hay resultados para esa búsqueda.";
                }
            }
        } else {
            $mensaje = "No se ha proporcionado el nombre del producto";
        }
        // Cargar la vista con los productos buscados y el mensaje
        require_once VIEWS_PATH . "Productos/busqueda.php";
        
    }

    public function crearProducto(){
        $categorias = $this->categorias->getAll();
        require_once VIEWS_PATH."Productos/crear.php";
    }
    
    public function guardarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // var_dump($_FILES['fotos']);
            // exit;
            // Obtener los datos del formulario
            $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : '';
            $descripcion = isset($_POST['descripcion']) ? trim($_POST['descripcion']) : '';
            $precio = isset($_POST['precio']) ? floatval($_POST['precio']) : 0.0;
            $stock = isset($_POST['stock']) ? intval($_POST['stock']) : 0;
            $categoria = isset($_POST['categoria']) ? intval($_POST['categoria']) : 0;
            $estado = isset($_POST['estado']) ? intval($_POST['estado']) : 1;
    
            $fotoArray = [];
            $video = null;
    
            // Validar campos requeridos
            if (empty($nombre) || empty($descripcion) || $precio <= 0 || $stock < 0 || $categoria <= 0) {
                $mensaje = "Por favor, complete todos los campos obligatorios correctamente.";
                require_once VIEWS_PATH . 'Productos/agregar.php';
                return;
            }
    
            // Manejar la subida de múltiples fotos
            if (isset($_FILES['fotos']) && $_FILES['fotos']['error'][0] === UPLOAD_ERR_OK) {
                $directorioFotos = 'uploads/';
    
                foreach ($_FILES['fotos']['tmp_name'] as $key => $tmpName) {
                    $nombreFotoOriginal = basename($_FILES['fotos']['name'][$key]);
                    
                    $extensionFoto = pathinfo($nombreFotoOriginal, PATHINFO_EXTENSION);
                    $nombreFoto = time() . '_' . uniqid() . '.' . $extensionFoto;
                    
                    $rutaFoto = $directorioFotos . $nombreFoto;
    
                    // Mover la foto al servidor
                    if (move_uploaded_file($tmpName, $rutaFoto)) {
                        $fotoArray[] = $nombreFoto;
                    } else {
                        error_log("Error al mover la foto: " . $_FILES['fotos']['error'][$key]);
                    }
                }
            } else {
                error_log("Error en el archivo de fotos: " . $_FILES['fotos']['error'][0]);
            }
    
            // Convertir el array de fotos en una cadena separada por comas
            $fotos = implode(',', $fotoArray);
    
            // Manejar la subida del video (opcional)
            if (isset($_FILES['video']) && $_FILES['video']['error'] === UPLOAD_ERR_OK) {
                $directorioVideos = 'uploads/';  // Asegúrate de usar una ruta válida del sistema de archivos
                $nombreVideoOriginal = basename($_FILES['video']['name']);
                
                $extensionVideo = pathinfo($nombreVideoOriginal, PATHINFO_EXTENSION);
                $nombreVideo = time() . '_' . uniqid() . '.' . $extensionVideo;
                
                $rutaVideo = $directorioVideos . $nombreVideo;
    
                if (move_uploaded_file($_FILES['video']['tmp_name'], $rutaVideo)) {
                    $video = $nombreVideo;
                } else {
                    error_log("Error al mover el video: " . $_FILES['video']['error']);
                }
            }
    
            // Inserta el producto en la base de datos
            $productoInsertado = $this->productos->insertProduct($nombre, $descripcion, $precio, $stock, $categoria, $fotos, $video, $estado);
    
            if ($productoInsertado) {
                $mensaje = "El producto se ha agregado correctamente.";
            } else {
                $mensaje = "Hubo un problema al agregar el producto. Intente nuevamente.";
            }
    
            $cardsProductos = $this->productos->getAllByDate();
            $categorias = $this->categorias->getAll();
            require_once VIEWS_PATH . 'Productos/administradorProductos.php';
        } else {
            header('Location: ' . BASE_URL . '/productos/agregar');
        }
    }
    


    public function administrarProductos(){
        //echo "hola desde administrar";
        $categorias = $this->categorias->getAll();
        $cardsProductos = $this->productos->getAllByDate();

        require_once VIEWS_PATH."Productos/administradorProductos.php";

    }

    public function verProducto($id){
        $producto = $this->productos->getProductById($id);
        $categorias = $this->categorias->getAll();
        require_once VIEWS_PATH.'Productos/detallesProducto.php';
    }
    
    public function editarProducto($id){
        $producto=$this->productos->getProductById($id);
        //var_dump($producto);
        $categorias = $this->categorias->getAll();
        require_once VIEWS_PATH.'Productos/editar.php';
    }
    public function actualizarProducto(){
        //echo "desde actualizar<br>";
        $id = $_POST['id'];
        $nombre = $_POST['nombre'];
        $descripcion = $_POST['descripcion'];
        $precio = $_POST['precio'];
        $stock = $_POST['stock'];
        $categoria = $_POST['categoria'];
        $estado = $_POST['estado'];
    
        // Verificar si se han subido archivos de fotos
        $fotos = [];
        if (isset($_FILES['fotos']) && $_FILES['fotos']['error'][0] == 0) {
            foreach ($_FILES['fotos']['tmp_name'] as $key => $tmp_name) {
                $file_name = $_FILES['fotos']['name'][$key];
                $file_tmp = $_FILES['fotos']['tmp_name'][$key];
    
                // Aquí puedes mover los archivos a una carpeta y guardar las rutas en el arreglo de fotos
                $rutaDestino = APP_PATH."uploads/" . $file_name; // Cambia 'uploads/' a tu carpeta de destino
                if (move_uploaded_file($file_tmp, $rutaDestino)) {
                    $fotos[] = $rutaDestino;
                }
            }
        }
        // Verificar si se ha subido un archivo de video
        $video = null;
        if (isset($_FILES['video']) && $_FILES['video']['error'] == 0) {
            $video_name = $_FILES['video']['name'];
            $video_tmp = $_FILES['video']['tmp_name'];
            
            // Guardar el video en la carpeta de destino
            $rutaDestinoVideo = APP_PATH.'uploads/' . $video_name; // Cambia 'uploads/' a tu carpeta de destino
            if (move_uploaded_file($video_tmp, $rutaDestinoVideo)) {
                $video = $rutaDestinoVideo;
            }
        }
    
        // Crear arreglo de datos a actualizar
        $updateData = [
            'id' => $id,
            'nombre' => $nombre,
            'descripcion' => $descripcion,
            'precio' => $precio,
            'stock' => $stock,
            'categoria' => $categoria,
            'fotos' => implode(',', $fotos), // Guardar rutas de fotos como cadena separada por comas
            'video' => $video,
            'estado' => $estado
        ];
        var_dump($updateData);
        $this->productos->updateProduct($updateData);
    
        // Imprimir el arreglo de datos para depuración
        $cardsProductos = $this->productos->getAllByDate();
        $categorias = $this->categorias->getAll();
        require_once VIEWS_PATH . 'Productos/administradorProductos.php';
    }
    
    ////////////////////////////////
    public function pruebarRoles() {
        // Verificar si el usuario es vendedor o admin
        if (Utils::hasRole('vendedor') || Utils::hasRole('admin')) {
            // Mostrar la vista de creación de productos
            require_once 'views/producto/crear.php';
        } else {
            echo "Acceso denegado";
            exit;
        }
    }
    
    
    
    

}

?>