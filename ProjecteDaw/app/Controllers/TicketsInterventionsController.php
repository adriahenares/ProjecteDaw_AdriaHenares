<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\StatusModel;
use \Hermawan\DataTables\DataTable;


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
        $data['id'] = $id;
        $data['ticket'] = $ticketModel->retrieveSpecificData($id);
        $data['status'] = $statusModel->getStatus($data['ticket']['status_id']);
        $data['interventions'] = $interventionsModel->getInterventionsByTicketId($id);
        return view('Project/intermediaryTicInter/intermediary', $data);
    }
    public function loadTableData($id) {
        $db = db_connect();
        $builder = $db->table('interventions')->select('intervention_id');
        return DataTable::of($builder)->toJson();
    }
}
