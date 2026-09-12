<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $nombreCategoria ?></title>

    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/app.css">
</head>

<body class="d-flex flex-column min-vh-100">
    <!-- contenido principal -->
    <!-- Ajustamos body para que el footer este siempre abajo -->
    <?php
    include_once VIEWS_PATH . "Layout/header.php"; //header con buscdor
    include_once VIEWS_PATH . "Layout/navbar.php"; //navbar con categorias
    include_once VIEWS_PATH . "Layout/cardsProductos.php"; //cards con productos
    ?>
    <!-- contenido principal -->
    <?php
    
    include_once VIEWS_PATH . "Layout/carrito.php";
    include_once VIEWS_PATH . "Layout/asistente.php";
    include_once VIEWS_PATH . "Layout/whatsapp.php";
    include_once VIEWS_PATH . "Layout/footer.php";
    ?>