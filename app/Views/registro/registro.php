<?php echo $this->extend('plantilla'); ?>

<?= $this->section("register") ?>

<div class="container">
<h3 class="mt-5"style="font-size: 30px; font-weight: bold;">REGISTRARSE</h3>
    
    <form action="<?= base_url('usuarios') ?>" method="post"> 
        <div class="form-group">
            <label for="usuario"style="font-size: 20px; font-weight: bold;margin-bottom: 5px;">Usuario:</label>
            <input type="text" class="form-control" id="usuario" name="usuario"style="font-size: 20px; margin-bottom: 20px;" value="<?= set_value('usuario') ?>">
            <strong><?= \Config\Services::validation()->getError('usuario') ?></strong>
        </div>

        <div class="form-group">
            <label for="correo"style="font-size: 20px; font-weight: bold;margin-bottom: 5px;">Correo electrónico:</label>
            <input type="text" class="form-control" id="correo" name="correo" style="font-size: 20px; margin-bottom: 20px;" value="<?= set_value('correo') ?>">
            <strong ><?= \Config\Services::validation()->getError('correo') ?></strong>
        </div>

        <div class="form-group">
            <label for="contrasena" style="font-size: 20px; font-weight: bold;margin-bottom: 5px;">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena"  style="font-size: 20px; margin-bottom: 20px;"name="contrasena">
            <strong ><?= \Config\Services::validation()->getError('contrasena') ?></strong>
        </div>

        <div class="form-group">
            <label for="confirmar_contrasena" style="font-size: 20px; font-weight: bold;margin-bottom: 5px;">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="confirmar_contrasena" style="font-size: 20px; margin-bottom: 20px;" name="confirmar_contrasena">
            <strong ><?= \Config\Services::validation()->getError('confirmar_contrasena') ?></strong>
        </div>

        <div class="form-group">
            <label for="rol" style="font-size: 20px; font-weight: bold;margin-bottom: 5px;">Rol:</label>
            <select class="form-control" id="rol" style="font-size: 20px; margin-bottom: 20px;"name="rol">
                <option value="" <?= set_select('rol', '', TRUE) ?>>Seleccionar</option>
                <option value="editor" <?= set_select('rol', 'editor') ?>>Editor</option>
                <option value="validador" <?= set_select('rol', 'validador') ?>>Validador</option>
                <option value="editor_validador" <?= set_select('rol', 'editor_validador') ?>>Editor y Validador</option>
            </select>
            <?php if (\Config\Services::validation()->getError('rol')) : ?>
                <strong><?= \Config\Services::validation()->getError('rol') ?></strong>
            <?php endif; ?>
        </div>
        <br>
        <button type="submit" class="btn btn-primary" style="background-color: #fc8e5b; border-color: #fc8e5b;">REGISTRARSE</button>
    <?= form_close() ?>
</div>

<?php $this->endSection(); ?>
