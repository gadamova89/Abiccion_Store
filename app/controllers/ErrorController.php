<?php
// definir clase controladora de errores 404
require_once  MODELS_PATH."Productos.php";
class errorController{
    private $categorias;
        private $productos;

        public function __construct() {
            
            $this->productos = new Productos();
        }
    public function index() {
        require_once VIEWS_PATH."Errors/index.php";
    }
    
}
