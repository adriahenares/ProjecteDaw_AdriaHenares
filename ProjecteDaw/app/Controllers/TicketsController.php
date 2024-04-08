<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CenterModel;
use App\Models\ProfessorModel;
use App\Models\StatusModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

use function PHPSTORM_META\type;

class TicketsController extends BaseController
{
    public function loadPage()
    {
        return redirect()->to(base_url('/viewTickets'));
    }
    /** 
     * Funcio per veure tots el tickets 
     * 
     * s'utilitza la llibreria kpa crud per visualitzar el tiquet
     * 
     * @return obj;
     */
    public function viewTickets()
    {
        helper('lang');
        $instanceS = new StatusModel();
        $instanceC = new CenterModel();
        // variables per obtenir els selects
        //type device

        //center codes
        $centerId = $instanceC->getAllCentersId();
        //status
        $status = $instanceS->getAllStatus();
        $statusNum = [];
        for ($i = 0; $i < count($status); $i++) {
            $statusNum[$i] = $i;
        }
        //KpaCrud
        $crud = new KpaCrud();
        $crud->setTable('tickets');
        $crud->setPrimaryKey('ticket_id');
        $crud->setColumns(['ticket_id', 'device_type_id', 'registration_data', 'date_last_modification', 'status_id']);
        $crud->setColumnsInfo([
            'ticket_id' => ['name' => 'Id'],
            'device_type_id' => ['name' => 'Id tipus dispositiu'],
            'g_center_code' => [
                'type' => KpaCrud::DROPDOWN_FIELD_TYPE,
                'options' => array_combine($centerId, $centerId),
                'html_atts' => ["required",],
            ],
            'r_center_code' => [
                'type' => KpaCrud::DROPDOWN_FIELD_TYPE,
                'options' => array_combine($centerId, $centerId),
                'html_atts' => ["required",],
            ],
            'registration_data' => ['name' => 'Data de registre', 'type' => KpaCrud::DATETIME_FIELD_TYPE],
            'date_last_modification' => ['name' => 'Data ultima modificació', 'type' => KpaCrud::DATETIME_FIELD_TYPE],
            'status_id' => [
                'name' => 'Id status',
                'type' => KpaCrud::DROPDOWN_FIELD_TYPE,
                'options' => array_combine($statusNum, $status),
                'html_atts' => ["required",]
            ],
        ]);
        // preguntar
        $crud->addItemLink('view', 'fa-file', base_url('/interventionsOfTicket/'), 'Mostrar intervencions');
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleG'),
        ];

        return view('Project/Tickets/viewTickets', $data);
    }

    public function assingTicketsView()
    {
        $instanceC = new CenterModel();
        // variables per obtenir els selects
        //type device

        //center codes
        $crud = new KpaCrud();
        $crud->setTable('tickets');
        $crud->setPrimaryKey('ticket_id');
        $crud->setColumns(['ticket_id', 'device_type_id', 'registration_data', 'date_last_modification', 'status_id']);
        $crud->setColumnsInfo([
            'ticket_id' => ['name' => 'Id'],
            'registration_data' => ['name' => 'Data de registre', 'type' => KpaCrud::DATETIME_FIELD_TYPE],
            'date_last_modification' => ['name' => 'Data ultima modificació', 'type' => KpaCrud::DATETIME_FIELD_TYPE],
            'status_id' => ['name' => 'Id status'],
        ]);
        $crud->addItemFunction('mailing', 'fa-paper-plane', array($this, 'assingTicket'), "Send mail");

        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleA'),
        ];
        return view('Project/Tickets/assingTickets', $data);
    }

    public function assingTicket($obj)
    {

        $this->request->getUri()->stripQuery('customf');
        $this->request->getUri()->addQuery('customf', 'mpost');

        $html = "<div class='container-fluid p-0'>";
        $html .= "<form method='post' action='" . base_url("/assingTicket") . "'>";
        $html .= "<input type='hidden' name='ticket_id' value='" . $obj['ticket_id'] . "'>";
        $html .= csrf_field();
        $html .= "<h1>Assigna al institut</h1>";
        $html .= "	<div style=\"margin-top:20px\" class=\"border bg-light\">";
        $html .= "		<div class=\"d-grid\" style=\"margin-top:20px\">";
        $html .= "			<div class=\"p-2 \">";
        $html .= "				<label>centre a assignar</label>";
        $html .= "				<div class=\"form-control bg-light \">";
        $html .= "                  <input type='text' name='idRepair'>";
        $html .= "				</div>";
        $html .= "			</div>";
        $html .= "		</div>";
        $html .= "	</div>";
        $html .= "<div class='pt-2'><input type='submit' value='Envia'></div></form>";
        $html .= "</div>";

        return $html;
    }

    // Create an invisible named function in KpaCrud to call after

    public function assingTicketPost()
    {
        $instanceT = new TicketModel();
        $valueId = $this->request->getPost("ticket_id");
        $valueR = [
            'r_center_code' => $this->request->getPost("idRepair"),
        ];
        $instanceT->assingTicket($valueId, $valueR);
        return redirect()->to(base_url('assing'));
    }
}
