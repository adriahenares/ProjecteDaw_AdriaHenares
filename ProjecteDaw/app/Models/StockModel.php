<?php

namespace App\Models;

use App\Libraries\UUID;
use CodeIgniter\Model;
use \Hermawan\DataTables\DataTable;

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

    public function addStock($stockType, $description, $price,  $date, $centerId)
    {
        $data = [
            'stock_id' => UUID::v4(),
            'stock_type_id' => $stockType,
            'description' => $description,
            'intervention_id' => null,
            'price' => $price,
            'purchase_date' => $date,
            'center_id' => $centerId,
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

    public function stockByCenterId($id) {
        return $this->select('stock.stock_id, stock.stock_type_id, stocktype.name, stock.description, stock.purchase_date, stock.price')
        ->join('stocktype', 'stocktype.stock_type_id = stock.stock_type_id')
        ->where('stock.center_id', $id)
        ->where('stock.intervention_id');
    }

    public function editStock($id, $type, $description, $date, $price)
}
