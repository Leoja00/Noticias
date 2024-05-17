<?= $this->extend('plantilla'); ?>

<?= $this->section("validar") ?>
<div class="container mt-5">
    <h2>NOTICIAS A VALIDAR</h2>
    <?php if (!empty($noticias)): ?>
        <table>
            <tr>
                <th>Título</th>
                <th>Descripción</th>
                <th>Fecha</th>
                <th>Categoría</th>
                <th>Imagen</th>
                <th>Acciones</th>
            </tr>
            <?php foreach ($noticias as $noticia): ?>
                <tr>
                    <td><?= $noticia->titulo ?></td>
                    <td><?= $noticia->descripcion ?></td>
                    <td><?= $noticia->fecha_creacion ?></td>
                    <td><?= $noticia->categoria ?></td>
                    <td><img src="<?= base_url('uploads/' . $noticia->imagenes) ?>" alt="<?= $noticia->titulo ?>" width="100"></td>
                    <td>
                    <?php if ($noticia->puede_publicar || $noticia->puede_corregir): ?>
                <a href="<?= base_url('noticias/publication/' . $noticia->id) ?>" class="btn btn-primary">Publicar</a>
            <?php endif; ?>
            <?php if ($noticia->puede_descartar): ?>
                <a href="<?= base_url('noticias/descart/' . $noticia->id) ?>" class="btn btn-danger">Descartar</a>
            <?php endif; ?>
            <?php if ($noticia->puede_corregir): ?>
                <a href="<?= base_url('noticias/correction/' . $noticia->id) ?>" class="btn btn-warning">Corregir</a>
            <?php endif; ?>
                </tr>
            <?php endforeach; ?>
        </table>
            </div>
    <?php else: ?>

        <div class="container mt-5">
        <p style="font-size: 20px;"><strong>No hay noticias pendientes de validación.</strong>
        </div>
 
    <?php endif; ?>
<?= $this->endSection(); ?>