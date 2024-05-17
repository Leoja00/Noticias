<?= $this->extend('plantilla'); ?>

<?= $this->section("noticiaIndividual"); ?>

<?php
$previous_url = session()->get('previous_url') ?? base_url();
$current_user_id = session()->get('id');
?>

<div class="card">
    <div class="card-header">
        <h5><?= esc(ucwords($noticia->categoria)) ?></h5>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <h2 class="card-title"><?= esc($noticia->titulo) ?></h2>
            <p class="card-text descripcion"><?= esc($noticia->descripcion) ?></p>
        </blockquote>

        <?php
        $imagenes = explode(',', $noticia->imagenes);
        if (count($imagenes) > 1):
        ?>
        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <?php foreach ($imagenes as $index => $imagen): ?>
                    <?php if (!empty($imagen)): ?>
                        <div class="carousel-item <?= $index === 0 ? 'active' : '' ?>">
                            <img src="<?= base_url('uploads/' . esc($imagen)) ?>" class="d-block w-100" alt="Imagen de la noticia">
                        </div>
                    <?php endif; ?>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
        <?php else: ?>
            <?php foreach ($imagenes as $imagen): ?>
                <?php if (!empty($imagen)): ?>
                    <img src="<?= base_url('uploads/' . esc($imagen)) ?>" class="img-fluid mb-3" alt="Imagen de la noticia">
                <?php endif; ?>
            <?php endforeach; ?>
        <?php endif; ?>

        <?php
        if ($noticia->estado == "publicada") {
            $fecha_publicacion = new DateTime($noticia->fecha_publicacion);
            $fecha_actual = new DateTime();
            $diferencia = $fecha_publicacion->diff($fecha_actual);

            if ($diferencia->days == 0) {
                $dias_publicada = "Publicada hoy.";
            } elseif ($diferencia->days == 1) {
                $dias_publicada = "Publicada hace 1 día.";
            } else {
                $dias_publicada = "Publicada hace " . $diferencia->days . " días.";
            }
        } else {
            $dias_publicada = "";
        }
        ?>

        <p class="card-text"></p>
        <div class="card-footer text-muted">
            <?= esc($dias_publicada) ?>
        </div>

        <?php if ($noticia->estado === "borrador" && $current_user_id === $noticia->id_editor) : ?>

            <a href="<?= base_url('noticias/edit/' . $noticia->id) ?>" class="btn btn-outline-warning">Editar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-fill" viewBox="0 0 16 16">
                    <path d="M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11z" />
                </svg>
            </a>
            <a href="<?= esc($previous_url) ?>" class="btn btn-outline-info btn-volver">Volver</a>
        <?php else: ?>
            <div>
            <a href="<?= esc($previous_url) ?>" class="btn btn-outline-info btn-volver">Volver</a>
            </div>
        <?php endif; ?>

    </div>
</div>

<?= $this->endSection(); ?>
