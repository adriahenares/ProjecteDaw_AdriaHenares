<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\StatusModel;


class TicketsInterventionsController extends BaseController
{
    /**
     * Undocumented function
     *
     * @param [type] $id
     * @return void
     */
    public function viewIntermediary($id)
    {
        $ticketModel = new TicketModel();
        $statusModel = new StatusModel();
        $interventionsModel = new InterventionModel();
        $data['ticket'] = $ticketModel->retrieveSpecificData($id);
        $data['status'] = $statusModel->getStatus($data['ticket']['status_id']);
        $data['interventions'] = $interventionsModel->getInterventionsByTicketId($id);


        return view('Project/intermediaryTicInter/intermediary', $data);
    }
}
