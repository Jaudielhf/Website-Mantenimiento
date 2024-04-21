<?php
session_start();

if (isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
}

?>

<div class="container-fluid">
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <a class="navbar-brand" href="../index.php">Inicio</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($active) ? $active : ''; ?>" href="./ubicaciones.php">Ubicaciones</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($active) ? $active : ''; ?>" href="citas.php">Agendar</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link <?php echo isset($active) ? $active : ''; ?>" href="./ver_citas.php">Ver citas</a>
                    </li>
                </ul>
                <div class="navbar-nav ms-auto">
                    <?php if (isset($_SESSION['username'])) : ?>
                        <div class="nav-item" style="display: flex; align-items: center;">
                            <a class="nav-link" href="./editar_usuario.php">Bienvenido, <?php echo $username; ?></a>
                            <a class="nav-link" href="../../login/logout.php" style="margin-left: 10px;">Cerrar sesión</a>
                        </div>
                    <?php else : ?>
                        <div class="nav-item">
                            <a class="nav-link" href="./../login/sign.php">Iniciar sesión</a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>
</div>
