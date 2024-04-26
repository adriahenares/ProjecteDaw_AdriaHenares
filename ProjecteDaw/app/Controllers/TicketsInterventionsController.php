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
        //calls
        $modelTicket = new TicketModel();
        $status = new StatusModel();
        //functions
        $ticket = $modelTicket->retrieveSpecificData($id);
        //kpaCrud
        $crud = new KpaCrud();
        $crud->setTable('interventions');
        $crud->setPrimaryKey('intervention_id');
        $crud->setRelation('intervention_type_id', 'interventionType', 'intervention_type_id', 'intervention_type');
        $crud->setColumns(['description', 'interventionType__intervention_type', 'created_at']);
        $crud->setColumnsInfo([
            'description' => ['name' => 'descripció'],
            'interventionType__intervention_type' => ['name' => 'Tipus intervenció'],
            'created_at' => ['name' => 'Data creació'],
        ]);
        // $crud->setConfig('centerView');
        $crud->addWhere('ticket_id', $id);
        $crud->setConfig('onlyView');
        // $crud->addItemLink('del', 'fa-mail', base_url('/updateIntervention'), 'Modificar Intervencio');
        // $crud->addItemLink('view', 'fa-file', base_url('/delIntervention'), 'Eliminar Intervencio');
        // falta filtrar per intervencio
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleG'),
            'ticket' => $ticket,
            'status' => $status->getStatus($ticket['status_id'])
        ];

        // obtenim el el ticket en especific i les intervencions associades a aquells

        return view('Project/intermediaryTicInter/intermediary', $data);
    }
}
