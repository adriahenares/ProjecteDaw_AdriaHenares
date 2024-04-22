<?php

namespace App\Models;

use CodeIgniter\Model;

class DeviceTypeModel extends Model
{
    protected $table            = 'deviceType';
    protected $primaryKey       = 'device_type_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['device_type'];

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

    public function addDeviceType($deviceType) {
        $data = [
            'device_type' => $deviceType
        ];
    }

    public function getAllDevices()
    {
        $device = $this->select('device_type')->findAll();

        $dataDevice = [];

        foreach ($device as $dataLoop) {
            $dataDevice[] = $dataLoop['device_type'];
        }

        return $dataDevice;
    }

}
