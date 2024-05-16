<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CenterModel;
use CodeIgniter\HTTP\ResponseInterface;
use CodeIgniter\API\ResponseTrait;

class Gets extends BaseController
{
    use ResponseTrait;

    public function emailByCenter($id)
    {
        $instanceC = new CenterModel();
        $data = $instanceC->putEmailOfCenter($id);
        return $this->respond($data, 200);
    }
}
