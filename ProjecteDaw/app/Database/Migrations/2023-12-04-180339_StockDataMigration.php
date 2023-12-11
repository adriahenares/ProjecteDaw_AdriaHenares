<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class StockDataMigration extends Migration
{
    public function up()
    {
            $this->forge->addField([
                    'stock_id'          => [
                            'type'           => 'INT',
                            'constraint'     => 12,
                            'null'           => false,
                    ],
                    'id_type_stock'          => [
                            'type'           => 'INT',
                            'null'           => false,
                    ],
                    'intervention_id'          => [
                            'type'           => 'INT',
                            'null'           => false,
                    ],
                    'id_center'          => [
                            'type'           => 'INT',
                            'constraint'     => 8,
                            'null'           => false,
                    ],
                    'purchase_date'          => [
                            'type'           => 'DATE',
                            'null'           => false,
                    ],
                    'price'          => [
                            'type'           => 'INT',
                            'null'           => false,
                    ],
                    'repair_center_code'          => [
                            'type'           => 'VARCHAR',
                            'null'           => false,
                    ],
            ]);
            $this->forge->addPrimaryKey('stock_id', true);
            $this->forge->addKey('id_type_stock');
    
            $this->forge->addKey('intervention_id');
    
            $this->forge->addKey('id_center');
    
            $this->forge->createTable('stock');
            $this->forge->addForeignKey('id_type_stock', 'type_stock', 'id_type_stock');
            $this->forge->addForeignKey('intervention_id', 'intervention', 'intervention_id');
            $this->forge->addForeignKey('id_center', 'center', 'id_center');
    
    
    }
    
    public function down()
    {
            $this->forge->dropTable('stock');
    }
}
