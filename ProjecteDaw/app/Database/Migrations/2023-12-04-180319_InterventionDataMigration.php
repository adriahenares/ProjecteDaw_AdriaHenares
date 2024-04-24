<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class InterventionDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'intervention_type_id'          => [
                'type'       => 'INT',
                'constraint' => '4',
                'auto_increment' => true,
                null => false,
            ],
            'intervention_type'          => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                null => false,
            ],
        ]);
        $this->forge->addKey('intervention_type_id', true);
        $this->forge->createTable('interventionType');



        $this->forge->addField([
            'intervention_id'       => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                null => false
            ],
            'ticket_id'          => [
                'type'       => 'VARCHAR',
                'constraint' => '36',
                null => false
            ],
            'professor_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
            'student_id' => [
                'type'       => 'VARCHAR',
                'constraint' => '16',
                'null' => false,
            ],
            'intervention_type_id' => [
                'type'       => 'INT',
                'constraint' => '4',
                'null' => false,
            ],
            'description' => [
                'type'       => 'TEXT',
                'null' => false,
            ],
            'student_course' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'student_studies' => [
                'type'       => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'intervention_date' => [
                'type'       => 'date',
                'null' => false,
            ],
            'created_at timestamp default current_timestamp',//SSTT: Ficar-ho a 0
            'deleted_at timestamp null default null',
            'updated_at timestamp default current_timestamp on update current_timestamp',
        ]);
        $this->forge->addKey('intervention_id', true);
        $this->forge->addForeignKey('ticket_id', 'tickets', 'ticket_id', true);
        $this->forge->addForeignKey('student_id', 'students', 'student_id', true);
        $this->forge->addForeignKey('professor_id', 'professors', 'professor_id', true);
        $this->forge->addForeignKey('intervention_type_id', 'interventionType', 'intervention_type_id', true);
        $this->forge->createTable('interventions');
    }



    public function down()
    {
        $this->forge->dropTable('interventions');
        $this->forge->dropTable('interventionType');
    }
}
