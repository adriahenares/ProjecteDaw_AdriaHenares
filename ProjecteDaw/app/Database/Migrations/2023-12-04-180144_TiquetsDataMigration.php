<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TiquetsDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'device_type_id'          => [
                'type'       => 'integer',
                'constraint' => '16',
                null => false,
            ],
            'device_type'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false,
            ],
        ]);
        $this->forge->addPrimaryKey('device_type_id', true);
        $this->forge->createTable('devicetype');

        $this->forge->addField([
            'status_id'          => [
                'type'       => 'integer',
                'constraint' => '16',
                null => false,
            ],
            'status'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false,
            ],
        ]);
        $this->forge->addPrimaryKey('status_id', true);
        $this->forge->createTable('status');

        $this->forge->addField([
            'ticket_id'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false
            ],
            'device_type_id'       => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
            ],
            'fault_description' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null' => false,
            ],
            'g_center_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'r_center_code' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'email_person_center_g' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null' => false,
            ],
            'name_person_center_g' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
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
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
           
        ]);
        $this->forge->addPrimaryKey('ticket_id', true);
        $this->forge->addForeignKey('status_id', 'status', 'status_id', true);
        $this->forge->addForeignKey('device_type_id', 'devicetype', 'device_type_id', true);
        $this->forge->createTable('tickets');

    }



    public function down()
    {
        $this->forge->dropTable('tickets');
        $this->forge->dropTable('status');
        $this->forge->dropTable('devicetype');
    }
}
