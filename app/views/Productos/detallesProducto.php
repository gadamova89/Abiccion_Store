<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Comprar</title>

  <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/bootstrap.min.css">
  <link rel="stylesheet" href="<?= PUBLIC_URL . "assets/" ?>css/app.css">

  <style>
    /* Estilos para la galería y miniaturas */
    .thumbnail-gallery {
      max-height: 436px;
      overflow-y: auto;
    }

    .thumbnail-gallery img,
    .thumbnail-gallery video {
      width: 100%;
      height: auto;
      margin-bottom: 10px;
      cursor: pointer;
      border: 2px solid transparent;
    }

    .thumbnail-gallery img.active,
    .thumbnail-gallery video.active {
      border-color: #007bff;
    }

    /* Configuración responsiva para pantallas pequeñas */
    @media (max-width: 768px) {
      .main-image-container {
        height: auto;
        margin-bottom: 10px;
        max-width: 100%;
      }

      .thumbnail-gallery {
        display: flex;
        overflow-x: auto;
        max-height: none;
      }

      .thumbnail-gallery img,
      .thumbnail-gallery video {
        width: 80px;
        margin-right: 10px;
        margin-bottom: 0;
      }
    }

    .container {
      max-width: 1200px;
      overflow: hidden;
    }

    .carousel-control-prev,
    .carousel-control-next {
      width: 40px;
      /* Reduce el área de clic alrededor de la flecha */
      height: 40px;
      /* Ajusta la altura del área de clic */
      background: none;
      /* Elimina cualquier fondo adicional */
      top: 50%;
      /* Centra verticalmente el control en el medio del carrusel */
      transform: translateY(-50%);
      /* Ajuste preciso para centrar */
    }

    .carousel-control-prev-icon,
    .carousel-control-next-icon {
      width: 40px;
      /* Tamaño de la flecha */
      height: 40px;
      background-color: rgba(0, 0, 0, 0.5);
      /* Fondo semitransparente en la flecha para mayor visibilidad */
      border-radius: 50%;
      /* Da forma redondeada a la flecha */
    }

    .carousel-control-prev-icon:after,
    .carousel-control-next-icon:after {
      font-size: 16px;
      /* Ajusta el tamaño de la flecha */
    }
  </style>

</head>

<body class="d-flex flex-column min-vh-100">


  <!-- Ajustamos body para que el footer este siempre abajo -->
  <?php
  include_once VIEWS_PATH . "Layout/header.php"; //header con buscdor
  include_once VIEWS_PATH . "Layout/navbar.php"; //navbar con categorias
  //print_r($producto);
  ?>

  <?php

  $fotos = explode(",", $producto["foto"]);
  ?>


  <div class="container my-5">
    <div class="row">
      <!-- Galería de miniaturas y carrusel principal -->
      <div class="col-md-8 d-flex flex-md-row flex-column-reverse">
        <!-- Galería de miniaturas -->
        <div class="thumbnail-gallery col-md-3 mb-3 mb-md-0">
          <!-- Miniatura del video -->
          <?php if (!empty($producto["video"])): ?>
            <video onclick="jumpToSlide(0)" class="active" muted>
              <source src="<?= UPLOADS_URL . htmlspecialchars($producto["video"]) ?>" type="video/mp4">
            </video>
          <?php endif; ?>

          <!-- Miniaturas de las imágenes -->
          <?php foreach ($fotos as $index => $foto): ?>
            <img src="<?= UPLOADS_URL . htmlspecialchars($foto) ?>" alt="Thumbnail <?= $index + 1 ?>" onclick="jumpToSlide(<?= $index + 1 ?>)">
          <?php endforeach; ?>
        </div>

        <!-- Carrusel de imágenes -->
        <div id="carouselExampleFade" class="carousel slide carousel-fade col-md-9" data-bs-interval="false">
          <div class="carousel-inner">
            <!-- Item del video (primer elemento) -->
            <?php if (!empty($producto["video"])): ?>
              <div class="carousel-item active">
                <video class="d-block w-100" controls>
                  <source src="<?= UPLOADS_URL . htmlspecialchars($producto["video"]) ?>" type="video/mp4">
                </video>
              </div>
            <?php endif; ?>

            <!-- Items de las imágenes -->
            <?php foreach ($fotos as $index => $foto): ?>
              <div class="carousel-item <?= $index === 0 && empty($producto["video"]) ? 'active' : '' ?>">
                <img src="<?= UPLOADS_URL . htmlspecialchars($foto) ?>" class="d-block w-100" alt="Imagen <?= $index + 1 ?>">
              </div>
            <?php endforeach; ?>
          </div>
          <!-- Controles de navegación del carrusel -->
          <a class="carousel-control-prev" href="#carouselExampleFade" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Anterior</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleFade" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Siguiente</span>
          </a>
        </div>
      </div>

      <!-- Contenedor de título, descripción, precio y stock -->
      <div class="col-md-4 mt-4 mt-md-0">
        <div class="product-details">
          <h1><?= htmlspecialchars($producto["nombre"]) ?></h1>
          <p><?= htmlspecialchars($producto["descripcion"]) ?></p>
          <p><strong>Precio:</strong> $<?= htmlspecialchars($producto["precio"]) ?></p>
          <p><strong>Stock:</strong> <?= htmlspecialchars($producto["stock"]) ?> unidades disponibles</p>
          <button class="btn btn-primary me-2">Añadir al carrito</button>
          <button class="btn btn-success">Comprar</button>
        </div>
      </div>
    </div>
  </div>

  <script>
    // Función para saltar a una imagen específica en el carrusel
    function jumpToSlide(index) {
      const carousel = new bootstrap.Carousel('#carouselExampleFade');
      carousel.to(index);

      // Actualiza la miniatura activa
      document.querySelectorAll(".thumbnail-gallery img, .thumbnail-gallery video").forEach((el, i) => {
        el.classList.toggle("active", i === index);
      });
    }
  </script>


  <?php
  include_once VIEWS_PATH . "Layout/whatsapp.php"; //navbar con categorias
  include_once VIEWS_PATH . "Layout/asistente.php"; //navbar con categorias
  include_once VIEWS_PATH . "Layout/footer.php"; //navbar con categorias
  ?>