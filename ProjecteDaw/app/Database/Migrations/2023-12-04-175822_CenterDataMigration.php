<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CenterDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id_region'          => [
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
        $this->forge->addKey('id_region', true);
        $this->forge->createTable('region');

        $this->forge->addField([
            'id_town'          => [
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
        $this->forge->addKey('id_town', true);
        $this->forge->createTable('town');

        $this->forge->addField([
            'id_center'          => [
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
            'id_town'          => [
                    'type'           => 'INT',
                    'constraint'     => '5',
                    'null'           => false,
            ],
            'id_region'          => [
                    'type'           => 'INT',
                    'constraint'     => '2',
                    'null'           => false,
            ],
            'id_SSTT'          => [
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
        $this->forge->addKey('id_center', true);

        $this->forge->addForeignKey('id_town', 'town', 'id_town');
        $this->forge->addForeignKey('id_region', 'region', 'id_region');
        $this->forge->addForeignKey('id_SSTT', 'SSTT', 'id_SSTT'); 
        $this->forge->createTable('center');
    }

    public function down()
    {
        $this->forge->dropTable('region');
        $this->forge->dropTable('town');
        $this->forge->dropTable('center');
    }
}