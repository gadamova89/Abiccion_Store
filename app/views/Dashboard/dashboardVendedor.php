<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Empleados</title>

    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/app.css">
    <script src="<?= PUBLIC_URL ?>assets/js/jquery.min.js"></script>
    <style>
        /* Forzamos que el contenido se desplace mientras el menú lateral permanece fijo */
        #contenido {
            height: 100vh;
            overflow-y: auto;
            /* Desplazamiento vertical solo en el contenido */
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">
    <?php
    //include_once VIEWS_PATH . "Layout/logo.php";
    ?>

    <div class="container-fluid">
        <div class="row flex-nowrap">
            <div class="bg-secondary border-accent col-auto col-md-3 col-xl-2 px-sm-2 px-0 bg-dark position-sticky" ">
                <div class=" d-flex flex-column align-items-center align-items-sm-start px-3 text-white min-vh-100">


                <ul class="nav nav-pills flex-column mb-sm-auto mb-0 align-items-center align-items-sm-start" id="menu">
                    <li>
                        <a href="<?= APP_URL ?>" class="nav-link px-0">
                            <!-- Mostrar solo la "A" en pantallas pequeñas -->
                            <span class="d-inline d-sm-none display-3">A</span>

                            <!-- Mostrar solo el logo en pantallas medianas o más grandes -->
                            <img class="img-fluid d-none d-sm-inline" src="<?= PUBLIC_URL ?>assets/img/logo.png" alt="logo" style="max-width: 200px;">
                        </a>
                    </li>

                    <span class="fs-5 d-none d-sm-inline fw-bold">Menu </span>


                    <li>

                        <ul class="collapse show nav flex-column ms-1" id="submenu1" data-bs-parent="#menu">

                            <li class="w-100">
                                <a href="#" class="nav-link px-0 btn-ajax" data-url="<?= APP_URL ?>Usuarios/obtenerTablaClientes"> <span class="d-none d-sm-inline">Clientes</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-people-fill" viewBox="0 0 16 16">
                                        <path d="M7 14s-1 0-1-1 1-4 5-4 5 3 5 4-1 1-1 1zm4-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6m-5.784 6A2.24 2.24 0 0 1 5 13c0-1.355.68-2.75 1.936-3.72A6.3 6.3 0 0 0 5 9c-4 0-5 3-5 4s1 1 1 1zM4.5 8a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                    </svg>

                                </a>
                            </li>


                            <li>
                                <a href="#" class="nav-link px-0 btn-ajax"> <span class="d-none d-sm-inline">Pedidos</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-check-fill" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0m-.646 5.354a.5.5 0 0 0-.708-.708L7.5 10.793 6.354 9.646a.5.5 0 1 0-.708.708l1.5 1.5a.5.5 0 0 0 .708 0z" />
                                    </svg>

                                </a>
                            </li>
                        </ul>
                    </li>

                    <li>
                        <a href="#" class="nav-link px-0 align-middle btn-ajax">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Reportes</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-piggy-bank-fill" viewBox="0 0 16 16">
                                <path d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069q0-.218-.02-.431c.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a1 1 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.74.74 0 0 0-.375.562c-.024.243.082.48.32.654a2 2 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595m7.173 3.876a.6.6 0 0 1-.098.21l-.044-.025c-.146-.09-.157-.175-.152-.223a.24.24 0 0 1 .117-.173c.049-.027.08-.021.113.012a.2.2 0 0 1 .064.199m-8.999-.65a.5.5 0 1 1-.276-.96A7.6 7.6 0 0 1 7.964 3.5c.763 0 1.497.11 2.18.315a.5.5 0 1 1-.287.958A6.6 6.6 0 0 0 7.964 4.5c-.64 0-1.255.09-1.826.254ZM5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0" />
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link px-0 align-middle btn-ajax" data-url="<?= APP_URL ?>Productos/obtenerCardsProductos">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Productos</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-seam-fill" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M15.528 2.973a.75.75 0 0 1 .472.696v8.662a.75.75 0 0 1-.472.696l-7.25 2.9a.75.75 0 0 1-.557 0l-7.25-2.9A.75.75 0 0 1 0 12.331V3.669a.75.75 0 0 1 .471-.696L7.443.184l.01-.003.268-.108a.75.75 0 0 1 .558 0l.269.108.01.003zM10.404 2 4.25 4.461 1.846 3.5 1 3.839v.4l6.5 2.6v7.922l.5.2.5-.2V6.84l6.5-2.6v-.4l-.846-.339L8 5.961 5.596 5l6.154-2.461z" />
                            </svg>
                        </a>
                    </li>

                    <li>
                        <a href="#" class="nav-link px-0 align-middle btn-ajax" data-url="<?= APP_URL ?>Categorias/obtenerTablaCategorias">
                            <i class="fs-4 bi-table"></i> <span class="ms-1 d-none d-sm-inline">Categorias</span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-tags-fill" viewBox="0 0 16 16">
                                <path d="M2 2a1 1 0 0 1 1-1h4.586a1 1 0 0 1 .707.293l7 7a1 1 0 0 1 0 1.414l-4.586 4.586a1 1 0 0 1-1.414 0l-7-7A1 1 0 0 1 2 6.586zm3.5 4a1.5 1.5 0 1 0 0-3 1.5 1.5 0 0 0 0 3" />
                                <path d="M1.293 7.793A1 1 0 0 1 1 7.086V2a1 1 0 0 0-1 1v4.586a1 1 0 0 0 .293.707l7 7a1 1 0 0 0 1.414 0l.043-.043z" />
                            </svg>
                        </a>
                    </li>

                    
                    <hr>

                    <li>
                        <div class="dropdown ">
                            <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                                <!-- <img src="" alt="hugenerd" width="30" height="30" class="rounded-circle"> -->
                                <span class="d-none d-sm-inline mx-1 display-5"><?= $_SESSION['nombres'] ?></span>
                            </a>
                            <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                                <li><a class="dropdown-item" href="<?= APP_URL ?>login/logout">Salir</a></li>
                            </ul>
                        </div>

                    </li>

                </ul>


            </div>
        </div>

        <div class="col overflow-auto" id="contenido">

        </div>
    </div>
    </div>
    <script src="<?= PUBLIC_URL ?>assets/js/bootstrap.bundle.js"></script>

    <!-- manejador ajax botones laterales -->
    <script>
        $(document).ready(function() {
            // Manejador de eventos para todos los botones con la clase "btn-ajax"
            $('.btn-ajax').click(function(e) {
                e.preventDefault(); // Prevenir la navegación del enlace

                var url = $(this).data('url'); // Obtener la URL del atributo data-url
                var contenidoDiv = $('#contenido'); // Div donde se mostrará la respuesta

                // Realizar la solicitud AJAX
                $.ajax({
                    url: url,
                    method: 'GET',
                    beforeSend: function() {

                        contenidoDiv.html('<p>Cargando...</p>'); // Mostrar mensaje de carga
                    },
                    success: function(response) {
                        console.log(response); // Imprimir respuesta en consola para verificar
                        contenidoDiv.html(response); // Inyectar la respuesta en el div
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error); // Log de error
                        contenidoDiv.html('<p>Error al cargar los datos.</p>'); // Mensaje de error
                    }
                });
            });
        });
    </script>
    <!-- FIN manejador ajax botones laterales -->

    



</body>