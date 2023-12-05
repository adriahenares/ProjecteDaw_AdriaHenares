<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class TiquetsDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'deviceType'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false,
            ],
        ]);
        $this->forge->addPrimaryKey('deviceType', true);
        $this->forge->createTable('deviceType');

        $this->forge->addField([
            'status'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false,
            ],
        ]);
        $this->forge->addPrimaryKey('status', true);
        $this->forge->createTable('statusId');

        $this->forge->addField([
            'ticketId'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false
            ],
            'deviceType'       => [
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
            'emailOfPerson_center_g' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null' => false,
            ],
            'nameOfPerson_center_g' => [
                'type'       => 'VARCHAR',
                'constraint' => '64',
                'null' => false,
            ],
            'dateOfLastModification' => [
                'type'       => 'date',
                'null' => false,
            ], 
            'registrationData' => [
                'type'       => 'date',
                'null' => false,
            ], 
            'status' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
           
        ]);
        $this->forge->addPrimaryKey('ticketid', true);
        $this->forge->createTable('tickets');
        $this->forge->addForeignKey('status', 'device_type', true);
    }



    public function down()
    {
        $this->forge->dropTable('tickets');
        $this->forge->dropTable('status');
        $this->forge->dropTable('device_type');
    }
}
