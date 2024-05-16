<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class SSTTMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'SSTT_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '4',
                    'null'           => false,
            ],
            'name'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '128',
                    'null'           => false,
            ],
            'address'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '128',
            ],
            'phone'          => [
                    'type'           => 'INT',
                    'constraint'     => 9,
            ],
            'email'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '64',
            ],
            'language'          => [
                'type'           => 'VARCHAR',
                'constraint'     => '2',
                'null'           => false,
        ],
        ]);
        $this->forge->addKey('SSTT_id', true);
        $this->forge->createTable('SSTT');
    }

    public function down()
    {
        $this->forge->droptable('SSTT');
    }
}
