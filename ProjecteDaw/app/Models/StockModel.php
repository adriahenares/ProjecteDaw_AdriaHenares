<?php

namespace App\Models;

use App\Libraries\UUID;
use CodeIgniter\Model;

class StockModel extends Model
{
    protected $table            = 'stock';
    protected $primaryKey       = 'stock_id';
    protected $useAutoIncrement = false;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['stock_id','stock_type_id','description','intervention_id','center_id','purchase_date','price'];

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

    public function addStock($description, $stock_type_id, $center_id, $price)
    {
        $data = [
            'stock_id' => UUID::v4(),
            'stock_type_id' => $stock_type_id,
            'description' => $description,
            'intervention_id' => null,
            'center_id' => $center_id,
            'purchase_date' => date('Y-m-d'),
            'price' => $price
        ];
        $this->insert($data);
    }

    //Aleix
    public function retrieveData()
    {
        return $this->findAll();
    }
    //Aleix
    public function retrieveSpecificItem($stock) {
        return $this->where('stock_id', $stock)->first();
    }

    //Aleix
    public function checkIfInterventionAssigned($id) {
        $stock = $this->where("stock_id", $id)->first();
        $assigned = false;
        if ($stock['intervention_id'] == null) {
            $assigned = false;
        } else {
            $assigned = true;
        }
        return $assigned;
    }
}
