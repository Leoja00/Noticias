<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class NoticiasHistorial extends Migration
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
            'noticia_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
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
                'constraint' => ['borrador', 'lista_para_validar', 'publicada', 'para_correccion', 'finalizada', 'descartado'],
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
            'fecha_modificacion_historial' => [ 
                'type' => 'DATETIME',
                'null' => false,
            ],
        ]);

        $this->forge->addPrimaryKey('id');
        $this->forge->addForeignKey('noticia_id', 'noticias', 'id');
        $this->forge->createTable('noticias_historial');
    }

    public function down()
    {
        $this->forge->dropTable('noticias_historial');
    }
}