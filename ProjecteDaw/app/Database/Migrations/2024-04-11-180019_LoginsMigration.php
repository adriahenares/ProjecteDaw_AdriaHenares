<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoginsMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idRole' => [
                'type' => 'INT',
                'constraint' => '16',
                'auto_increment' => true, 
            ],
            'role' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
            ]
        ]);

        $this->forge->addKey('idRole', true);
        $this->forge->createTable('roles');

        $this->forge->addField([
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => '32',
                'null' => false,
            ],
        ]);
        $this->forge->addKey('email', true);
        $this->forge->createTable('logins');


        $this->forge->addField([
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '64',
            ],
            'idRole' => [
                'type' => 'INT',
                'constraint' => '16',
            ],
        ]);
        $this->forge->addPrimaryKey(['email', 'idRole']);
        $this->forge->addForeignKey('email', 'logins', 'email');
        $this->forge->addForeignKey('idRole', 'roles', 'idRole');
        $this->forge->createTable('usersinrole');
    }

    public function down()
    {
        $this->forge->dropTable('idRole');
        $this->forge->dropTable('logins');
        $this->forge->dropTable('usersinrole');
    }
}
