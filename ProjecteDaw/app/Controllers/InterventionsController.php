<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;

class InterventionsController extends BaseController
{
    public function viewInterventions() {
        // si no funcione pot ser lo del false amb slug
        $model = new InterventionModel();
        $data['interventions'] = $model -> getInterventions();
    }

    public function viewAddIntervention() {

    }

    public function addIntervention_post() {

    }

    public function crudIntervention_post() {

    }
}
