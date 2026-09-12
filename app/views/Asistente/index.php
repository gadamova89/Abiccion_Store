<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bici Doc Asistencia Técnica</title>

    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/bootstrap.css">
    <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/app.css">
    <style>
        .bike-container {
            position: relative;
            width: 100%;
            max-width: 800px; /* Limitar el ancho máximo para que no sea excesivo en pantallas grandes */
            margin: 0 auto;  /* Centra el contenedor en la página */
        }

        .bike-button {
            position: absolute;
            width: 30px;
            height: 30px;
            border-radius: 50%;
            background-color: rgba(255, 255, 255, 0.50);
            border: 1px solid red;
            cursor: pointer;
        }

        /* Posicionamos los botones con porcentajes respecto al tamaño de la imagen */
        #ruedaDelantera {
            top: 65%;  /* 65% desde la parte superior de la imagen */
            left: 94%; /* 85% desde el lado izquierdo de la imagen */
        }

        #manillar {
            top: 13%;
            left: 67%;
        }

        #bielas {
            top: 65%;
            left: 43%;
        }

        /* Asegurarse que la imagen sea responsiva */
        .bike-container img {
            width: 100%; /* La imagen ocupará el 100% del ancho de su contenedor */
            height: auto; /* Mantener la proporción de la imagen */
        }
    </style>
</head>

