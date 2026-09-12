<!-- Barra de navegación scrollable -->

<!-- recibe $categorias -->
<nav class="fuente-regular navbar navbar-expand-lg navbar-light bg-secondary">
    <div class="container-fluid">
        <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#navbarOffcanvas"
            aria-controls="navbarOffcanvas" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon "></span>
            <span class="nav-text text-primary">Categorías</span> <!-- Texto junto al botón -->
        </button>

        <div class="offcanvas offcanvas-start fuente-regular" tabindex="-1" id="navbarOffcanvas"
            aria-labelledby="navbarOffcanvasLabel">
            <div class="offcanvas-header bg-secondary">
                <h1>Categorias</h1>
                <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"
                    aria-label="Close"></button>
            </div>
            <div class="offcanvas-body bg-secondary">

                <ul class="navbar-nav justify-content-start flex-grow-1 pe-3">

                    <?php foreach ($categorias as $categoria): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="<?= APP_URL ?>productos/obtenerProductosPorCategoria/<?= intval($categoria['id']) ?>">
                                <?= $categoria['nombre']; ?>
                            </a>
                        <?php endforeach; ?>

                </ul>
            </div>
        </div>
    </div>
</nav>