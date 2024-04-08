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
        $uuid = new UUID();
        //functions
        $ticket = $modelTicket->retrieveSpecificData($id);
        $idInter = UUID::v4();
        //kpaCrud
        $crud = new KpaCrud();
        $crud->setTable('interventions');
        $crud->setPrimaryKey('intervention_id');
        $crud->setColumns(['description', 'intervention_type_id', 'student_course', 'student_studies', 'intervention_date']);
        $crud->setColumnsInfo([
            'intervention_id' => ['default' => $idInter],
            'ticket_id' => ['default' => $ticket['ticket_id']],
            'description' => ['name' => 'descripció'],
            'intervention_type_Id' => ['name' => 'tipus intervencio'],
            'student_course' => [
                'name' => 'N curs',
                'type' => KpaCrud::DROPDOWN_FIELD_TYPE,
                'options' => ["1" => "1", "2" => "2"],
                'html_atts' => [
                    "required",
                ],
            ],
            'student_studies' => [
                'name' => 'nombre Curs',
                'type' => KpaCrud::DROPDOWN_FIELD_TYPE,
                'options' => ["DAM" => "DAM", "DAW" => "DAW", "ASIX" => "ASIX"],
                'html_atts' => [
                    "required",
                ],
            ],
            'intervention_date' => ['name' => 'data de intervenció', 'type' => KpaCrud::DATETIME_FIELD_TYPE],
        ]);
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleG'),
            'ticket' => $ticket,
        ];

        // obtenim el el ticket en especific i les intervencions associades a aquells

        return view('Project/intermediaryTicInter/intermediary.php', $data);
    }
}
