<div id="contenedor-productos">
    <div class="bg-primary sticky-top w-100 pb-2 "> <!-- Contenedor principal -->
        <div class="row w-100 py-3 align-items-center mb-0"> <!-- alineación vertical y margen inferior eliminado -->
            <div class="col-auto"> <!-- Columna para el texto -->
                <h1 class="fuente-regular fs-3 mb-0">Productos</h1> <!-- Eliminar márgenes si es necesario -->
            </div>
            <div class="col-auto"> <!-- Columna para el botón -->
                <a id="btnAgregarProducto" data-url="<?= APP_URL ?>productos/crearProducto" class="btn btn-success btn-sm">
                    Agregar Producto
                    <i class="bi bi-plus-lg"></i>
                </a>
            </div>
        </div>
        <div class="row mb-0"> <!-- Nueva fila para el buscador -->
            <div class="col-4"> <!-- Columna para el buscador -->
                <input type="text" id="buscarProducto" class="form-control" placeholder="Buscar productos...">
            </div>
        </div>
    </div>

    <!-- Campo de búsqueda -->

    <!-- Tarjetas de productos -->
    <div class="row py-2" id="productosContainer">
        <?php foreach ($cardsProductos as $producto): ?>
            <!-- Cambia col-md-4 por col-md-3 o col-md-2 para hacer más chicas las tarjetas -->
            <div class="col-md-3 mb-3 d-flex align-items-stretch producto-item">
                <div class="card h-100">

                    <!-- Contenedor con proporción fija -->
                    <div class="ratio ratio-4x3">
                        <?php if (!empty($producto['video'])): ?>
                            <video src="<?= UPLOADS_URL . htmlspecialchars($producto['video']); ?>"
                                class="w-100 h-100"
                                controls></video>
                        <?php elseif (!empty($producto['foto'])):
                            $fotos = explode(',', $producto['foto']); ?>
                            <img src="<?= UPLOADS_URL . htmlspecialchars(trim($fotos[0])); ?>"
                                class="w-100 h-100"
                                alt="Imagen del producto">
                        <?php endif; ?>
                    </div>

                    <div class="card-body p-2">
                        <h6 class="card-title mb-1"><?= $producto['nombre']; ?></h6>
                        <p class="card-text small mb-1"><?= $producto['descripcion']; ?></p>
                        <p class="card-text fw-bold mb-1"><?= $producto['precio']; ?> Bs.</p>
                        <p class="card-text mb-2">Stock: <?= $producto['stock']; ?></p>

                        <div class="d-flex flex-wrap gap-1">
                            <a class="btn btn-sm btn-secondary fw-semibold">Actualizar</a>
                            <a href="#" class="btn btn-sm btn-danger">Eliminar</a>
                            <a href="#" class="btn btn-sm btn-warning">Ocultar</a>
                        </div>
                    </div>

                </div>
            </div>
        <?php endforeach; ?>
    </div>


</div>

<script>
    // Filtrar productos usando jQuery
    $(document).ready(function() {
        $('#buscarProducto').on('keyup', function() {
            var valorBusqueda = $(this).val().toLowerCase();
            $('.producto-item').filter(function() {
                $(this).toggle($(this).find('.card-title').text().toLowerCase().indexOf(valorBusqueda) > -1);
            });
        });
    });
</script>

<!-- loader form agregar productos -->
<script>
    $(document).ready(function() {
        $('#btnAgregarProducto').click(function(e) {
            e.preventDefault(); // Evitar que el enlace redirija la página

            var url = $(this).data('url'); // Obtener la URL del atributo data-url

            // Hacer una solicitud AJAX para cargar la vista de creación de producto
            $.ajax({
                url: url,
                method: 'GET',
                success: function(response) {
                    // Insertar el contenido de la respuesta en el contenedor
                    $('#contenedor-productos').html(response);
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error);
                    alert('Hubo un error al cargar la vista de creación de producto.');
                }
            });
        });
    });
</script>
<!-- FIN loader form agregar productos -->

<!-- para cargar los datos del usuario en el form de editar -->
<script>
    $(document).on('click', '.btn-editar', function(e) {
        e.preventDefault();
        var productId = $(this).data('id'); // Obtener ID del producto
        $.ajax({
            url: '<?= APP_URL ?>Productos/editarProducto/' + productId,
            method: 'GET',
            success: function(response) {
                $('#contenedor-productos').html(response); // Cargar la vista de edición en el contenedor
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Ocurrió un error al cargar la vista de edición del producto.');
            }
        });
    });
</script>

<!-- FIN para cargar los datos del usuario en el form de editar -->