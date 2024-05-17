<?= $this->extend('plantilla'); ?>
<?= $this->section("inicio") ?>
<h3 class="mt-5"style="font-size: 30px; font-weight: bold;">¡BIENVENIDO AL INICIO DE NOTICIAS!</h3>
    <?php if(session('usuario')) : ?>
        <!-- CUANDO INICIA SESION -->
        <p style="font-size: 25px; font-weight: 200;">¡Ya has iniciado sesión como <?= session('usuario') ?>!</p>
        <p style="font-size: 20px;"><strong>Correo:</strong> <?= session('correo') ?></p>
        <p style="font-size: 20px;"><strong>Rol:</strong> <?= session('rol') ?></p>
        <form action="<?= base_url('usuarios/logout') ?>" method="post">
            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
        </form>
    <?php else : ?>
        <!-- CUANDO NO INICIA SESION -->
        <p>Regístrate o inicia sesión para acceder a todas las funcionalidades</p>
        <!-- Formulario de inicio de sesión -->
        <form action="<?= base_url('login') ?>" method="post">
            <!-- Agrega aquí los campos del formulario de inicio de sesión -->
        </form>
    <?php endif; ?>

<?= $this->endSection() ?>
