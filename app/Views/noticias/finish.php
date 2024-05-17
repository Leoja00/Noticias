<?= $this->extend('plantilla'); ?>

<?= $this->section("finish") ?>

<!-- FINALIZADAS -->
<h1>Noticias Finalizadas</h1>
<?php if (!empty($noticias)): ?>
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
    <?php foreach ($noticias as $noticia): ?>
        <?php $noticia = (array) $noticia;  ?>
    <tr>
        <td><?= $contador ?></td>
        <td><?= substr(esc($noticia['titulo']), 0, 25) . '...' ?></td>
        <td><?= substr(esc($noticia['descripcion']), 0, 25) . '...' ?></td>
        <td><?= date('Y-m-d', strtotime($noticia['fecha_creacion'])) ?></td>
        <td><?= ucfirst(esc($noticia['categoria'])) ?></td>
        <?php if (!empty($noticia['imagenes'])): ?>
        <?php $imagenes = explode(',', $noticia['imagenes']); ?>
        <?php $imagenMostrar = base_url('uploads/' . $imagenes[0]); ?>
        <td><img src="<?= esc($imagenMostrar) ?>" alt="<?= esc($noticia['titulo']) ?>" width="100"></td>
        <?php else: ?>
        <td>-No ingreso-</td>
        <?php endif; ?>
        <td>
            <a href="<?= base_url('noticias/show/' . $noticia['id']) ?>" class="btn btn-info">Ver
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
<?php else: ?>
<p>No hay noticias finalizadas disponibles.</p>
<?php endif; ?>

<?= $this->endSection(); ?>
