<div id="contenedor-tabla">
    <div class="row sticky-top bg-primary w-100 pt-2"> <!-- w-100 asegura el 100% del ancho, p-3 añade un poco de padding -->
        <h1 class="fuente-regular fs-3">Personal</h1>
        <div class="col-4">
            <input type="text" id="buscador" placeholder="Buscar..." class="form-control mb-3" style="max-width: 300px;">
        </div>
        <div class="col-2 ms-auto">
            <a href="" class="btn btn-success w-100" data-bs-toggle="modal" data-bs-target="#modalAgregarPersonal">
                Agregar Personal
                <i class="bi bi-plus-lg"></i>
            </a>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered" id="miTabla">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombres</th>
                    <th>Apellidos</th>
                    <th>Celular</th>
                    <th>Email</th>
                    <th>Nombre de Usuario</th>
                    <th>Estado</th>
                    <th>Rol</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($registros as $registro): ?>
                    <tr>
                        <td><?= htmlspecialchars($registro['id']); ?></td>
                        <td><?= htmlspecialchars($registro['nombres']); ?></td>
                        <td><?= htmlspecialchars($registro['apellidos']); ?></td>
                        <td><?= htmlspecialchars($registro['celular']); ?></td>
                        <td><?= htmlspecialchars($registro['email']); ?></td>
                        <td><?= htmlspecialchars($registro['nombre_usuario']); ?></td>
                        <td class="text-center">
                            <?php if ($registro['estado'] == 1): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="green" class="bi bi-check-circle" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.732 10.732a.5.5 0 0 0 .707 0l4-4a.5.5 0 1 0-.707-.707L7.5 9.293 5.268 7.061a.5.5 0 1 0-.707.707l2 2z" />
                                </svg>
                            <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="red" class="bi bi-sign-stop-fill" viewBox="0 0 16 16">
                                    <path d="M10.371 8.277v-.553c0-.827-.422-1.234-.987-1.234-.572 0-.99.407-.99 1.234v.553c0 .83.418 1.237.99 1.237.565 0 .987-.408.987-1.237m2.586-.24c.463 0 .735-.272.735-.744s-.272-.741-.735-.741h-.774v1.485z" />
                                    <path d="M4.893 0a.5.5 0 0 0-.353.146L.146 4.54A.5.5 0 0 0 0 4.893v6.214a.5.5 0 0 0 .146.353l4.394 4.394a.5.5 0 0 0 .353.146h6.214a.5.5 0 0 0 .353-.146l4.394-4.394a.5.5 0 0 0 .146-.353V4.893a.5.5 0 0 0-.146-.353L11.46.146A.5.5 0 0 0 11.107 0z" />
                                </svg>
                            <?php endif; ?>
                        </td>
                        <td><?= htmlspecialchars($registro['rol_id']); ?></td>
                        <td class='actions'>
                            <button class='btn btn-info btn-sm btn-edit' data-id="<?= $registro['id']; ?>" data-bs-toggle="modal" data-bs-target="#modalEditarPersonal">Editar</button>
                            <button class='btn btn-danger btn-sm btn-delete' data-id="<?= $registro['id']; ?>" data-bs-toggle="modal" data-bs-target="#deleteModal">Eliminar</button>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<!-- Modal para Editar Personal -->
<div class="modal fade" id="modalEditarPersonal" tabindex="-1" aria-labelledby="modalEditarPersonalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalEditarPersonalLabel">Editar Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formEditarPersonal" action="<?= APP_URL ?>Usuarios/editarPersonal" method="POST">
                    <input type="hidden" name="id" id="editarClienteId">
                    <div class="mb-3">
                        <label for="editarNombres" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="editarNombres" name="nombres" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarApellidos" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="editarApellidos" name="apellidos" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarCelular" class="form-label">Celular</label>
                        <input type="tel" class="form-control" id="editarCelular" name="celular" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarEmail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="editarEmail" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarNombreUsuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="editarNombreUsuario" name="nombre_usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="editarPassword" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="editarPassword" name="password" required>
                    </div>
                    <!-- estado -->
                    <div class="mb-3">
                        <label class="switch">
                            <input type="checkbox" id="editarEstado" name="estado">
                            <span class="slider"></span>
                        </label>

                    </div>
                    <!-- FIN estado -->
                    <!-- Select para elegir el rol -->
                    <div class="mb-3">
                        <label for="editarRol" class="form-label">Rol</label>
                        <select class="form-control" id="editarRol" name="rol_id" required>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN Modal para Editar Personal -->

