<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticiasHistorialModel extends Model
{
    protected $table = 'noticias_historial';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'noticia_id',
        'titulo',
        'descripcion',
        'estado',
        'categoria',
        'id_editor',
        'id_validador',
        'activo',
        'fecha_creacion',
        'fecha_modificacion',
        'fecha_publicacion',
        'imagenes',
        'fecha_modificacion_historial',
    ];

    protected $useTimestamps = true;
    protected $createdField  = 'fecha_modificacion_historial';
    protected $updatedField  = '';


    public function getLastAction($id)
    {
        return $this->where('noticia_id', $id)->orderBy('fecha_modificacion_historial', 'desc')->first();
    }

    public function revertLastAction($id)
    {
        
        $ultimoHistorial = $this->getLastAction($id);
        $accionAnterior = $this->where('noticia_id', $id)
                               ->where('fecha_modificacion_historial <', $ultimoHistorial['fecha_modificacion_historial'])
                               ->orderBy('fecha_modificacion_historial', 'desc')
                               ->first();

        return $accionAnterior;
    }
}