<div class="container">
    <!-- card -->
    <div class="container mt-4">
        <div class="row">
            <?php foreach ($cardsProductos as $producto): ?>
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 100%;">

                        <!-- Carousel para imágenes y videos -->
                        <div id="carouselExample<?= $producto['id']; ?>" class="carousel slide">
                            <div class="carousel-inner">

                                <?php
                                // Comenzamos con la bandera de si es la primera imagen/video
                                $firstItem = true;

                                // Mostrar el video primero si existe
                                if (!empty($producto['video'])): ?>
                                    <div class="carousel-item <?= $firstItem ? 'active' : ''; ?>">
                                        <video src="<?= UPLOADS_URL . htmlspecialchars($producto['video']); ?>" class="d-block w-100" controls></video>
                                    </div>
                                    <?php $firstItem = false; // Ya hemos mostrado el primer ítem 
                                    ?>
                                <?php endif; ?>

                                <?php
                                // Ahora procesamos las fotos
                                if (!empty($producto['foto'])):
                                    $fotos = explode(',', $producto['foto']); // Convertimos las fotos en un array
                                    foreach ($fotos as $index => $foto): ?>
                                        <div class="carousel-item <?= $firstItem ? 'active' : ''; ?>">
                                            <img src="<?= UPLOADS_URL . htmlspecialchars(trim($foto)); ?>" class="d-block w-100" alt="Imagen del producto">
                                        </div>
                                        <?php $firstItem = false; // Aseguramos que solo la primera sea activa 
                                        ?>
                                <?php endforeach;
                                endif; ?>

                            </div>

                            <!-- Controles del carrusel -->
                            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample<?= $producto['id']; ?>" data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#carouselExample<?= $producto['id']; ?>" data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>

                        <!-- Información del producto -->
                        <div class="card-body">
                            <h5 class="card-title"><?= $producto['nombre']; ?></h5>
                            <p class="card-text"><?= $producto['descripcion']; ?></p>
                            <p class="card-text display-6"><strong>Precio: </strong><?= $producto['precio']; ?> Bs.</p>

                            <!-- Botones -->
                            <a href="<?= APP_URL . 'Productos/verProducto/' . $producto['id'] ?>" class="btn bg-secondary fw-semibold text-accent">
                                Ver
                                <i><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                                        <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                                        <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                                    </svg></i>
                            </a>

                            <a href="home" class="btn bg-accent fw-semibold text-primary">
                                Añadir al carrito
                                <i class="bi bi-cart-plus"></i>
                            </a>

                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>

    <!-- card -->


</div>