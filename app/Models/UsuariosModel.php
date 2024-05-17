<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuariosModel extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'id'; 

    protected $allowedFields = ['usuario', 'email', 'contrasena', 'rol']; 

    protected $returnType = 'object';
    protected $useTimestamps = false;
    protected $createdField = ''; 
    protected $updatedField = ''; 
    protected $deletedField = ''; 
}