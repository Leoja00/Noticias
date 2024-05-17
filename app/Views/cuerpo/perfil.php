<?= $this->extend('plantilla'); ?>
<?= $this->section("perfil") ?>
<div class="container mt-5">
    <h3 class="mt-5"style="font-size: 30px; font-weight: bold;">PERFIL DEL USUARIO</h3>
        <p style="font-size: 20px;"><strong>Nombre de usuario:</strong> <?=$usuario  ?></p>
        <p style="font-size: 20px;"><strong>Correo:</strong> <?= session('correo') ?></p>
        <p style="font-size: 20px;"><strong>Rol:</strong> <?= session('rol') ?></p>
        <form action="<?= base_url('usuarios/logout') ?>" method="post">
            <button type="submit" class="btn btn-danger">Cerrar sesión</button>
        </form>
</div>
<?= $this->endSection(); ?>
