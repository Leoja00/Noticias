<?= $this->extend('plantilla'); ?>

<?= $this->section("historial") ?>

<h1>Historial de las noticias</h1>
<?php if (!empty($historialAgrupado)): ?>
<table>
    <tr>
        <th>#</th>
        <th>Título</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Activa/Desactivada</th>
        <th>Fecha modificacion</th>
    </tr>
    <?php $contadorPrincipal = 1; ?>
    <?php foreach ($historialAgrupado as $noticia_id => $acciones): ?>
    <tr>
        <td><?= $contadorPrincipal ?></td>
        <td><?= substr($acciones[0]['titulo'], 0, 25) . '...' ?></td>
        <td><?= substr($acciones[0]['descripcion'], 0, 25) . '...' ?></td>
        <td><?= ucfirst($acciones[0]['estado']) ?></td>
        <td><?= $acciones[0]['activo'] == 1 ? 'Activado' : 'Desactivado' ?></td>
        <td><?= $acciones[0]['fecha_modificacion_historial'] != '0000-00-00 00:00:00' ? date('Y-m-d', strtotime($acciones[0]['fecha_modificacion_historial'])) : '---' ?>
        </td>

        <td>
            <?php if (count($acciones) > 1): ?>
            <button onclick="toggleDetails(<?= $noticia_id ?>)" id="toggle-button-<?= $noticia_id ?>"
                class="btn btn-primary">Ver más</button>

            <?php endif; ?>
        </td>
    </tr>
    <?php if (count($acciones) > 1): ?>
    <tr id="details-<?= $noticia_id ?>" style="display: none;">
        <td colspan="6">
            <table>
                <tr>
                    <th>#</th>
                    <th>Título</th>
                    <th>Descripción</th>
                    <th>Estado</th>
                    <th>Activa/Desactivada</th>
                    <th>Fecha Modificación</th>
                </tr>
                <?php $contadorSecundario = 1; ?>
                <?php foreach ($acciones as $index => $accion): ?>
                <?php if ($index > 0): ?>
                <tr>
                    <td><?= $contadorSecundario ?></td>
                    <td><?= substr($accion['titulo'], 0, 25) . '...' ?></td>
                    <td><?= substr($accion['descripcion'], 0, 25) . '...' ?></td>
                    <td><?= ucfirst($accion['estado']) ?></td>
                    <td><?= $accion['activo'] == 1 ? 'Activado' : 'Desactivado' ?></td>
                    <td><?= $accion['fecha_modificacion_historial'] != '0000-00-00 00:00:00' ? date('Y-m-d H:i:s', strtotime($accion['fecha_modificacion_historial'])) : '---' ?>
                    </td>
                </tr>
                <?php $contadorSecundario++; ?>
                <?php endif; ?>
                <?php endforeach; ?>
            </table>

        </td>
    </tr>
    <?php endif; ?>
    <?php $contadorPrincipal++; ?>
    <?php endforeach; ?>
</table>
<?php else: ?>
<p>No hay historial disponible.</p>
<?php endif; ?>

<div>
    <a href="<?= base_url('usuarios/perfil') ?>" class="btn btn-outline-info">Volver</a>
</div>

<script>
function toggleDetails(noticia_id) {
    const detailsRow = document.getElementById('details-' + noticia_id);
    const button = document.getElementById('toggle-button-' + noticia_id);
    if (detailsRow.style.display === 'none') {
        detailsRow.style.display = '';
        button.textContent = 'Ocultar';
    } else {
        detailsRow.style.display = 'none';
        button.textContent = 'Ver más';
    }
}
</script>

<?= $this->endSection(); ?>