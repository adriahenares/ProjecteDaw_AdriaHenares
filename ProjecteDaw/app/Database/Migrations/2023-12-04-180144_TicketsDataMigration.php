<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TiquetsDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'device_type_id'          => [
                'type'       => 'INT',
                'constraint' => '4',
                'auto_increment' => true,
                'null' => false,
            ],
            'device_type'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('device_type_id', true);
        $this->forge->createTable('deviceType');

        $this->forge->addField([
            'status_id'          => [
                'type'       => 'INT',
                'constraint' => '4',
                'auto_increment' => true,
                'null' => false,
            ],
            'status'          => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('status_id', true);
        $this->forge->createTable('status');

        $this->forge->addField([
            'ticket_id'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false
            ],
            'device_type_id'       => [
                'type'       => 'INT',
                'constraint' => '4',
                'auto_increment' => false,
            ],
            'fault_description' => [
                'type'       => 'TEXT',
                'null' => false,
            ],
            'g_center_code' => [
                'type'       => 'INT',
                'constraint' => '8',
                'null' => false,
            ],
            'r_center_code' => [
                'type'       => 'INT',
                'constraint' => '8',
                'null' => false,
            ],
            'email_person_center_g' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'name_person_center_g' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'date_last_modification' => [
                'type'       => 'date',
                'null' => false,
            ], 
            'registration_data' => [
                'type'       => 'date',
                'null' => false,
            ], 
            'status_id' => [
                'type'       => 'INT',
                'constraint' => '4',
                'auto_increment' => false,
                'null' => false,
            ]
        ]);

        $this->forge->addKey('ticket_id', true);
        $this->forge->addForeignKey('status_id', 'status', 'status_id');
        $this->forge->addForeignKey('device_type_id', 'deviceType', 'device_type_id');
        $this->forge->addForeignKey('g_center_code', 'centers', 'center_id');
        $this->forge->addForeignKey('r_center_code', 'centers', 'center_id');
        $this->forge->addForeignKey('email_person_center_g', 'professors', 'email');
        $this->forge->addForeignKey('name_person_center_g', 'professors', 'name', true);

        $this->forge->createTable('tickets');
    }
    public function down()
    {
        $this->forge->dropTable('tickets');
        $this->forge->dropTable('status');
        $this->forge->dropTable('deviceType');
    }
}
