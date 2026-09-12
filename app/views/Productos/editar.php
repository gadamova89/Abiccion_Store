<div id="contenedor-productos">
    <form id="formEditarProducto" action="<?= APP_URL ?>productos/actualizarProducto/" method="POST" class="d-flex fuente-regular" enctype="multipart/form-data">
        
        <!-- Campo oculto para enviar el ID del producto -->
        <input type="hidden" name="id" value="<?= htmlspecialchars($producto['id']); ?>">

        <!-- Nombre -->
        <div class="container mt-2">
            <h2>Editar Producto:</h2>

            <div class="row">
                <!-- Nombre -->
                <div class="col-md-6 mb-3">
                    <label for="nombre" class="form-label">Nombre del producto</label>
                    <input type="text" class="form-control" id="nombre" name="nombre" value="<?= htmlspecialchars($producto['nombre']); ?>" required>

                    <!-- Precio -->
                    <div class="mb-3">
                        <label for="precio" class="form-label">Precio (Bs.)</label>
                        <input type="number" step="0.01" class="form-control" id="precio" name="precio" value="<?= htmlspecialchars($producto['precio']); ?>" required>
                    </div>
                </div>

                <!-- Descripción -->
                <div class="col-md-6 mb-3">
                    <label for="descripcion" class="form-label">Descripción</label>
                    <textarea class="form-control" id="descripcion" name="descripcion" rows="4" required><?= htmlspecialchars($producto['descripcion']); ?></textarea>
                </div>
            </div>

            <!-- Stock -->
            <div class="mb-3">
                <label for="stock" class="form-label">Stock</label>
                <input type="number" class="form-control" id="stock" name="stock" value="<?= htmlspecialchars($producto['stock']); ?>" required>
            </div>

            <!-- Categoría -->
            <div class="mb-3">
                <label for="categoria" class="form-label">Categoría</label>
                <select class="form-control" id="categoria" name="categoria" required>
                    <?php foreach ($categorias as $categoria): ?>
                        <option value="<?= $categoria['id']; ?>" <?= $categoria['id'] == $producto['categoria_id'] ? 'selected' : ''; ?>><?= htmlspecialchars($categoria['nombre']); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Fotos actuales -->
            <div class="mb-3">
                <label class="form-label">Fotos actuales:</label>
                <div class="row">
                    <?php
                    $fotos = explode(',', $producto['foto']);
                    foreach ($fotos as $foto): ?>
                        <div class="col-md-3">
                            <img src="<?= UPLOADS_URL . htmlspecialchars(trim($foto)); ?>" class="img-thumbnail mb-2" alt="Imagen del producto">
                        </div>
                    <?php endforeach; ?>
                </div>
                <!-- Subir nuevas fotos -->
                <label for="fotos" class="form-label">Nuevas fotos del producto (puedes subir varias)</label>
                <input type="file" class="form-control" id="fotos" name="fotos[]" accept="image/*" multiple>
            </div>

            <!-- Video actual -->
            <div class="mb-3">
                <?php if (!empty($producto['video'])): ?>
                    <label class="form-label">Video actual:</label>
                    <video src="<?= UPLOADS_URL . htmlspecialchars($producto['video']); ?>" class="d-block w-100 mb-3" controls></video>
                <?php endif; ?>
                <!-- Subir nuevo video -->
                <label for="video" class="form-label">Nuevo video del producto (opcional)</label>
                <input type="file" class="form-control" id="video" name="video" accept="video/*">
            </div>

            <!-- Estado -->
            <div class="mb-3">
                <label for="estado" class="form-label">Estado</label>
                <select class="form-control" id="estado" name="estado" required>
                    <option value="1" <?= $producto['estado'] == 1 ? 'selected' : ''; ?>>Activo</option>
                    <option value="0" <?= $producto['estado'] == 0 ? 'selected' : ''; ?>>Inactivo</option>
                </select>
            </div>

            <!-- Botones -->
            <div class="d-flex justify-content-between">
                <button id="btn-guardar" type="submit" class="btn bg-accent text-primary mb-5 fuente-regular">Guardar Cambios</button>
                <button id="btnCancelar" class="btn btn-secondary" data-url="<?= APP_URL ?>Productos/administrarProductos">Cancelar</button>
            </div>
        </div>
    </form>
</div>


<script>
    $(document).ready(function() {
                $('#formEditarProducto').on('submit', function(e) {
                    e.preventDefault(); // Evita el envío normal del formulario

                    $.ajax({
                        url: $(this).attr('action'), // Obtiene la URL de acción del formulario
                        method: $(this).attr('method'), // Obtiene el método del formulario (POST)
                        data: $(this).serialize(), // Serializa los datos del formulario
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
    });
</script>