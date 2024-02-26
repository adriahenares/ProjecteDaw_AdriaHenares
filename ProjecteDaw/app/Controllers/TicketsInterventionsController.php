<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketsModel;
use App\Models\InterventionModel;

class TicketsInterventionsController extends BaseController
{
    public function viewIntermediary($id)
    {
        // models
        $modelTicket = new TicketsModel();
        $modelIntervention = new InterventionModel();
        // obtenim el el ticket en especific i les intervencions associades a aquells
        $data['ticket'] = $modelTicket->retrieveSpecificData($id);
        $data['interventions'] = $modelIntervention->getSpecificInterventions($id);
        return view('Project/intermediaryTicInter/intermediary.php', $data);
    }
}
