<?php
$session = \Config\Services::session();
$isLoggedIn = $session->has('usuario');
$usuario = $session->get('usuario');
$rol = $session->get('rol');
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary" style="background-color: red;">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?= base_url('') ?>">
            <img src="<?= base_url('img/prueba.png') ?>" alt="unsl" width="55" height="44">
        </a>
        <a class="navbar-brand" href="<?= base_url('') ?>">
            <span class="brand-thin">NOTI</span> <span class="brand-bold">LIVE</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 align-items-center">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?= base_url('') ?>">INICIO</a>
                </li>
                <?php if (!$isLoggedIn) : ?>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('usuarios/log') ?>">INICIAR SESIÓN</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('usuarios/new') ?>">REGISTRARSE</a>
                </li>
                <?php else : ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        ACCIONES
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <?php if ($rol === 'editor' || $rol === 'editor_validador'): ?>
                        <li><a class="dropdown-item" href="<?= base_url('usuarios/news') ?>">Crear noticia</a></li>
                        <li><a class="dropdown-item" href="<?= base_url('usuarios/view') ?>">Ver noticias propias</a>
                        </li>
                        <?php endif; ?>
                        <?php if ($rol === 'validador' || $rol === 'editor_validador'): ?>
                        <li><a class="dropdown-item" href="<?= base_url('usuarios/validation') ?>">Ver noticias para
                                validar</a></li>
                        <?php endif; ?>
                        <?php if ($rol === 'validador' || $rol === 'editor_validador'): ?>
                        <li><a class="dropdown-item" href="<?= base_url('usuarios/finish') ?>">Ver noticias ya finalizadas</a></li>
                        <?php endif; ?>
                        <?php if ($rol === 'validador'): ?>
                        <li><a class="dropdown-item" href="<?= base_url('usuarios/publicated') ?>">Ver noticias ya publicadas</a></li>
                        <?php endif; ?>
                        <?php if ($rol === 'validador' || $rol === 'editor_validador'): ?>
                        <li><a class="dropdown-item" href="<?= base_url('usuarios/views') ?>">Ver historial de todas las noticias</a></li>
                        <?php endif; ?>
                        
                        
                    </ul>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?= base_url('usuarios/perfil') ?>">PERFIL</a>
                </li>
                <li class="nav-item">
                    <form action="<?= base_url('usuarios/logout') ?>" method="post" class="nav-link m-0 p-0">
                        <button type="submit" class="btn btn-link nav-link cerrar-sesion">CERRAR SESIÓN</button>
                    </form>
                </li>
                <?php endif; ?>
            </ul>
            
        </div>
    </div>
</nav>