<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class LoginsMigration extends Migration
{
    public function up()
    {
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
    }

    public function down()
    {
        $this->forge->dropTable('logins');
    }
}
