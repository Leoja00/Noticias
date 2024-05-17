<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Noticias extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'titulo' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
            ],
            'descripcion' => [
                'type' => 'TEXT',
            ],
            'estado' => [
                'type' => 'ENUM',
                'constraint' => ['borrador', 'lista_para_validar', 'publicada', 'para_correccion', 'finalizada','descartado'],
            ],
            'categoria' => [
                'type' => 'ENUM',
                'constraint' => ['politicas', 'deportivas', 'economicas', 'culturales', 'sociales'],
            ],
            'id_editor' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'id_validador' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'null' => true,
            ],
            'activo' => [
                'type' => 'BOOLEAN',
                'default' => false,
            ],
            'fecha_creacion' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'fecha_modificacion' => [
                'type' => 'DATETIME',
                'null' => true,
                'default' => null,
            ],
            'fecha_publicacion' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'imagenes' => [ 
                'type' => 'TEXT',
                'null' => true,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('id_editor', 'usuarios', 'id');
        $this->forge->addForeignKey('id_validador', 'usuarios', 'id');
        $this->forge->createTable('noticias');
    }

    public function down()
    {
        $this->forge->dropTable('noticias');
    }
}