<body class="d-flex flex-column min-vh-100">

    <?php include_once VIEWS_PATH . "Layout/header.php"; ?>
    <div class="container">
        <h1 class="fuente-regular">Asistente de diagnóstico de Fallas comunes</h1>
        <h1 class="fuente-thin">Haz click en la parte afectada.</h1>

    </div>



    <div class="bike-container">
        <img src="<?= PUBLIC_URL . "assets/img/" ?>bike.png" alt="imagen-bicicleta">

        <!-- Botones colocados con coordenadas porcentuales respecto a la imagen -->
        <button class="bike-button" id="ruedaDelantera" data-bs-toggle="modal" data-bs-target="#modalRuedaDelantera"></button>
        <button class="bike-button" id="manillar" data-bs-toggle="modal" data-bs-target="#modalManillar"></button>
        <button class="bike-button" id="bielas" data-bs-toggle="modal" data-bs-target="#modalBielas"></button>
    </div>

    <!-- Modal para cada parte de la bicicleta -->
    <div class="modal fade" id="modalRuedaDelantera" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Rueda Delantera</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Componentes de la rueda delantera:</p>
                    <ul>
                        <li>Neumático</li>
                        <li>Cámara</li>
                        <li>Llanta</li>
                        <li>Radios</li>
                        <li>Buje</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modalManillar" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Manillar</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Componentes del manillar:</p>
                    <ul>
                        <li>Puños</li>
                        <li>Palancas de freno</li>
                        <li>Manetas de cambio</li>
                        <li>Tija del manillar</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <!-- MODAL BIELAS -->

    <div class="modal fade" id="modalBielas" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bielas</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Pestañas para cada componente de las bielas -->
                <ul class="nav nav-tabs" id="bielasTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-dark bg-light" id="biela-tab" data-bs-toggle="tab" data-bs-target="#biela" type="button" role="tab" aria-controls="biela" aria-selected="true">Biela</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark bg-light" id="plato-tab" data-bs-toggle="tab" data-bs-target="#plato" type="button" role="tab" aria-controls="plato" aria-selected="false">Plato</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-dark bg-light" id="pedal-tab" data-bs-toggle="tab" data-bs-target="#pedal" type="button" role="tab" aria-controls="pedal" aria-selected="false">Pedal</button>
                    </li>
                </ul>

                <!-- Contenido de las pestañas -->
                <div class="tab-content" id="bielasTabContent">
                    <!-- Información de la Biela -->
                    <div class="tab-pane fade show active" id="biela" role="tabpanel" aria-labelledby="biela-tab">
                        <div class="text-center mt-3">
                            <img src="<?=PUBLIC_URL?>/assets/img/bicidoc/bielas.jpg" alt="Imagen de la biela" class="img-fluid" style="max-width: 200px;">
                        </div>
                        <h6 class="mt-3">Descripción</h6>
                        <p>La biela es una pieza de metal que conecta el pedal con el eje del pedalier, permitiendo el movimiento de rotación.</p>
                        
                        <h6>Posibles fallas</h6>
                        <ul>
                            <li>Desgaste de la rosca del pedal.</li>
                            <li>Falta de lubricación en el eje.</li>
                        </ul>
                        
                        <h6>Soluciones</h6>
                        <ul>
                            <li><strong>Desgaste de la rosca del pedal:</strong> Cambiar la biela o utilizar una herramienta de reparación de roscas para recondicionar la rosca dañada.</li>
                            <li><strong>Falta de lubricación en el eje:</strong> Desmontar la biela y aplicar lubricante adecuado al eje.</li>
                        </ul>
                    </div>

                    <!-- Información del Plato -->
                    <div class="tab-pane fade" id="plato" role="tabpanel" aria-labelledby="plato-tab">
                        <div class="text-center mt-3">
                            <img src="<?=PUBLIC_URL?>/assets/img/bicidoc/platos.png" alt="Imagen del plato" class="img-fluid" style="max-width: 200px;">
                        </div>
                        <h6 class="mt-3">Descripción</h6>
                        <p>El plato es la parte de la transmisión donde se alojan los dientes que encajan con la cadena para transmitir la potencia a la rueda trasera.</p>
                        
                        <h6>Posibles fallas</h6>
                        <ul>
                            <li>Desgaste en los dientes del plato.</li>
                            <li>Deformación del plato por impactos.</li>
                        </ul>

                        <h6>Soluciones</h6>
                        <ul>
                            <li><strong>Desgaste en los dientes del plato:</strong> Reemplazar el plato si los dientes están demasiado desgastados para evitar saltos de cadena.</li>
                            <li><strong>Deformación del plato:</strong> Enderezar el plato si es posible, o reemplazarlo si el daño es severo.</li>
                        </ul>
                    </div>

                    <!-- Información del Pedal -->
                    <div class="tab-pane fade" id="pedal" role="tabpanel" aria-labelledby="pedal-tab">
                        <div class="text-center mt-3">
                            <img src="<?=PUBLIC_URL?>/assets/img/bicidoc/pedales.jpg" alt="Imagen del pedal" class="img-fluid" style="max-width: 200px;">
                        </div>
                        <h6 class="mt-3">Descripción</h6>
                        <p>El pedal es el punto de contacto entre el ciclista y la bicicleta. Transfiere la energía de la pierna a las bielas.</p>

                        <h6>Posibles fallas</h6>
                        <ul>
                            <li>Rodamientos desgastados.</li>
                            <li>Desajuste o juego en el pedal.</li>
                        </ul>

                        <h6>Soluciones</h6>
                        <ul>
                            <li><strong>Rodamientos desgastados:</strong> Desmontar y reemplazar los rodamientos del pedal.</li>
                            <li><strong>Desajuste en el pedal:</strong> Apretar adecuadamente o reemplazar el pedal si está muy dañado.</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




    <!-- FIN MODAL BIELAS -->

    <!-- formulario IA -->
    <div class="container py-3 ">
    <div class="row justify-content-center">
        <form id="preguntaForm">
            <h1 class="fuente-regular">También puedes consultar a la IA</h1>
            <label class="fuente-regular fs-5" for="pregunta">Pregunta:</label><br>
            <input class="form-control my-3 fuente-regular border-accent" type="text" id="pregunta" name="pregunta" required>

            <!-- Envolver el botón en un div con text-center para centrarlo -->
            <div class="text-center align-items-center">
                <p class="small text-danger">*Siempre es recomendable consultar un mecanico antes de cualquier reparación compleja.</p>
                <button id="submitBtn" class="btn bg-accent rounded-pill py-2 px-5 fuente-regular fs-3 fw-bold text-primary" type="submit">
    <span id="btnText">
        Consulta IA <span class="ms-3">
            <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-robot" viewBox="0 0 16 16">
                <path d="M6 12.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5M3 8.062C3 6.76 4.235 5.765 5.53 5.886a26.6 26.6 0 0 0 4.94 0C11.765 5.765 13 6.76 13 8.062v1.157a.93.93 0 0 1-.765.935c-.845.147-2.34.346-4.235.346s-3.39-.2-4.235-.346A.93.93 0 0 1 3 9.219zm4.542-.827a.25.25 0 0 0-.217.068l-.92.9a25 25 0 0 1-1.871-.183.25.25 0 0 0-.068.495c.55.076 1.232.149 2.02.193a.25.25 0 0 0 .189-.071l.754-.736.847 1.71a.25.25 0 0 0 .404.062l.932-.97a25 25 0 0 0 1.922-.188.25.25 0 0 0-.068-.495c-.538.074-1.207.145-1.98.189a.25.25 0 0 0-.166.076l-.754.785-.842-1.7a.25.25 0 0 0-.182-.135" />
                <path d="M8.5 1.866a1 1 0 1 0-1 0V3h-2A4.5 4.5 0 0 0 1 7.5V8a1 1 0 0 0-1 1v2a1 1 0 0 0 1 1v1a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2v-1a1 1 0 0 0 1-1V9a1 1 0 0 0-1-1v-.5A4.5 4.5 0 0 0 10.5 3h-2zM14 7.5V13a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V7.5A3.5 3.5 0 0 1 5.5 4h5A3.5 3.5 0 0 1 14 7.5" />
            </svg>
        </span>
    </span>
    <span id="btnSpinner" class="spinner-border spinner-border-sm ms-2" role="status" aria-hidden="true" style="display: none;"></span>
