<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesion</title>

    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/app.css">
</head>

<body class="d-flex flex-column min-vh-100 ">
    <?php
    include_once VIEWS_PATH . "Layout/logo.php";
    ?>

    <div class="container mb-5">
        <div class="row justify-content-center mt-5 fuente-regular">
            <div class="col-md-6">
                <div class="card bg-primary">
                    <div class="card-header bg-secondary ">
                        <h4 class="text-center text-primary">Iniciar Sesión</h4>
                    </div>
                    <div class="card-body">

                        <form action="<?= APP_URL ?>login/validarusuario" method="POST">
                            <div class="mb-3">
                                <label for="usuario" class="form-label text-accent">Usuario</label>
                                <input name="usuario" type="text" class="form-control border-accent" id="email" placeholder="Tu nombre de usuario" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label text-accent">Contraseña</label>
                                <input name="password" type="password" class="form-control border-accent" id="password" placeholder="Contraseña" required>
                            </div>
                            <!-- <div class="mb-3 form-check">
                                <input type="checkbox" class="form-check-input" id="remember">
                                <label class="form-check-label" for="remember">Recordarme</label>
                            </div> -->
                            <div>
                                <?php
                                if (!empty($mensaje)) {
                                    echo "<div class='alert alert-warning container my-2'>
                                        $mensaje
                                        </div>";
                                }
                                ?>
                            </div>
                            <div class="d-grid pb-2">
                                <button type="submit" class="btn bg-accent text-primary">Iniciar Sesión</button>
                            </div>
                            <div class="d-grid">
                                <a href="<?= APP_URL ?>Home" class="btn bg-secondary border-accent text-primary">Cancelar</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>





    <?php
    include_once VIEWS_PATH . "Layout/footer.php";
    ?>