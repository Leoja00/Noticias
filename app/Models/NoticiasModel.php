<?php

namespace App\Models;

use CodeIgniter\Model;

class NoticiasModel extends Model
{
    protected $table = 'noticias';
    protected $primaryKey = 'id'; 
    protected $allowedFields = ['titulo', 'descripcion', 'estado', 'categoria', 'id_editor', 'id_validador', 'activo', 'imagenes', 'fecha_creacion', 'fecha_modificacion', 'fecha_publicacion']; // Campos permitidos para asignación masiva

    protected $returnType = 'object'; 
    protected $useTimestamps = false; 
    protected $createdField = 'fecha_creacion'; 
    protected $updatedField = 'fecha_modificacion'; 
    protected $deletedField = '';
    public function countActiveNoticias()
    {
        return $this->where('activo', 1)->countAllResults();
    }
}
