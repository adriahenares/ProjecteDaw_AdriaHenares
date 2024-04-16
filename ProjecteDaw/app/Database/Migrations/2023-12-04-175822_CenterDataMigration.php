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
        $this->forge->addKey('region_id', true);
        $this->forge->createTable('regions');

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
            'region_id'          => [
                'type'           => 'INT',
                'constraint'     => '2',
                'null'           => false,
        ]
        ]);
        $this->forge->addKey('town_id', true);
        $this->forge->addForeignKey('region_id', 'regions', 'region_id');
        $this->forge->createTable('towns');

        $this->forge->addField([
            'center_id'          => [
                    'type'           => 'INT',
                    'constraint'     => '8',
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
                    'null'           => false,
            ],
        ]);
        $this->forge->addKey('center_id', true);
        $this->forge->addKey('center_id', true);

        $this->forge->addForeignKey('town_id', 'towns', 'town_id');
        $this->forge->addForeignKey('SSTT_id', 'SSTT', 'SSTT_id'); 
        $this->forge->createTable('centers');

        $this->forge->addField([
                'student_id'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '16',
                        'null'           => false,
                ],
                'email'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '32',
                        'null'           => false,
                        'unique'         => true,
                ],
        ]);
        $this->forge->addKey('student_id', true);
        $this->forge->createTable('students');

        $this->forge->addField([
                'professor_id'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '16',
                        'null'           => false,
                ],
                'name'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '32',
                ],
                'surnames'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '64',
                ],
                'email'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '32',
                        'null'           => false,
                ],
                'repair_center_id'          => [
                        'type'           => 'INT',
                        'constraint'     => '8',
                        'null'           => false,
        ],
        ]);
        $this->forge->addKey('professor_id', true);
        $this->forge->addKey('email', false, true);
        $this->forge->addKey('name', false, true);
        $this->forge->addForeignKey('repair_center_id', 'centers', 'center_id'); 
        $this->forge->createTable('professors');
    }

    public function down()
    {
        $this->forge->dropTable('centers');
        $this->forge->dropTable('towns');
        $this->forge->dropTable('regions');

        $this->forge->dropTable('students');
        $this->forge->dropTable('professors');
    }
}