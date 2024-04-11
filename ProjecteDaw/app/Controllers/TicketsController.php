<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CenterModel;
use App\Models\ProfessorModel;
use App\Models\StatusModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\DeviceTypeModel;

use function PHPSTORM_META\type;

class TicketsController extends BaseController
{
    /** 
     * Funcio per veure tots el tickets 
     * 
     * s'utilitza la llibreria kpa crud per visualitzar el tiquet
     * 
     * @return obj;
     */
    public function ssttView() {
        $crud = new KpaCrud();
        $crud->setTable('tickets');
        $crud->setPrimaryKey('ticket_id');
        $crud->setRelation('device_type_id', 'devicetype', 'device_type_id', 'device_type');
        $crud->setRelation('g_center_code', 'centers', 'center_id', 'name');
        $crud->setRelation('status_id', 'status', 'status_id', 'status');
        $crud->setColumns(['ticket_id', 'devicetype__device_type', 'fault_description', 'centers__name', 'status__status']);
        $crud->setConfig('ssttView');
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleG'),
        ];
        
        return view('ssttView/ssttView', $data);
    }
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
        $crud->setRelation('email_person_center_g', 'professors', 'email', 'email');
        //$crud->setRelation('name_person_center_g', 'professors2', 'name', 'name');
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
                // 'default' => 'testprofessor@me.local',
                // 'html_atts' => [
                //     'disabled'
                // ]
            ],
            'name_person_center_g' => [
                'name' => 'Nom generador',
                // 'default' => 'Alexander',
                // 'html_atts' => [
                //     'disabled'
                // ]
            ],
            'created_at' => [
                'name' => 'Data de registre',
                'default' => date('Y-m-d h:m:s'),
                'html_atts' => [
                    'disabled'
                ]
                // 'type' => KpaCrud::DATETIME_FIELD_TYPE,
                // 'type' => KpaCrud::INVISIBLE_FIELD_TYPE
            ],
            'updated_at' => [
                'name' => 'Data ultima modificació',
                'default' => date('Y-m-d h:m:s'),
                'html_atts' => [
                    'disabled'
                ]
                // 'type' => KpaCrud::DATETIME_FIELD_TYPE,
                // 'type' => KpaCrud::INVISIBLE_FIELD_TYPE
            ],
            'deleted_at' => [
                'name' => 'Data esborrar',
                // 'type' => KpaCrud::DATETIME_FIELD_TYPE,
                'default' => date('Y-m-d h:m:s'),
                'html_atts' => [
                    'disabled'
                ]
            ],
            // 'date_last_modification' => [
            //     // 'name' => 'Data ultima modificació',
            //         // 'type' => KpaCrud::DATETIME_FIELD_TYPE,
            //     // 'default'=> $date,
            //     'type' => KpaCrud::INVISIBLE_FIELD_TYPE
            //     // 'type' => KpaCrud::READONLY_FIELD_TYPE
            //         // 'default'=> date('Y-m-d H:i:s'),
            //         // 'default'=> date('Y-m-d h:m:s')

            // ],
            // 'registration_data' => [
            //     'name' => 'Data de registre',
            //     // 'default'=> $date,
            //     'type' => KpaCrud::INVISIBLE_FIELD_TYPE
            //     // 'default'=> date('Y-m-d h:m:s'),

            // ],
            'status__status' => [
                'name' => 'Estat',
                // 'type' => KpaCrud::DROPDOWN_FIELD_TYPE,
                // 'options' => array_combine($statusNum, $status),
                // 'html_atts' => ["required",]
            ]
        ]);
        // preguntar
        $crud->addItemLink('view', 'fa-file', base_url('/interventionsOfTicket'), 'Mostrar intervencions');
        // $crud->setConfig(["editable" => false, "removable" => false]);

        $crud->setConfig('centerView');
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleG'),
        ];

        return view('Project/Tickets/viewTickets', $data);
    }

    public function addTicket()
    {
        $instanceDT = new DeviceTypeModel();
        $instanceS = new StatusModel();
        $data = [
            'title' => lang('ticketsLang.titleG'),
            'status' => $instanceS->getAllStatus(),
            'device' => $instanceDT->getAllDevices(),
        ];
        return view('Project/Tickets/createTickets', $data);
    }

    public function addTicketPost()
    {
        $instanceT = new TicketModel();
        $uuid = new UUID();
        //validation
        //data
        $date = date('Y-m-d H:i:s');
        $data = [
            'ticket_id' => $uuid::v4(),
            'device_type_id' => $this->request->getPost('device'),
            'fault_description' => $this->request->getPost('description'),
            'g_center_code' => '8000013',
            'r_center_code' => null,
            'email_person_center_g' => $this->request->getPost('email_person_contact'),
            'name_person_center_g' => $this->request->getPost('person_contact_center'),
            'status_id' => $this->request->getPost('status'),
        ];
        // var_dump($data);
        // die;
        /* $ticketId = $uuid::v4();
        $deviceType = $this->request->getPost('device');
        $fault = $this->request->getPost('description');
        $g_centerCode = '8.000.013';
        $r_centerCode = null;
        $email = $this->request->getPost('email_person_contact');
        $person = $this->request->getPost('person_contact_center');
        $dateAdd = getdate();
        $dateMod = getdate();
        $status = $this->request->getPost('status'); */
        $instanceT->insert($data);
    }

    //assignacio ticket
    public function assingTicketsView()
    {
        // variables per obtenir els selects
        //type device

        //center codes
        $crud = new KpaCrud();
        $crud->setTable('tickets');
        $crud->setPrimaryKey('ticket_id');
        $crud->setColumns(['ticket_id', 'device_type_id', 'created_at', 'updated_at', 'status_id']);
        $crud->setColumnsInfo([
            'ticket_id' => ['name' => 'Id'],
            'device_type_id' => ['name' => 'Id dispositiu'],
            'status_id' => ['name' => 'Id status'],
        ]);
        $crud->addItemLink('view', 'fa-file', base_url('/assingTicket/'), 'Mostrar intervencions');
        $crud->setConfig('centerView');
        // $crud->addWhere('r_center_code != null');
        $data = [
            'output' => $crud->render(),
            'title' => lang('ticketsLang.titleA'),
        ];
        return view('Project/Tickets/assingTickets', $data);
    }


    //assignacio ticket
    public function assingTicket($id)
    {
        $instanceC = new CenterModel();
        $centerId = $instanceC->getAllCentersId();
        $data['id'] = $id;
        $data['centerId'] = $centerId;
        return view('Project/Tickets/assingTicketsTrue', $data);
    }


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
