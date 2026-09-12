<div id="contenedor-productos">
    <?php
    if(!empty($mensaje)){
        echo "<div class='alert alert-warning container mt-3'>
            $mensaje
        </div>";
    }
    ?>
    <form id="formAgregarProducto" action="<?= APP_URL ?>productos/guardarProducto" method="POST" class="d-flex fuente-regular" enctype="multipart/form-data">
        <!-- Nombre -->
        <div class="container mt-2">
            <h2>Agregar Producto:</h2>

            <div class="row">
                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" required>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio (Bs.)</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" required>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="col-md-6 mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required></textarea>
                </div>
            </div>

            <!-- Stock -->
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" required>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <option value="">Seleccionar Categoría</option>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id']; ?>"><?= $categoria['nombre']; ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Aquí modificamos el input para subir varias fotos -->
            <div class="mb-3">
                <label for="fotos" class="form-label">Fotos del producto (puedes subir varias)</label>
                <input type="file" class="form-control" id="fotos" name="fotos[]" accept="image/*" multiple>
            </div>

            <!-- Video -->
            <div class="mb-3">
                <label for="video" class="form-label">Video del producto (opcional)</label>
                <input type="file" class="form-control" id="video" name="video" accept="video/*">
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <button type="submit" class="btn bg-accent text-primary mb-5 fuente-regular">Agregar Producto</button>
                <button id="btnCancelar" class="btn bg-danger text-primary mb-5 fuente-regular" data-url="<?= APP_URL ?>Productos/administrarProductos" class="btn btn-secondary">Cancelar</button>
            </div>

        </div>
    </form>
</div>

<!-- loader form agregar productos -->
<script>
    $(document).ready(function() {
    $('#formAgregarProducto').on('submit', function(e) {
        e.preventDefault(); // Evita el envío normal del formulario

        // Crear un objeto FormData para incluir los archivos
        var formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'), // Obtiene la URL de acción del formulario
            method: $(this).attr('method'), // Obtiene el método del formulario (POST)
            data: formData, // Enviar el FormData, que incluye los archivos
            processData: false, // Evita que jQuery procese los datos
            contentType: false, // Evita que jQuery establezca el contentType
            success: function(response) {
                // Puedes mostrar una notificación o mensaje de éxito aquí
                alert("Producto agregado exitosamente.");

                // Después de agregar, puedes redirigir o actualizar la lista de productos
                $('#contenedor-productos').html(response); // Muestra la respuesta en el contenedor
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Hubo un error al agregar el producto.');
            }
        });
    });

    /////////////
    $('#btnCancelar').click(function(e) {
        e.preventDefault(); // Evitar que el enlace redirija la página

        var url = $(this).data('url'); // Obtener la URL del atributo data-url

        $.ajax({
            url: url,
            method: 'GET',
            success: function(response) {
                // Insertar el contenido de la respuesta en el contenedor
                $('#contenedor-productos').html(response);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Hubo un error al cargar la vista de producto.');
            }
        });
    });
});
</script>