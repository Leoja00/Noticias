<?php echo $this->extend('plantilla'); ?>

<?= $this->section("login") ?>
<div class="container">
    <h3 class="mt-5"style="font-size: 30px; font-weight: bold;">INICIAR SESIÓN</h3>

    <?php if (session()->has('error')) : ?>
        <div class="alert alert-danger mt-4" role="alert">
            <?= session('error') ?>
        </div>
    <?php endif; ?>

    <?= form_open('usuarios/login', ['class' => 'mt-4']) ?>
        <div class="form-group">
        <label for="correo" style="font-size: 20px; font-weight: bold;margin-bottom: 5px;">Correo electrónico:</label>

            <input type="email" class="form-control" id="correo" name="correo" style="font-size: 20px; margin-bottom: 20px;" value="<?= set_value('correo') ?>">
            <strong><?= \Config\Services::validation()->getError('correo') ?></strong>
        </div>

        <div class="form-group">
            <label for="contrasena" style="font-size: 20px;font-weight: bold;margin-bottom: 5px;">Contraseña:</label>
            <input type="password" class="form-control" id="contrasena" name="password" style="font-size: 20px;" value="">
            <strong><?= \Config\Services::validation()->getError('password') ?></strong>
        </div>
        
        <br>
        <button type="submit" class="btn btn-primary" style="background-color: #fc8e5b; border-color: #fc8e5b;">INGRESAR</button>
    </form>
</div>
<?= $this->endSection() ?>

