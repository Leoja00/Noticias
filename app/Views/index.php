<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Noti Live</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="<?= base_url('img/icon.png')?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="<?= base_url('css/footer.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/navbar.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/body.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/individual.css') ?>">
    <link rel="stylesheet" href="<?= base_url('css/view.css') ?>">

  </head>
<body>
<?php
    echo $this->include('secciones/navbar');
?>

<div class="container mt-5">
    <?php if(isset($noticias) && count($noticias) > 0): ?>
        <div class="row">
            <?php foreach($noticias as $noticia): ?>
                <div class="col-md-6">
                    <div class="card mb-4 shadow-sm border-custom"> 
                        <?php
                        $imagenes = explode(',', $noticia->imagenes);
                        if (!empty($imagenes[0])): 
                            $ruta_imagen = base_url('uploads/' . esc($imagenes[0]));
                        ?>
                            <img src="<?= $ruta_imagen ?>" class="card-img-top" alt="Imagen de la noticia">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= esc($noticia->titulo) ?></h5>
                            <p class="card-text">
                            <?php 
                                $descripcion = esc($noticia->descripcion);
                                echo strlen($descripcion) > 200 ? substr($descripcion, 0, 200) . '...' : $descripcion;
                            ?>
                            </p>
                            <a href="<?= base_url('noticias/show/'.$noticia->id) ?>" class="btn btn-custom">Leer más...</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <div class="container mt-5">
        <p style="font-size: 20px;"><strong>No hay noticias publicadas hasta el momento.</strong>
    </div>
    <?php endif; ?>
</div>

<?php
    echo $this->include('secciones/footer');
?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

