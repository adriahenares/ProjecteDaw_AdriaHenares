<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;

class InterventionsController extends BaseController
{
    public function index()
    {
        //
    }
    public function viewInterventions($slug = false) {
        $model = new InterventionModel();
        $data['interventions'] = $model -> getInterventions($slug);
    }
}
