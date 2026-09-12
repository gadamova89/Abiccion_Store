<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error</title>

    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/app.css">
</head>

<body class="d-flex flex-column min-vh-100">


    <!-- Ajustamos body para que el footer este siempre abajo -->
    <?php
    include_once VIEWS_PATH . "layout/header.php";
    ?>
    <!-- fin header -->
    <!-- contenido principal -->
    <div class="container">
        <!-- 404 Start -->
    <div class="container-fluid py-5">
        <div class="container py-5 text-center">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <i class="display-1 text-danger"><svg xmlns="http://www.w3.org/2000/svg" width="150" height="150" fill="currentColor" class="bi bi-exclamation-triangle-fill" viewBox="0 0 16 16">
  <path d="M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5m.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2"/>
</svg></i>
                    <h1 class="display-1 fuente-bold">404</h1>
                    <h1 class="mb-4 fuente-bold">Página no encontrada</h1>
                    <p class="mb-4 fuente-thin fs-4">"Lo sentimos, la página que ha buscado no existe en nuestro sitio web. ¿Vaya a nuestra página de inicio o intente usar la búsqueda?"
                    </p>
                    <a class="btn bg-secondary rounded-pill py-3 px-5 fuente-regular fs-3" href="<?=APP_URL?>home">Inicio</a>
                </div>
            </div>
        </div>
    </div>
    <!-- 404 End -->


    </div>
    <!-- contenido principal -->



    </div>


    <?php
    include_once VIEWS_PATH . "layout/whatsapp.php";
    include_once VIEWS_PATH . "layout/footer.php";
    ?>
    <!-- agrego boootstrap↓↓↓ -->