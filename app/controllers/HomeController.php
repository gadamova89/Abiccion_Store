<?php
    require_once  MODELS_PATH."Categorias.php";
    require_once  MODELS_PATH."Productos.php";
    class HomeController
    {
        private $categorias;
        private $productos;

        public function __construct() {
            $this->categorias = new Categorias();
            $this->productos = new Productos();
        }

        public function index() {
            $categorias = $this->categorias->getEnableCategories();
            $ids = array_column($categorias, 'id');
            $idRandom= $ids[array_rand($ids)];
            //echo "id random es: $idRandom";
            $cardsProductos = $this->productos->getProductsByCategory($idRandom);
            //print_r($categorias);
            //print_r( $productosPorCategoria);
            require_once VIEWS_PATH.'Home/index.php';
        }
    }
    
