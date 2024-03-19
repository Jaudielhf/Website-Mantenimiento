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
                            <a class="nav-link" href="#">Citas</a>
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
                                <li><a class="dropdown-item" href="#">Servicios</a></li>
                            </ul>

                        </li>
                    </ul>
                    
                </div>
            </div>
        </nav>
        <div class="container ">

            <div class="row mt-4">
                <H1>VENTANA DE ADMINISTRACIÓN</H1>
                <div class="col mt-5">


                    <div class="container">
                        <div class="row">
                            <div class="col">
                                <article class="card">
                                    <div class="card-int">
                                        <span class="card__span">Category</span>
                                        <div class="img"></div>
                                        <div class="card-data">
                                            <p class="title">This is a test title
                                            </p>
                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                            <button class="button">More info</button>
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