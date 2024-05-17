<?= $this->extend('plantilla'); ?>

<?= $this->section("view") ?>
<?php $alert = session('alert'); ?>
<?php if ($alert === 'success') : ?>
<div class="alert alert-success alert-dismissible fade show" role="alert">
    <?php echo session('message'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php elseif ($alert === 'danger') : ?>
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <?php echo session('message'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php elseif ($alert === 'warning') : ?>
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    <?php echo session('message'); ?>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
<?php endif; ?>

<u>
    <h1>Noticias creadas por ti</h1>
</u>

<?php if (!empty($noticias)): ?>
<?php
    $estadoNoticias = [
        'borrador' => [],
        'lista_para_validar' => [],
        'para_correccion' => [],
        'publicada' => [],
        'finalizada' => []
    ];
    foreach ($noticias as $noticia) {
        $estadoNoticias[$noticia->estado][] = $noticia;
    }
    ?>

<!-- BORRADORES -->
<?php if (!empty($estadoNoticias['borrador'])): ?>
<br>
<h2>Borradores</h2>
<table>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Categoría</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php $contador = 1; ?>
    <?php foreach ($estadoNoticias['borrador'] as $noticia): ?>
    <tr>
        <td><?= $contador ?></td>
        <td><?= substr($noticia->titulo, 0, 25) . '...' ?></td>
        <td><?= substr($noticia->descripcion, 0, 25) . '...' ?></td>
        <td><?= date('Y-m-d', strtotime($noticia->fecha_creacion)) ?></td>
        <td><?= ucfirst($noticia->categoria) ?></td>
        <?php if (!empty($noticia->imagenes)): ?>
        <?php $imagenes = explode(',', $noticia->imagenes); ?>
        <?php $imagenMostrar = base_url('uploads/' . $imagenes[0]); ?>
        <td><img src="<?= $imagenMostrar ?>" alt="<?= $noticia->titulo ?>" width="100"></td>
        <?php else: ?>
        <td>-No ingreso-</td>
        <?php endif; ?>
        <td>
            <a href="<?= base_url('noticias/show/' . $noticia->id) ?>" class="btn btn-info">Ver
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </a>
            <a href="<?= base_url('noticias/edit/' . $noticia->id) ?>" class="btn btn-primary">Editar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil"
                    viewBox="0 0 16 16">
                    <path
                        d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325" />
                </svg>
            </a>
            <a href="<?= base_url('noticias/activar/' . $noticia->id) ?>" class="btn btn-info">Activar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-check-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05" />
                </svg>
            </a>
            <a href="<?= base_url('noticias/desactivar/' . $noticia->id) ?>" class="btn btn-primary">Desactivar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-x-circle" viewBox="0 0 16 16">
                    <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                    <path
                        d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708" />
                </svg>
            </a>
            <a href="<?= base_url('noticias/descart/' . $noticia->id) ?>" class="btn btn-danger">Descartar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash3"
                    viewBox="0 0 16 16">
                    <path
                        d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                </svg>
            </a>
        </td>
    </tr>
    <?php $contador++; ?>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<!-- VALIDAR -->
<?php if (!empty($estadoNoticias['lista_para_validar'])): ?>
<br>
<h2>Lista para validar</h2>
<table>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Categoría</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php $contador = 1; ?>
    <?php foreach ($estadoNoticias['lista_para_validar'] as $noticia): ?>
    <tr>
        <td><?= $contador ?></td>
        <td><?= substr($noticia->titulo, 0, 25) . '...' ?></td>
        <td><?= substr($noticia->descripcion, 0, 25) . '...' ?></td>
        <td><?= date('Y-m-d', strtotime($noticia->fecha_creacion)) ?></td>
        <td><?= ucfirst($noticia->categoria) ?></td>
        <?php if (!empty($noticia->imagenes)): ?>
        <?php $imagenes = explode(',', $noticia->imagenes); ?>
        <?php $imagenMostrar = base_url('uploads/' . $imagenes[0]); ?>
        <td><img src="<?= $imagenMostrar ?>" alt="<?= $noticia->titulo ?>" width="100"></td>
        <?php else: ?>
        <td>-No ingreso-</td>
        <?php endif; ?>
        <td>
            <a href="<?= base_url('noticias/show/' . $noticia->id) ?>" class="btn btn-info">Ver
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </a>
            <?php if ($rol === 'editor_validador'): ?>
        <td>
            <a href="<?= base_url('noticias/publication/' . $noticia->id) ?>" class="btn btn-success">Publicar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                    class="bi bi-clipboard-check-fill" viewBox="0 0 16 16">
                    <path
                        d="M6.5 0A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5.5.5 0 0 0 9.5 0zm3 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5z" />
                    <path
                        d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1A2.5 2.5 0 0 1 9.5 5h-3A2.5 2.5 0 0 1 4 2.5zm6.854 7.354-3 3a.5.5 0 0 1-.708 0l-1.5-1.5a.5.5 0 0 1 .708-.708L7.5 10.793l2.646-2.647a.5.5 0 0 1 .708.708" />
                </svg>
            </a>
        </td>
        <?php endif; ?>
        <?php if ($rol === 'editor_validador' || $rol === 'validador'): ?>
        <a href="<?= base_url('noticias/correction/' . $noticia->id) ?>" class="btn btn-warning">Corregir
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-magic"
                viewBox="0 0 16 16">
                <path
                    d="M9.5 2.672a.5.5 0 1 0 1 0V.843a.5.5 0 0 0-1 0zm4.5.035A.5.5 0 0 0 13.293 2L12 3.293a.5.5 0 1 0 .707.707zM7.293 4A.5.5 0 1 0 8 3.293L6.707 2A.5.5 0 0 0 6 2.707zm-.621 2.5a.5.5 0 1 0 0-1H4.843a.5.5 0 1 0 0 1zm8.485 0a.5.5 0 1 0 0-1h-1.829a.5.5 0 0 0 0 1zM13.293 10A.5.5 0 1 0 14 9.293L12.707 8a.5.5 0 1 0-.707.707zM9.5 11.157a.5.5 0 0 0 1 0V9.328a.5.5 0 0 0-1 0zm1.854-5.097a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L8.646 5.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0l1.293-1.293Zm-3 3a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L.646 13.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0z" />
            </svg>
        </a>
        <?php endif;?>
        <?php if ($rol === 'editor_validador' || $rol === 'validador'): ?>
        <a href="<?= base_url('noticias/descart/' . $noticia->id) ?>" class="btn btn-danger"
            onclick="return confirm('¿Estás seguro de que deseas descartar esta noticia?')">Descartar
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill"
                viewBox="0 0 16 16">
                <path
                    d="M2.5 1a1 1 0 0 1 1-1h8a1 1 0 0 1 1 1H15a.5.5 0 0 1 0 1h-1v11a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V2H1a.5.5 0 0 1 0-1h1.5zm3 3a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 1 0v-9a.5.5 0 0 0-.5-.5zM7.5 4.5a.5.5 0 0 0-1 0v9a.5.5 0 0 0 1 0v-9zm3-.5a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-1 0v-9a.5.5 0 0 1 .5-.5z" />
            </svg>
        </a>
        <?php endif;?>
        </td>
    </tr>
    <?php $contador++; ?>
    <?php endforeach; ?>
</table>
<?php endif; ?>


<!--CORRECION-->
<?php if (!empty($estadoNoticias['para_correccion'])): ?>
<br>
<h2>Para corrección</h2>
<table>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Categoría</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php $contador = 1; ?>
    <?php foreach ($estadoNoticias['para_correccion'] as $noticia): ?>
    <tr>
        <td><?= $contador ?></td>
        <td><?= substr($noticia->titulo, 0, 25) . '...' ?></td>
        <td><?= substr($noticia->descripcion, 0, 25) . '...' ?></td>
        <td><?= date('Y-m-d', strtotime($noticia->fecha_creacion)) ?></td>
        <td><?= ucfirst($noticia->categoria) ?></td>
        <?php if (!empty($noticia->imagenes)): ?>
        <?php $imagenes = explode(',', $noticia->imagenes); ?>
        <?php $imagenMostrar = base_url('uploads/' . $imagenes[0]); ?>
        <td><img src="<?= $imagenMostrar ?>" alt="<?= $noticia->titulo ?>" width="100"></td>
        <?php else: ?>
        <td>-No ingreso-</td>
        <?php endif; ?>
        <td>
            <a href="<?= base_url('noticias/show/' . $noticia->id) ?>" class="btn btn-info">Ver
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </a>
            <a href="<?= base_url('noticias/edit/' . $noticia->id) ?>" class="btn btn-warning">Corregir
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-magic"
                    viewBox="0 0 16 16">
                    <path
                        d="M9.5 2.672a.5.5 0 1 0 1 0V.843a.5.5 0 0 0-1 0zm4.5.035A.5.5 0 0 0 13.293 2L12 3.293a.5.5 0 1 0 .707.707zM7.293 4A.5.5 0 1 0 8 3.293L6.707 2A.5.5 0 0 0 6 2.707zm-.621 2.5a.5.5 0 1 0 0-1H4.843a.5.5 0 1 0 0 1zm8.485 0a.5.5 0 1 0 0-1h-1.829a.5.5 0 0 0 0 1zM13.293 10A.5.5 0 1 0 14 9.293L12.707 8a.5.5 0 1 0-.707.707zM9.5 11.157a.5.5 0 0 0 1 0V9.328a.5.5 0 0 0-1 0zm1.854-5.097a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L8.646 5.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0l1.293-1.293Zm-3 3a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L.646 13.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0z" />
                </svg>
            </a>
        </td>
    </tr>
    <?php $contador++; ?>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<!-- PUBLICADAS-->
<?php if (!empty($estadoNoticias['publicada'])): ?>
<br>
<h2>Publicadas</h2>
<table>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Categoría</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php $contador = 1; ?>
    <?php foreach ($estadoNoticias['publicada'] as $noticia): ?>
    <tr>
        <td><?= $contador ?></td>
        <td><?= substr($noticia->titulo, 0, 25) . '...' ?></td>
        <td><?= substr($noticia->descripcion, 0, 25) . '...' ?></td>
        <td><?= date('Y-m-d', strtotime($noticia->fecha_creacion)) ?></td>
        <td><?= ucfirst($noticia->categoria) ?></td>
        <?php if (!empty($noticia->imagenes)): ?>
        <?php $imagenes = explode(',', $noticia->imagenes); ?>
        <?php $imagenMostrar = base_url('uploads/' . $imagenes[0]); ?>
        <td><img src="<?= $imagenMostrar ?>" alt="<?= $noticia->titulo ?>" width="100"></td>
        <?php else: ?>
        <td>-No ingreso-</td>
        <?php endif; ?>
        <td>
            <a href="<?= base_url('noticias/show/' . $noticia->id) ?>" class="btn btn-info">Ver
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </a>
            <?php if ($rol === 'editor_validador' || $rol === 'validador'): ?>
                <a href="<?= base_url('noticias/correction/' . $noticia->id) ?>" class="btn btn-danger">Despublicar
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-magic"
                    viewBox="0 0 16 16">
                    <path
                        d="M9.5 2.672a.5.5 0 1 0 1 0V.843a.5.5 0 0 0-1 0zm4.5.035A.5.5 0 0 0 13.293 2L12 3.293a.5.5 0 1 0 .707.707zM7.293 4A.5.5 0 1 0 8 3.293L6.707 2A.5.5 0 0 0 6 2.707zm-.621 2.5a.5.5 0 1 0 0-1H4.843a.5.5 0 1 0 0 1zm8.485 0a.5.5 0 1 0 0-1h-1.829a.5.5 0 0 0 0 1zM13.293 10A.5.5 0 1 0 14 9.293L12.707 8a.5.5 0 1 0-.707.707zM9.5 11.157a.5.5 0 0 0 1 0V9.328a.5.5 0 0 0-1 0zm1.854-5.097a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L8.646 5.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0l1.293-1.293Zm-3 3a.5.5 0 0 0 0-.706l-.708-.708a.5.5 0 0 0-.707 0L.646 13.94a.5.5 0 0 0 0 .707l.708.708a.5.5 0 0 0 .707 0z" />
                </svg>
            </a>
        <?php endif;?>
            <a href="<?= base_url('noticias/deshacer/' . $noticia->id) ?>" class="btn btn-warning">Deshacer</a>
            
        </td>
    </tr>
    <?php $contador++; ?>
    <?php endforeach; ?>
</table>
<?php endif; ?>


<!-- FINALIZADAS -->
<?php if (!empty($estadoNoticias['finalizada'])): ?>
<br>
<h2>Finalizadas</h2>
<table>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Categoría</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php $contador = 1; ?>
    <?php foreach ($estadoNoticias['finalizada'] as $noticia): ?>
    <tr>
        <td><?= $contador ?></td>
        <td><?= substr($noticia->titulo, 0, 25) . '...' ?></td>
        <td><?= substr($noticia->descripcion, 0, 25) . '...' ?></td>
        <td><?= date('Y-m-d', strtotime($noticia->fecha_creacion)) ?></td>
        <td><?= ucfirst($noticia->categoria) ?></td>
        <?php if (!empty($noticia->imagenes)): ?>
        <?php $imagenes = explode(',', $noticia->imagenes); ?>
        <?php $imagenMostrar = base_url('uploads/' . $imagenes[0]); ?>
        <td><img src="<?= $imagenMostrar ?>" alt="<?= $noticia->titulo ?>" width="100"></td>
        <?php else: ?>
        <td>-No ingreso-</td>
        <?php endif; ?>
        <td>
            <a href="<?= base_url('noticias/show/' . $noticia->id) ?>" class="btn btn-info">Ver
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </a>
        </td>
    </tr>
    <?php $contador++; ?>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<!-- DESCARTADAS -->
<?php if (!empty($estadoNoticias['descartado'])): ?>
<br>
<h2>Descartadas</h2>
<table>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Fecha</th>
        <th>Categoría</th>
        <th>Imagen</th>
        <th>Acciones</th>
    </tr>
    <?php $contador = 1; ?>
    <?php foreach ($estadoNoticias['descartado'] as $noticia): ?>
    <tr>
        <td><?= $contador ?></td>
        <td><?= substr($noticia->titulo, 0, 25) . '...' ?></td>
        <td><?= substr($noticia->descripcion, 0, 25) . '...' ?></td>
        <td><?= date('Y-m-d', strtotime($noticia->fecha_creacion)) ?></td>
        <td><?= ucfirst($noticia->categoria) ?></td>
        <?php if (!empty($noticia->imagenes)): ?>
        <?php $imagenes = explode(',', $noticia->imagenes); ?>
        <?php $imagenMostrar = base_url('uploads/' . $imagenes[0]); ?>
        <td><img src="<?= $imagenMostrar ?>" alt="<?= $noticia->titulo ?>" width="100"></td>
        <?php else: ?>
        <td>-No ingreso-</td>
        <?php endif; ?>
        <td>
            <a href="<?= base_url('noticias/show/' . $noticia->id) ?>" class="btn btn-info">Ver
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye"
                    viewBox="0 0 16 16">
                    <path
                        d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z" />
                    <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0" />
                </svg>
            </a>
            <a href="<?= base_url('noticias/deshacer/' . $noticia->id) ?>" class="btn btn-warning">Deshacer</a>
        </td>


    </tr>
    <?php $contador++; ?>
    <?php endforeach; ?>
</table>
<?php endif; ?>

<?php else: ?>
<p>No has creado noticias todavía.</p>
<?php endif; ?>

<div>
    <a href="<?= base_url('usuarios/perfil') ?>" class="btn btn-outline-info">Volver</a>
</div>

<?= $this->endSection(); ?>