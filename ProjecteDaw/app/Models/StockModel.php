<?php

namespace App\Models;

use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table            = 'stock';
    protected $primaryKey       = 'stock_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    public function addStock($stock_id, $stock_type_id, $intervention_id, $center_id, $purchase_date, $price)
    {
        $data = [
            'stock_id' => $stock_id,
            'stock_type_id' => $stock_type_id,
            'intervention_id' => $intervention_id,
            'center_id' => $center_id,
            'purchase_date' => $purchase_date,
            'price' => $price
        ];
    }

    public function retrieveData() 
    {
        return $this->findAll();
    }
}
