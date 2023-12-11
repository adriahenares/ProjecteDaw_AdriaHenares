<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CenterDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'region_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '2',
                    'null'           => false,
            ],
            'name'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '64',
                    'null'           => false,
            ],
        ]);
        $this->forge->addKey('region_id', true);
        $this->forge->createTable('region');

        $this->forge->addField([
            'town_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '5',
                    'null'           => false,
            ],
            'name'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '64',
                    'null'           => false,
            ],
        ]);
        $this->forge->addKey('town_id', true);
        $this->forge->createTable('town');

        $this->forge->addField([
            'center_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '8',
                    'auto_increment' => true,
                    'null'           => false,
            ],
            'name'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '64',
                    'null'           => false,
            ],
            'address'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '64',
                    'null'           => false,
            ],
            'phone'          => [
                    'type'           => 'INT',
                    'constraint'     => 9,
                    'null'           => false,
            ],
            'email'          => [
                    'type'           => 'VARCHAR',
                    'constraint'     => '32',
                    'null'           => false,
            ],
            'town_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '5',
                    'null'           => false,
            ],
            'region_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '2',
                    'null'           => false,
            ],
            'SSTT_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '4',
                    'null'           => false,
            ],
            'active'          => [
                    'type'           => 'TINYINT',
                    'constraint'     => '1',
                    'null'           => false,
            ],
            'workshop'          => [
                    'type'           => 'TINYINT',
                    'constraint'     => '1',
            ],
        ]);
        $this->forge->addKey('center_id', true);

        $this->forge->addForeignKey('town_id', 'town', 'town_id');
        $this->forge->addForeignKey('region_id', 'region', 'region_id');
        $this->forge->addForeignKey('SSTT_id', 'SSTT', 'SSTT_id'); 
        $this->forge->createTable('center');
    }

    public function down()
    {
        $this->forge->dropTable('region');
        $this->forge->dropTable('town');
        $this->forge->dropTable('center');
    }
}