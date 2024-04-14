<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionTypeModel;
use App\Libraries\UUID;
use App\Models\InterventionModel;

class InterventionsController extends BaseController
{
    public function addIntervention($ticketId) {
        // falta passar-li els professor i alumnes filtrats per instituts o classe ??
        session()->setFlashdata('idTicket',$ticketId);
        $instanceIT = new InterventionTypeModel();
        $data = [
            'interTypes' => $instanceIT->getAllInterTypes(),
            'title' => lang('ticketsLang.titleG'),
        ];
        return view('Project/interventions/addIntervention', $data);
    }

    //falta
    public function updateIntervention($ticket) {
        session()->setFlashdata('idTicket',$ticket);
        $data = [
            'title' => lang('ticketsLang.titleG'),
        ];
        return view('Project/interventions/updateIntervention', $data);
    }

    public function addIntervention_post() {
        $instanceI = new InterventionModel();
        $uuid = new UUID();
        //validation important
        //data
        $data = [
            'intervention_id' => $uuid::v4(),
            'ticket_id' => session()->getFlashdata("idTicket"),
            'professor_id' => $this->request->getPost('professor'),
            'student_id' => $this->request->getPost('student'),
            'intervention_type_id' => $this->request->getPost('interventionType'),
            'description' => $this->request->getPost('description'),
            'student_course' => $this->request->getPost('cicle'),
            'student_studies' => $this->request->getPost('course'),
        ];
        var_dump($data);
        die;
        $instanceI->insert($data);
    }


    //falta
    public function updateIntervention_post() {

    }

    //falta
    public function delIntervention($ticket) {
        var_dump("hola");
        die;
    }
}
