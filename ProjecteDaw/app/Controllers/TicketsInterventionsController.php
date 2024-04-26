<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;

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
        //functions
        $ticket = $modelTicket->retrieveSpecificData($id);
        //kpaCrud
        $crud = new KpaCrud();
        $crud->setTable('interventions');
        $crud->setPrimaryKey('intervention_id');
        $crud->setColumns(['description', 'intervention_type_id', 'created_at']);
        $crud->setColumnsInfo([
            'description' => ['name' => 'descripció'],
            'intervention_type_Id' => ['name' => 'tipus intervencio'],
            'student_course' => ['name' => 'N curs'],
            'student_studies' => ['name' => 'nombre Curs'],
            'created_at' => ['name' => 'Data creació'],
        ]);
        // $crud->setConfig('centerView');
        $crud->setConfig('onlyView');
        // $crud->addItemLink('del', 'fa-mail', base_url('/updateIntervention'), 'Modificar Intervencio');
        // $crud->addItemLink('view', 'fa-file', base_url('/delIntervention'), 'Eliminar Intervencio');
        // falta filtrar per intervencio
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleG'),
            'ticket' => $ticket,
        ];

        // obtenim el el ticket en especific i les intervencions associades a aquells

        return view('Project/intermediaryTicInter/intermediary', $data);
    }
}
