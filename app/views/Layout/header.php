<div class="sticky-top fuente-regular">
    <header class="container-fluid bg-secondary py-3">
        <div class="row align-items-center">
            <div class="col-12 col-md-3 text-center text-md-start">
                <a href="<?= APP_URL ?>home">
                    <img src="<?= PUBLIC_URL . "assets/img/" ?>logo.png" alt="Logo" class="img-fluid mb-2" style="max-width: 180px;">
                </a>
            </div>


            <div class="col-12 col-md-9">
                <div class="row mx-2">
                    <!-- buscador -->
                    <div class="col-8">
                        <form action="<?= APP_URL ?>productos/buscarProductosPorNombre/" method="GET" class="d-flex">
                            <input name="nombre" type="text" class="form-control border-accent" placeholder="Buscar..." aria-label="Buscar" required>
                            <button class="me-3 btn bg-accent ms-2" type="submit">
                                <i>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0" />
                                    </svg>
                                </i>
                            </button>
                        </form>
                    </div>

                    <!-- Botonoes carrito y login -->
                    <div class="col-4">
                        <div class="d-flex justify-content-center">
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <a class="btn btn-lg bg-accent d-flex justify-content-center align-items-center me-2">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-cart-fill" viewBox="0 0 16 16">
                                            <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                                        </svg>
                                    </i>
                                </a>
                                <!-- boton login -->
                                <a href="<?= APP_URL ?>login/login" class="btn btn-lg bg-accent d-flex justify-content-center align-items-center">
                                    <i>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="white" class="bi bi-person-fill" viewBox="0 0 16 16">
                                            <path d="M3 14s-1 0-1-1 1-4 6-4 6 3 6 4-1 1-1 1zm5-6a3 3 0 1 0 0-6 3 3 0 0 0 0 6" />
                                        </svg>
                                    </i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </header>
</div>