</button>
            </div>
        </form>

        <div id="respuesta"></div>
    </div>
</div>

    <!-- FIN formulario IA -->
<script>
    document.getElementById('preguntaForm').addEventListener('submit', async function(event) {
    event.preventDefault(); // Prevenir el envío del formulario

    const submitBtn = document.getElementById('submitBtn');
    const btnText = document.getElementById('btnText');
    const btnSpinner = document.getElementById('btnSpinner');
    
    // Función para cambiar el estado del botón
    function toggleButtonState(isLoading) {
        if (isLoading) {
            submitBtn.disabled = true;
            btnText.style.display = 'none';
            btnSpinner.style.display = 'inline-block';
        } else {
            submitBtn.disabled = false;
            btnText.style.display = 'inline';
            btnSpinner.style.display = 'none';
        }
    }

    var limites = "responderas como un experto mecanico de bicicletas, La siguiente pregunta solo la puedes responder si es relacionada con ciclismo o mecánica de bicicletas, sino no la respondas, se muy estricto y siempre responde en español:";
    const pregunta = document.getElementById('pregunta').value;

    var concatenado = limites + " " + pregunta;
    const responseDiv = document.getElementById('respuesta');

    const OPENROUTER_API_KEY = "<?= API_KEY?>";

    try {
        // Activar el estado de carga
        toggleButtonState(true);

        const response = await fetch("https://openrouter.ai/api/v1/chat/completions", {
            method: "POST",
            headers: {
                "Authorization": `Bearer ${OPENROUTER_API_KEY}`,
                "Content-Type": "application/json"
            },
            body: JSON.stringify({

                "model": "openai/gpt-oss-20b:free",//aceptable buena
                //"model": "mistralai/mistral-7b-instruct:free",//regular loca
                //"model": "meta-llama/llama-3.2-11b-vision-instruct:free",//regular funcional
                //"model": "openchat/openchat-7b:free",//regular funcional
                //"model": "google/gemma-2-9b-it:free",// con asteriscos
                "messages": [{
                    "role": "user",
                    "content": concatenado
                }]
            })
        });

        const data = await response.json();

        // Asegúrate de que la respuesta tenga el formato esperado
        const respuesta = data.choices[0]?.message?.content || 'No se pudo obtener respuesta.';

        // Dividir la respuesta en párrafos
        const parrafos = respuesta.split('\n');

        // Crear una lista HTML para los puntos numerados
        let htmlFormateado = '<h2>Respuesta de la IA:</h2>';
        let enLista = false;

        parrafos.forEach(parrafo => {
    const trimmedParrafo = parrafo.trim();
    if (trimmedParrafo.match(/^\d+[\.\)]/)) {
        if (!enLista) {
            htmlFormateado += '<ul>';
            enLista = true;
        }
        // Reemplazar el número por un asterisco
        const contenido = trimmedParrafo.replace(/^\d+[\.\)]\s*/, '');
        htmlFormateado += `<li>${contenido}</li>`;
    } else {
        if (enLista) {
            htmlFormateado += '</ul>';
            enLista = false;
        }
        htmlFormateado += `<p>${trimmedParrafo}</p>`;
    }
});


        if (enLista) {
            htmlFormateado += '</ol>';
        }

        responseDiv.innerHTML = htmlFormateado;
    } catch (error) {
        console.error('Error:', error);
        responseDiv.innerHTML = `<p>Error al obtener respuesta de la IA.</p>`;
    } finally {
        // Desactivar el estado de carga, independientemente del resultado
        toggleButtonState(false);
    }
});
</script>


    <?php

    include_once VIEWS_PATH . "Layout/whatsapp.php";
    include_once VIEWS_PATH . "Layout/footer.php";
    ?>