<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginsModel extends Model
{
    protected $table = 'logins';
    protected $primaryKey = 'email';
    protected $useAutoIncrement = false;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['email', 'password'];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

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


    public function getUserByMail($email)
    {
        return $this->where('email', $email)->first();
    }

    public function getRoleByEmail($mail)
    {
        $userRoleModel = new UsersInRoleModel();
        $userRoleId = $userRoleModel->getRoleByEmail($mail)['idRole'];
        $roleModel = new RolesModel();
        $role = $roleModel->getRoleById($userRoleId)['role'];
        return $role;
    }

    public function findIfUserInRole($id, $roleToSearch)
    {
        $query = $this->where();
    }

    public function userExists($email)
    {
        $this->where('email', $email);
        $query = $this->get();
        if ($query->getNumRows() > 0) {
            return true;
        }
        return false;
    }

    public function addLogin($email, $password)
    {
        $data = [
            'email' => $email,
            'password' => password_hash($password, PASSWORD_DEFAULT)
        ];
        $this->insert($data);
    }
    public function deleteLogin($email)
    {
        $this->where('email', $email)->delete();
    }
}
