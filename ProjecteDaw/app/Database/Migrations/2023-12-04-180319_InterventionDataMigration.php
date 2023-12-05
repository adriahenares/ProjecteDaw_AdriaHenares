<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InterventionDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'interventionType'          => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                null => false,
            ],
        ]);
        $this->forge->addPrimaryKey('interventionType', true);
        $this->forge->createTable('interventionType');


        $this->forge->addField([
            'interventionId'       => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false
            ],
            'ticketId'          => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false
            ],
            'professorId' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
            'studentId' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
            'interventionType' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
            'description' => [
                'type'       => 'VARCHAR',
                'constraint' => '128',
                'null' => false,
            ],
            'studentCourse' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'studentStudies' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ], 
            'interventionDate' => [
                'type'       => 'date',
                'null' => false,
            ],  
        ]);
        $this->forge->addPrimaryKey('interventionId', true);
        $this->forge->createTable('interventions');
        $this->forge->addForeignKey('ticketId','studentId','professorId','interventionType', true);
    }



    public function down()
    {
        $this->forge->dropTable('interventions');
        $this->forge->dropTable('interventionType');
    }
}

