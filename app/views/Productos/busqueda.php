<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Busqueda</title>

    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/app.css">
</head>

<body class="d-flex flex-column min-vh-100">

    <?php
    include_once VIEWS_PATH . "Layout/header.php";
    include_once VIEWS_PATH . "Layout/navbar.php";

    if(!empty($mensaje)){
        echo "<div class='alert alert-warning container mt-3'>
            $mensaje
        </div>";
    }else{
        include_once VIEWS_PATH . "Layout/cardsProductos.php";

    }
    // echo "<pre>";
    // print_r($productosBuscados);
    // echo "</pre>";
    include_once VIEWS_PATH . "Layout/carrito.php";
    include_once VIEWS_PATH . "Layout/whatsapp.php";
    include_once VIEWS_PATH . "Layout/asistente.php";
    include_once VIEWS_PATH . "Layout/footer.php";
    ?>