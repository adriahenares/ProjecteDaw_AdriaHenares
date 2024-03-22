<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ProfessorModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;

class TicketsController extends BaseController
{
    public function viewTickets()
    {
        helper('lang');
        $crud = new KpaCrud();
        $crud->setTable('tickets');
        $crud->setPrimaryKey('ticket_id');
        $crud->setColumns(['ticket_id', 'device_type_id', 'registration_data', 'date_last_modification', 'status_id']);
        $crud->setColumnsInfo([
            'ticket_id' => ['name' => 'Id'],
            'device_type_id' => ['name' => 'Id tipus dispositiu'],
            'registration_data' => ['name' => 'Data de registre', 'type' => KpaCrud::DATETIME_FIELD_TYPE],
            'date_last_modification' => ['name' => 'Data ultima modificació', 'type' => KpaCrud::DATETIME_FIELD_TYPE],
            'status_id' => ['name' => 'Id status'],
        ]);
        // preguntar
        $crud->addItemLink('view', 'fa-file', base_url('/ticket/' . 'ticket_id'), 'Mostrar intervencions');
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.title'),
        ];

        return view('Project/Tickets/viewTickets', $data);
    }

    public function addTickets()
    {
        $instance = new ProfessorModel();
        $stringDate = date('d-m-Y');
        $time = strtotime($stringDate);
        $date = date('Y-m-d', $time);
        $data['dateNow'] = $date;

        $id = "testprofessor";
        $data['codeGenCenter'] = $instance->getGeneratingCodeById($id);
        return view('Project/Tickets/viewTickets', $data);
    }

    public function addTickets_Post()
    {
        $instance = new TicketModel();
        // generacio number random uuid despres
        $numberOfDigits16 = 16;
        $idTicket = "";
        for ($j = 0; $j < $numberOfDigits16; $j++) {
            $idTicket .= rand(0, 9);
        }
        $device_type_id = 0;
        $fault_description = $this->request->getPost('description');
        $g_center_code = $this->request->getPost('generating_center');
        $r_center_code = $this->request->getPost('repair_center');
        $email_person_center_g = $this->request->getPost('email_person_contact');
        $name_person_center_g = $this->request->getPost('person_contact_center');
        $date_last_modification = $this->request->getPost('date_last_modification');
        $registration_data = $this->request->getPost('registration_data');
        $status_id = 0;
        $instance->addTicket(
            $idTicket,
            $device_type_id,
            $fault_description,
            $g_center_code,
            $r_center_code,
            $email_person_center_g,
            $name_person_center_g,
            $date_last_modification,
            $registration_data,
            $status_id
        );
    }
}
