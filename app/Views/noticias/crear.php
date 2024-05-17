<?= $this->extend('plantilla'); ?>

<?= $this->section("crear") ?>

<div class="container">
    <h3 class="mt-5">CREAR NOTICIA</h3>

    <form action="<?= base_url('noticias') ?>" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="titulo" class="form-label">Título de la noticia</label>
            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Título..." value="<?= set_value('titulo') ?>">
             
            <strong><?= \Config\Services::validation()->getError('titulo') ?></strong>
        </div>

        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción de la noticia</label>
            <textarea class="form-control" id="descripcion" name="descripcion" rows="3" placeholder="Descripción..."><?= set_value('descripcion') ?></textarea>
             
            <strong><?= \Config\Services::validation()->getError('descripcion') ?></strong>
        </div>

        <div class="form-group">
            <label for="categoria">Categoría:</label>
            <select class="form-control" id="categoria" name="categoria">
                <option value="" <?= set_select('categoria', '', TRUE) ?>>Seleccionar</option>
                <option value="politicas" <?= set_select('categoria', 'politicas') ?>>Políticas</option>
                <option value="deportivas" <?= set_select('categoria', 'deportivas') ?>>Deportivas</option>
                <option value="economicas" <?= set_select('categoria', 'economicas') ?>>Económicas</option>
                <option value="culturales" <?= set_select('categoria', 'culturales') ?>>Culturales</option>
                <option value="sociales" <?= set_select('categoria', 'sociales') ?>>Sociales</option>
            </select>
             
            <strong><?= \Config\Services::validation()->getError('categoria') ?></strong>
        </div>

        <div class="mb-3">
            <label for="archivo" class="-archivo">Agregar archivos</label>
            <input class="form-control" type="file" id="archivo" name="archivo[]" multiple accept="*">
            <strong><?= \Config\Services::validation()->getError('archivo') ?></strong>
        </div>


      
        <div class="mb-3">
            <button type="submit" class="btn btn-primary" name="accion" value="guardar_borrador">Guardar como borrador</button>
            <button type="submit" class="btn btn-success" name="accion" value="crear_validar">Crear para validar</button>
            <button type="reset" class="btn btn-dark">Borrar</button>
        </div>
    </form>
</div>

<?= $this->endSection(); ?>
