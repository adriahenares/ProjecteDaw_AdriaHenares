<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CenterModel;
use App\Models\ProfessorModel;
use App\Models\StatusModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use DateTime;

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

        // $date = date('Y-m-d H:i:s');
        $date = date('Y-d-m H:i:s');



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
        $crud->setRelation('status_id', 'status', 'status_id', 'status');
        $crud->setRelation('device_type_id', 'devicetype', 'device_type_id', 'device_type');
        $crud->setColumns(['ticket_id', 'devicetype__device_type', 'status__status']);
        // $crud->setColumns(['ticket_id', 'devicetype__device_type', 'registration_data', 'date_last_modification', 'status__status']);
        $crud->setColumnsInfo([
            'ticket_id' => [
                'name' => 'Identificador',
                'type' => KpaCrud::READONLY_FIELD_TYPE,
                'default' => UUID::v4(),
                'html_atts' => [
                    'disabled'
                ]
            ],
            'devicetype__device_type' => [
                'name' => 'Tipus de dispositiu'
            ],
            'fault_description' => [
                'name' => 'Descripció'
            ],
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
            'email_person_center_g' => [
                'name' => 'Email generador',
                'default' => 'testprofessor@me.local',
                'html_atts' => [
                    'disabled'
                ]
            ],
            'name_person_center_g' => [
                'name' => 'Nom generador',
                'default' => 'Alexander',
                'html_atts' => [
                    'disabled'
                ]
            ],
            'date_last_modification' => [
                // 'name' => 'Data ultima modificació',
                    // 'type' => KpaCrud::DATETIME_FIELD_TYPE,
                // 'default'=> $date,
                'type' => KpaCrud::INVISIBLE_FIELD_TYPE
                // 'type' => KpaCrud::READONLY_FIELD_TYPE
                    // 'default'=> date('Y-m-d H:i:s'),
                    // 'default'=> date('Y-m-d h:m:s')
                
            ],
            'registration_data' => [
                'name' => 'Data de registre',
                // 'default'=> $date,
                'type' => KpaCrud::INVISIBLE_FIELD_TYPE
                // 'default'=> date('Y-m-d h:m:s'),
                
            ],
            'status__status' => [
                'name' => 'Estat',
                // 'type' => KpaCrud::DROPDOWN_FIELD_TYPE,
                // 'options' => array_combine($statusNum, $status),
                // 'html_atts' => ["required",]
            ],
            'deleted_at' => [
                'type' => KpaCrud::INVISIBLE_FIELD_TYPE
            ]
        ]);
        // preguntar
        $crud->addItemLink('view', 'fa-file', base_url('/interventionsOfTicket/'), 'Mostrar intervencions');
        // $crud->setConfig(["editable" => false, "removable" => false]);

        $crud->setConfig('centerView');
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
        $crud->addItemLink('view', 'fa-file', base_url('/assingTicket/'), 'Mostrar intervencions');
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleA'),
        ];
        return view('Project/Tickets/assingTickets', $data);
    }

    public function assingTicket($id)
    {
        $data['id'] = $id;
        return view('Project/Tickets/assingTicketsTrue', $data);
    }

    // Create an invisible named function in KpaCrud to call after

    public function assingTicketPost($id)
    {
        $instanceT = new TicketModel();
        $valueR = [
            'r_center_code' => $this->request->getPost("idRepair"),
        ];
        $instanceT->assingTicket($id, $valueR);
        return redirect()->to(base_url('assing'));
    }
}
