<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateTestTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'first_name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
            ],
            'middle_initial' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
            ],
            'last_name' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => false,
            ],
            'loan' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'value' => [
                'type' => 'DECIMAL',
                'constraint' => '10,2',
                'null' => false,
            ],
            'ltv' => [
                'type' => 'VARCHAR',
                'constraint' => 191,
                'null' => true,
            ],
            'created_at' => [
                'type' => 'TIMESTAMP',
                'default' => null,
            ],
            'updated_at' => [
                'type' => 'TIMESTAMP',
                'default' => null,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('test');
    }

    public function down()
    {
        $this->forge->dropTable('test');
    }
}