<!-- Modal para confirmar eliminación -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ¿Estás seguro de que deseas eliminar este usuario?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-danger" id="confirmDelete">Eliminar</button>
            </div>
        </div>
    </div>
</div>

<!-- fin Modal para confirmar eliminación -->

<!-- Modal con el formulario agregar -->
<div class="modal fade" id="modalAgregarPersonal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">Agregar Personal</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formAgregarPersonal" method="POST" action="<?= APP_URL ?>Usuarios/crearPersonal">
                    <!-- Campo Nombres -->
                    <div class="mb-3">
                        <label for="nombrePersonal" class="form-label">Nombres</label>
                        <input type="text" class="form-control" id="nombrePersonal" name="nombre" required>
                    </div>

                    <!-- Campo Apellidos -->
                    <div class="mb-3">
                        <label for="apellidosPersonal" class="form-label">Apellidos</label>
                        <input type="text" class="form-control" id="apellidosPersonal" name="apellidos" required>
                    </div>

                    <!-- Campo Celular -->
                    <div class="mb-3">
                        <label for="celularPersonal" class="form-label">Celular</label>
                        <input type="text" class="form-control" id="celularPersonal" name="celular" required>
                    </div>

                    <!-- Campo Email -->
                    <div class="mb-3">
                        <label for="emailPersonal" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emaiPersonale" name="email" required>
                    </div>

                    <!-- Campo Nombre de Usuario -->
                    <div class="mb-3">
                        <label for="nombreUsuarioPersonal" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuarioPersonal" name="nombre_usuario" required>
                    </div>

                    <!-- Campo Contraseña -->
                    <div class="mb-3">
                        <label for="passwordPersonal" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="passwordPersonal" name="password" required>
                    </div>
                    <!-- Select para elegir el rol -->
                    <div class="mb-3">
                        <label for="editarRol" class="form-label">Rol</label>
                        <select class="form-control" id="editarRol" name="rol_id" required>
                            <?php foreach ($roles as $rol): ?>
                                <option value="<?= $rol['id'] ?>"><?= $rol['nombre'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <!-- Botones del modal -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Personal</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- FIN Modal con el formulario agregar-->



<!-- buscador: -->
<script>
    document.getElementById('buscador').addEventListener('keyup', function() {
        var input = document.getElementById('buscador');
        var filter = input.value.toLowerCase();
        var table = document.getElementById('miTabla');
        var rows = table.getElementsByTagName('tr');

        // Iterar sobre todas las filas, excepto la de cabecera (índice 0)
        for (var i = 1; i < rows.length; i++) {
            var cells = rows[i].getElementsByTagName('td');
            var match = false;

            // Iterar sobre todas las celdas de la fila
            for (var j = 0; j < cells.length; j++) {
                if (cells[j]) {
                    var cellValue = cells[j].textContent || cells[j].innerText;
                    if (cellValue.toLowerCase().indexOf(filter) > -1) {
                        match = true; // Si encuentra coincidencia
                        break;
                    }
                }
            }

            // Mostrar u ocultar la fila según el resultado de la búsqueda
            if (match) {
                rows[i].style.display = '';
            } else {
                rows[i].style.display = 'none';
            }
        }
    });
</script>
<!-- FIN buscador: -->
<!-- script editar personal -->
<script>
    $(document).ready(function() {
        $('#formEditarPersonal').on('submit', function(e) {
            e.preventDefault(); // Prevenir el comportamiento por defecto de recargar la página
            var formData = $(this).serialize(); // Serializar todos los datos del formulario
            $.ajax({
                url: $(this).attr('action'), // La URL del formulario (controlador editarPersonal)
                method: 'POST',
                data: formData,
                beforeSend: function() {
                    // Puedes agregar un loader o mensaje de "cargando" aquí si lo deseas
                    $('#modalEditarPersonal').modal('hide'); // Cierra el modal
                    $('#contenedor-tabla').html('<p>Cargando...</p>'); // Mostrar mensaje de carga
                },
                success: function(response) {
                    // Procesar la respuesta y actualizar la tabla
                    setTimeout(function() {
                        $('#contenedor-tabla').html(response); // Actualizar la tabla con la respuesta
                    }, 400); // Ajusta el tiempo según sea necesario
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Manejar errores
                    alert('Ocurrió un error al actualizar el personal.');
                }
            });
        });
    });
</script>
<!-- FIN script editar personal -->

<!-- Script para cargar los datos del personal en el formulario de edición -->
<script>
    $('.btn-edit').click(function() {
        var userId = $(this).data('id'); // Obtener el ID del usuario
        $.ajax({
            url: '<?= APP_URL ?>Usuarios/obtenerUsuarioPorId/' + userId,
            method: 'GET',
            dataType: 'json',
            success: function(response) {
                if (response.error) {
                    alert(response.error);
                    return;
                }
                console.log(response);
                // Llenar los campos del formulario con los datos del usuario
                $('#editarClienteId').val(response.id); // Asignar ID al campo oculto
                $('#editarNombres').val(response.nombres);
                $('#editarApellidos').val(response.apellidos);
                $('#editarCelular').val(response.celular);
                $('#editarEmail').val(response.email);
                $('#editarNombreUsuario').val(response.nombre_usuario);
                $('#editarEstado').prop('checked', response.estado == 1);
                // Seleccionar el rol correcto en el dropdown
                $('#editarRol').val(response.rol_id);
            },
            error: function(xhr, status, error) {
                console.error('Error:', error);
                alert('Ocurrió un error al obtener los datos del usuario.');
            }
        });
    });
</script>

<!-- FIN Script para cargar los datos del personal en el formulario de edición -->

<!-- para eliminar -->
<script>
    $(document).ready(function() {
        var userId; // Variable para almacenar el ID del usuario a eliminar

        // Evento cuando se hace clic en el botón de eliminar
        $('.btn-delete').click(function() {
            userId = $(this).data('id'); // Obtener el ID del usuario del atributo data-id
            console.log(userId);
        });

        // Evento cuando se confirma la eliminación
        $('#confirmDelete').click(function() {
            var $this = $(this); // Guardar la referencia al botón de confirmación
            $this.prop('disabled', true); // Desactivar el botón de confirmación

            $.ajax({
                url: '<?= APP_URL ?>Usuarios/eliminarPersonal',
                method: 'POST',
                data: {
                    id: userId
                },
                beforeSend: function() {
                    $('#contenedor-tabla').html('<p>Cargando...</p>'); // Mensaje de carga
                },
                success: function(response) {
                    // Cerrar el modal y eliminar el backdrop
                    $('#deleteModal').modal('hide');
                    $('body').removeClass('modal-open'); // Remover clase modal-open
                    $('.modal-backdrop').remove(); // Remover el backdrop si queda

                    // Usar setTimeout para dar tiempo a la animación de cierre
                    setTimeout(function() {
                        $('#contenedor-tabla').html(response); // Actualizar la tabla
                    }, 300); // Ajusta el tiempo según sea necesario
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log de error
                    alert('Ocurrió un error al eliminar el usuario.');
                },
                complete: function() {
                    $this.prop('disabled', false); // Volver a activar el botón de confirmación
                }
            });
        });
    });
</script>
<!-- FIN Script para eliminar -->

<!-- script agregar -->
<script>
    $(document).ready(function() {
        $('#formAgregarPersonal').on('submit', function(e) {
            e.preventDefault(); // Prevenir la acción por defecto del botón

            var formData = $('#formAgregarPersonal').serialize(); // Obtén los datos del formulario

            $.ajax({
                url: $(this).attr('action'), // La URL especificada en el atributo action
                method: 'POST',
                data: formData,
                beforeSend: function() {
                    $('#modalAgregarPersonal').modal('hide'); // Cierra el modal de agregar cliente
                    $('#contenedor-tabla').html('<p>Cargando...</p>'); // Mensaje de carga
                },
                success: function(response) {
                    //$('#contenedor-tabla').html(response); // Actualiza el div con la respuesta
                    // Usar setTimeout para dar tiempo a la animación de cierre
                    setTimeout(function() {
                        $('#contenedor-tabla').html(response); // Actualizar la tabla
                    }, 300); // Ajusta el tiempo según sea necesario
                },
                error: function(xhr, status, error) {
                    console.error('Error:', error); // Log de error
                    $('#contenedor-tabla').html('<p>Error al cargar los datos.</p>'); // Mensaje de error
                }
            });
        });
    });
</script>
<!--FIn script agregar -->