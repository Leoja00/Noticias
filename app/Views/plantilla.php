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
    <?= $this->renderSection('inicio') ?>
</div>

<?php
    echo $this->renderSection('register'); //REGISTRO/REGISTRO
    echo $this->renderSection('login'); //LOGIN/LOGIN
    echo $this->renderSection('perfil'); //CUERPO/PERFIL
    echo $this->renderSection('crear'); //NOTICIAS/CREAR
    echo $this->renderSection('validar'); //NOTICIAS/VALIDAR
    echo $this->renderSection('view'); //NOTICIAS/VIEW
    echo $this->renderSection('editar'); //NOTICIAS/EDITAR
    echo $this->renderSection('noticiaIndividual'); //NOTICIAS/SHOW
    echo $this->renderSection('historial'); //NOTICIAS/HISTORIAL
    echo $this->renderSection('finish'); //NOTICIAS/FINISH
    echo $this->include('secciones/footer');

?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>
