<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateVocabulariesTable extends Migration
{
    public function up()
    {
        // column
        $this->forge->addField([
            'id' => [
                'type'           => 'INT',
                'constraint'     => 11,
                'unsigned'       => true,
                'auto_increment' => true,
            ],
            'word' => [
                'type'       => 'VARCHAR',
                'constraint' => '100',
            ],
            'type' => [
                'type'       => 'VARCHAR',
                'constraint' => '20',
                'null'       => true, 
            ],
            'definition' => [
                'type' => 'TEXT',
            ],
            'example' => [
                'type' => 'TEXT',
                'null' => true,
            ],
            'created_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
            'updated_at' => [
                'type' => 'DATETIME',
                'null' => true,
            ],
        ]);

        // Primary Key
        $this->forge->addKey('id', true);

        // tạo bảng có tên là 'vocabularies'
        $this->forge->createTable('vocabularies');
    }

    public function down()
    {
        // Khi gõ lệnh rollback, nó sẽ xóa bang vocabularies
        $this->forge->dropTable('vocabularies');
    }
}
