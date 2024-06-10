<?php

namespace App\Models;

use CodeIgniter\Model;

class UsersInRoleModel extends Model
{
    protected $table = 'usersinrole';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['email', 'idRole'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = [];
    protected $afterInsert = [];
    protected $beforeUpdate = [];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    public function getRoleByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function addUserRole($email, $role)
    {
        $data = [
            'email' => $email,
            'idRole' => $role
        ];
        $this->insert($data);
    }
    public function deleteUserRole($email)
    {
        $this->where('email', $email)->delete();
    }
}
