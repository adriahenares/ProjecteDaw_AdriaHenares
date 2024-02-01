<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StockDataMigration extends Migration
{
    public function up()
    {
        $this->forge->addField([
                'stock_type_id'          => [
                        'type'           => 'INT',
                        'constraint'     => '4',
                        'auto_increment' => true,
                        'null'           => false,
                ],
                'name'          => [
                        'type'           => 'VARCHAR',
                        'constraint'     => '64',
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('stock_type_id', true);
        $this->forge->createTable('stocktype');

        $this->forge->addField([
                'stock_id'          => [
                        'type'           => 'BINARY',
                        'constraint'     => '16',
                        'null'           => false,
                ],
                'stock_type_id'          => [
                        'type'           => 'INT',
                        'constraint'     => '4',
                        'null'           => false,
                ],
                'intervention_id'          => [
                        'type'           => 'BINARY',
                        'constraint'     => '16',
                        'null'           => false,
                ],
                'center_id'          => [
                        'type'           => 'INT',
                        'constraint'     => '8',
                        'null'           => false,
                ],
                'purchase_date'          => [
                        'type'           => 'DATE',
                        'null'           => false,
                ],
                'price'          => [
                        'type'           => 'INT',
                        'constraint'     => '8',
                        'null'           => false,
                ],
        ]);
        $this->forge->addKey('stock_id', true);
        $this->forge->addForeignKey('stock_type_id', 'stocktype', 'stock_type_id');
        $this->forge->addForeignKey('intervention_id', 'interventions', 'intervention_id');
        $this->forge->addForeignKey('center_id', 'centers', 'center_id');
        $this->forge->createTable('stock');
    }
    
    public function down()
    {
        $this->forge->dropTable('stock');
        $this->forge->dropTable('stocktype');
    }
}
