<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../bootstrap-5.3.3-dist/css/bootstrap.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="../../bootstrap-5.3.3-dist/js/bootstrap.bundle.js"></script>
    <title>Inicio</title>
</head>

<body>

    <div class="container-fluid">
        <nav class="navbar navbar-expand-lg bg-body-tertiary">
            <div class="container-fluid">
                <a class="navbar-brand" href="./dashboard-admin.php">Inicio</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">

                        <li class="nav-item">
                            <a class="nav-link" href="./php/citas.php">Citas</a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Administrar
                            </a>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="./php/admin-empleados.php">Empleados</a></li>
                                <li><a class="dropdown-item" href="./php/admin-user.php">Usuarios</a></li>
                                <li>
                                    <hr class="dropdown-divider">
                                </li>
                                <li><a class="dropdown-item" href="./php/servicios.php">Servicios</a></li>
                            </ul>

                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="./php/pago.php">Realizar Pago</a>
                        </li>
                    </ul>

                </div>
            </div>
        </nav>
        <div class="container">
            <div class="row mt-4 text-center">
                <H1>VENTANA DE ADMINISTRACIÓN</H1>
                <div class="col mt-5">


                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <article class="card">
                                    <div class="card-int">
                                        <span class="card__span">Usuarios</span>
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-people" viewBox="0 0 16 16">
                                                <path d="M15 14s1 0 1-1-1-4-5-4-5 3-5 4 1 1 1 1zm-7.978-1L7 12.996c.001-.264.167-1.03.76-1.72C8.312 10.629 9.282 10 11 10c1.717 0 2.687.63 3.24 1.276.593.69.758 1.457.76 1.72l-.008.002-.014.002zM11 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4m3-2a3 3 0 1 1-6 0 3 3 0 0 1 6 0M6.936 9.28a6 6 0 0 0-1.23-.247A7 7 0 0 0 5 9c-4 0-5 3-5 4q0 1 1 1h4.216A2.24 2.24 0 0 1 5 13c0-1.01.377-2.042 1.09-2.904.243-.294.526-.569.846-.816M4.92 10A5.5 5.5 0 0 0 4 13H1c0-.26.164-1.03.76-1.724.545-.636 1.492-1.256 3.16-1.275ZM1.5 5.5a3 3 0 1 1 6 0 3 3 0 0 1-6 0m3-2a2 2 0 1 0 0 4 2 2 0 0 0 0-4" />
                                            </svg>
                                        </div>
                                        <div class="card-data">
                                            <p class="title">Administrar Usuarios
                                            </p>
                                            <p>En esta seccion podra administrar a los usuarios registrados en la pagina.</p>
                                            <button onclick="location.href='./php/admin-user.php'" class="button">Usuarios</button>
                                        </div>
                                    </div>
                                </article>
                            </div>

                            <div class="col">
                                <article class="card">
                                    <div class="card-int">
                                        <span class="card__span">Empleados</span>
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-person-rolodex" viewBox="0 0 16 16">
                                                <path d="M8 9.05a2.5 2.5 0 1 0 0-5 2.5 2.5 0 0 0 0 5" />
                                                <path d="M1 1a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h.5a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h9a.5.5 0 0 0 .5-.5.5.5 0 0 1 1 0 .5.5 0 0 0 .5.5h.5a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1H6.707L6 1.293A1 1 0 0 0 5.293 1zm0 1h4.293L6 2.707A1 1 0 0 0 6.707 3H15v10h-.085a1.5 1.5 0 0 0-2.4-.63C11.885 11.223 10.554 10 8 10c-2.555 0-3.886 1.224-4.514 2.37a1.5 1.5 0 0 0-2.4.63H1z" />
                                            </svg>
                                        </div>
                                        <div class="card-data">
                                            <p class="title">Administrar Empleados
                                            </p>
                                            <p>Administracion de los empleados registrados en la pagina.</p>
                                            <button onclick="location.href='./php/admin-empleados.php'" class="button">Empleados</button>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col">
                                <article class="card">
                                    <div class="card-int">
                                        <span class="card__span">Servicios</span>
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-gear-wide-connected" viewBox="0 0 16 16">
                                                <path d="M7.068.727c.243-.97 1.62-.97 1.864 0l.071.286a.96.96 0 0 0 1.622.434l.205-.211c.695-.719 1.888-.03 1.613.931l-.08.284a.96.96 0 0 0 1.187 1.187l.283-.081c.96-.275 1.65.918.931 1.613l-.211.205a.96.96 0 0 0 .434 1.622l.286.071c.97.243.97 1.62 0 1.864l-.286.071a.96.96 0 0 0-.434 1.622l.211.205c.719.695.03 1.888-.931 1.613l-.284-.08a.96.96 0 0 0-1.187 1.187l.081.283c.275.96-.918 1.65-1.613.931l-.205-.211a.96.96 0 0 0-1.622.434l-.071.286c-.243.97-1.62.97-1.864 0l-.071-.286a.96.96 0 0 0-1.622-.434l-.205.211c-.695.719-1.888.03-1.613-.931l.08-.284a.96.96 0 0 0-1.186-1.187l-.284.081c-.96.275-1.65-.918-.931-1.613l.211-.205a.96.96 0 0 0-.434-1.622l-.286-.071c-.97-.243-.97-1.62 0-1.864l.286-.071a.96.96 0 0 0 .434-1.622l-.211-.205c-.719-.695-.03-1.888.931-1.613l.284.08a.96.96 0 0 0 1.187-1.186l-.081-.284c-.275-.96.918-1.65 1.613-.931l.205.211a.96.96 0 0 0 1.622-.434zM12.973 8.5H8.25l-2.834 3.779A4.998 4.998 0 0 0 12.973 8.5m0-1a4.998 4.998 0 0 0-7.557-3.779l2.834 3.78zM5.048 3.967l-.087.065zm-.431.355A4.98 4.98 0 0 0 3.002 8c0 1.455.622 2.765 1.615 3.678L7.375 8zm.344 7.646.087.065z" />
                                            </svg>
                                        </div>
                                        <div class="card-data">
                                            <p class="title">Administrar Servicios
                                            </p>
                                            <p>En esta seccion podra administrar los servicios registrados en la pagina.</p>
                                            <button onclick="location.href='./php/servicios.php'" class="button">Servicios</button>
                                        </div>
                                    </div>
                                </article>
                            </div>
                            <div class="col">
                                <article class="card">
                                    <div class="card-int">
                                        <span class="card__span">Citas</span>
                                        <div class="img">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="50%" height="100%" fill="currentColor" class="bi bi-calendar2-check" viewBox="0 0 16 16">
                                                <path d="M10.854 8.146a.5.5 0 0 1 0 .708l-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708 0" />
                                                <path d="M3.5 0a.5.5 0 0 1 .5.5V1h8V.5a.5.5 0 0 1 1 0V1h1a2 2 0 0 1 2 2v11a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V3a2 2 0 0 1 2-2h1V.5a.5.5 0 0 1 .5-.5M2 2a1 1 0 0 0-1 1v11a1 1 0 0 0 1 1h12a1 1 0 0 0 1-1V3a1 1 0 0 0-1-1z" />
                                                <path d="M2.5 4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H3a.5.5 0 0 1-.5-.5z" />
                                            </svg>
                                        </div>
                                        <div class="card-data">
                                            <p class="title">Realizar Pago
                                            </p>
                                            <p>En esta seccion podra realizar el pago al servicio</p>
                                            <button onclick="location.href='./php/pago.php'" class="button">Empleados</button>
                                        </div>
                                    </div>
                                </article>
                            </div>
                                        <div class="card-data">
                                            <p class="title">Administrar Citas
                                            </p>
                                            <p>En esta seccion podra administrar las Citas registrados en la pagina.</p>
                                            <button onclick="location.href='./php/citas.php'" class="button">Citas</button>
                                        </div>
                                    </div>
                                </article>
                            </div>

                        </div>
                    </div>



                </div>
            </div>
        </div>

    </div>
</body>

</html>