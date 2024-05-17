<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsuariosSeeder extends Seeder
{
    public function run()
    {
        // Datos de ejemplo para usuarios
        $data = [
            [
                'usuario' => 'admin',
                'email' => 'admin@example.com',
                'contrasena' => password_hash('admin123', PASSWORD_DEFAULT),
                'rol' => 'editor_validador',
            ],
            [
                'usuario' => 'editor',
                'email' => 'editor@example.com',
                'contrasena' => password_hash('editor123', PASSWORD_DEFAULT),
                'rol' => 'editor',
            ],
            [
                'usuario' => 'validador',
                'email' => 'validador@example.com',
                'contrasena' => password_hash('validador123', PASSWORD_DEFAULT),
                'rol' => 'validador',
            ],
            [
                'usuario' => '42278783',
                'email' => 'leoja00@gmail.com',
                'contrasena' => password_hash('123456789', PASSWORD_DEFAULT),
                'rol' => 'editor',
            ],
            [
                'usuario' => 'Leoja00',
                'email' => 'leoja00@icloud.com',
                'contrasena' => password_hash('123456789', PASSWORD_DEFAULT),
                'rol' => 'editor_validador',
            ],
            [
                'usuario' => 'Juan',
                'email' => 'juan@hotmail.com',
                'contrasena' => password_hash('123456789', PASSWORD_DEFAULT),
                'rol' => 'validador',
            ],
            [
                'usuario' => 'Leo123',
                'email' => 'leoja00@hotmail.com',
                'contrasena' => password_hash('123456789', PASSWORD_DEFAULT),
                'rol' => 'editor',
            ],
            [
                'usuario' => 'valeria123',
                'email' => 'valeria@gmail.com',
                'contrasena' => password_hash('123456789', PASSWORD_DEFAULT),
                'rol' => 'validador',
            ],
        ];

        $this->db->table('usuarios')->insertBatch($data);
    }
}