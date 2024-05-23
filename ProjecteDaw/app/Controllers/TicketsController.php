<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CenterModel;
use App\Models\StatusModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\DeviceTypeModel;
use App\Models\InterventionModel;
use App\Models\ProfessorModel;

// llibreria per fer un windows confirm
use SweetAlert\SweetAlert;

class TicketsController extends BaseController
{
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
        // d(session()->get('role'));
        //center codes
        $centerId = $instanceC->getAllCentersId();
        //status
        $status = $instanceS->getAllStatus();
        $statusNum = [];
        for ($i = 0; $i < count($status); $i++) {
            $statusNum[$i] = $i;
        }

        $crud = new KpaCrud();
        /**
         * Retorno true o false depent de la pag on estem, per mostrar o no el boto de add ticket
         */
        //KpaCrud
        $crud->setTable('tickets');
        $crud->setPrimaryKey('ticket_id');
        $crud->setRelation('status_id', 'status', 'status_id', 'status');
        $crud->setRelation('device_type_id', 'deviceType', 'device_type_id', 'device_type');
        //$crud->setRelation('email_person_center_g', 'professors', 'email', 'email');
        //$crud->setRelation('name_person_center_g', 'professors2', 'name', 'name');
        $crud->setRelation('g_center_code', 'centers', 'center_id', 'name');
        if (session()->get('role') != 'Professor') {
            $crud->setRelation('r_center_code', 'centers2', 'center_id', 'name');
            $crud->setColumns(['ticket_id', 'deviceType__device_type', 'fault_description', 'centers__name', 'centers2__name', 'created_at', 'status__status']);
            $crud->setColumnsInfo([
                'ticket_id' => [
                    'name' => lang('ticketsLang.ID'),
                    'type' => KpaCrud::READONLY_FIELD_TYPE,
                    'default' => UUID::v4(),
                    'html_atts' => [
                        'disabled'
                    ]
                ],
                'deviceType__device_type' => [
                    'name' => lang('ticketsLang.DeviceType')
                ],
                'fault_description' => [
                    'name' => lang('ticketsLang.Description')
                ],
                'centers__name' => [
                    'name' => lang('ticketsLang.EmitterCenter'),
                ],
                'centers2__name' => [
                    'name' => lang('ticketsLang.RepairCenter'),
                ],
                'email_person_center_g' => [
                    'name' => lang('ticketsLang.GeneratorMail'),
                ],
                'name_person_center_g' => [
                    'name' => lang('ticketsLang.GeneratorName'),
                ],
                'created_at' => [
                    'name' => lang('ticketsLang.CreatedAt'),
                    'default' => date('Y-m-d h:m:s'),
                    'html_atts' => [
                        'disabled'
                    ]
                    // 'type' => KpaCrud::DATETIME_FIELD_TYPE,
                    // 'type' => KpaCrud::INVISIBLE_FIELD_TYPE
                ],
                'updated_at' => [
                    'name' => lang('ticketsLang.UpdatedAt'),
                    'default' => date('Y-m-d h:m:s'),
                    'html_atts' => [
                        'disabled'
                    ]
                ],
                'deleted_at' => [
                    'name' => lang('ticketsLang.UpdatedAt'),
                    'html_atts' => [
                        'disabled'
                    ]
                ],
                'status__status' => [
                    'name' => 'Estat',
                ]
            ]);
        } else {
            $crud->setColumns(['ticket_id', 'deviceType__device_type', 'fault_description', 'centers__name', 'created_at', 'status__status']);
            $crud->setColumnsInfo([
                'ticket_id' => [
                    'name' => lang('ticketsLang.ID'),
                    'type' => KpaCrud::READONLY_FIELD_TYPE,
                    'default' => UUID::v4(),
                    'html_atts' => [
                        'disabled'
                    ]
                ],
                'deviceType__device_type' => [
                    'name' => lang('ticketsLang.DeviceType')
                ],
                'fault_description' => [
                    'name' => lang('ticketsLang.Description')
                ],
                'centers__name' => [
                    'name' => lang('ticketsLang.EmitterCenter'),
                ],
                'email_person_center_g' => [
                    'name' => lang('ticketsLang.GeneratorMail'),
                ],
                'name_person_center_g' => [
                    'name' => lang('ticketsLang.GeneratorName'),
                ],
                'created_at' => [
                    'name' => lang('ticketsLang.CreatedAt'),
                    'default' => date('Y-m-d h:m:s'),
                    'html_atts' => [
                        'disabled'
                    ]
                    // 'type' => KpaCrud::DATETIME_FIELD_TYPE,
                    // 'type' => KpaCrud::INVISIBLE_FIELD_TYPE
                ],
                'updated_at' => [
                    'name' => lang('ticketsLang.UpdatedAt'),
                    'default' => date('Y-m-d h:m:s'),
                    'html_atts' => [
                        'disabled'
                    ]
                ],
                'deleted_at' => [
                    'name' => lang('ticketsLang.UpdatedAt'),
                    'html_atts' => [
                        'disabled'
                    ]
                ],
                'status__status' => [
                    'name' => 'Estat',
                ]
            ]);
        }
        $crud->addWhere("deleted_at", null, false);
        $crud->setConfig('ssttView');        //sessions links
        $crud->addItemLink('view', 'fa-solid fa-eye', base_url('/Ticket'), 'Intervencions');
        $data['add'] = true;
        $role = session()->get('role');
        if ($role == 'Admin' || $role == 'SSTT' || $role == 'Center') {
            $crud->addItemLink('delTicket', 'fa fa-trash-o', base_url('/confirmDel'), 'Eliminar ticket');
            // $crud->addItemLink('delTicket', 'fa fa-trash-o', base_url('/confirmDel'), 'Eliminar ticket');
            if ($role != 'Center') {
                $crud->addItemLink('assign', 'fa-solid fa-school', base_url('/assignTicket'), 'Assignar');
            }
        } else {
            if ($role == 'Student') {
                $crud->setConfig(['editable' => false]);
                $data['add'] = false;
                $crud->addWhere("r_center_code", session()->idCenter);
            }
        }

        if ($role == 'Student' || $role == 'Professor' || $role == 'Center') {
            $crud->addWhere("r_center_code", session()->idCenter);
        }
        $crud->addWhere('deleted_at');
        // document.querySelector("#item-1 > td:nth-child(4) > a:nth-child(3)") meter text-danger y borrar text-primary
        $data['output'] = $crud->render();
        // $data['title'] = lang('ticketsLang.titleG');
        // $data['title'] = '';
        return view('Project/Tickets/viewTickets', $data);
    }

    public function addTicket()
    {
        $instanceDT = new DeviceTypeModel();
        $instanceC = new CenterModel();
        $instanceP = new ProfessorModel();
        $data = [
            'title' => lang('ticketsLang.titleG'),
            'device' => $instanceDT->getAllDevices(),
        ];
        //especific de cada vista
        $role = session()->get('role');
        $data['role'] = $role;
        if ($role == 'SSTT') {
            $data['center'] =  $instanceC->getAllCentersId();
            $data['repairCenters'] = $instanceC->getAllRepairingCenters();
            // dd($data['repairCenters']);
        } else if ($role == 'Professor') {
            $professor = $instanceP->obtainProfessor(session()->get('mail')); //session per mail 
            session()->setFlashdata('idCenter', $professor['repair_center_id']);
        }
        return view('Project/Tickets/createTickets', $data);
    }

    public function addTicketPost()
    {
        $instanceT = new TicketModel();
        $uuid = new UUID();
        $validationRules = [
            'device' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
        ];
        //validacio temporal
        /*$email =$this->request->getPost('email');
        $name = $this->request->getPost('name');
        if ($email != 'anilei@xtec.cat') {
            session()->setFlashdata('error', 'el email: ' . $email . ' no esta a la base de dades, en desenvolupament');
            return redirect()->back()->withInput();
        }
        if ($name != 'Alexander') {
            session()->setFlashdata('error', 'el nom: ' . $name . ' no esta a la base de dades, en desenvolupament');
            return redirect()->back()->withInput();
        }*/
        //validation
        if ($this->validate($validationRules)) {
            // si ets SSTT el g_center_code es obligatori
            // name email gCenter es sessio si ets professor
            $testUser = 1; //canvia per seesion
            //SSTT sessions !!
            if (session()->get('role') == 'SSTT') {
                $centerG =  $this->request->getPost('center_g');
                $centerR =  $this->request->getPost('center_r');
            } else {
                $centerG = session()->get('idCenter'); //sessio (flash)
                $centerR = null;
            }
            d($centerG);
            d($centerR);
            if ($centerG == '') {
                $centerG = null;
            }
            if ($centerR == '') {
                $centerR = null;
            }
            $data = [
                'ticket_id' => $uuid::v4(),
                'device_type_id' => $this->request->getPost('device'),
                'fault_description' => $this->request->getPost('description'),
                'g_center_code' => $centerG,
                'r_center_code' => $centerR,
                'email_person_center_g' => $this->request->getPost('email'),
                'name_person_center_g' => $this->request->getPost('name'),
                // status estandard
                'status_id' => '1',
            ];
            $instanceT->insert($data);
            return redirect()->to('viewTickets');
        } else {
            session()->setFlashdata('error', 'error camp obligatori');
            return redirect()->back()->withInput();
        }
    }

    //assignacio ticket

    //assignacio ticket sespecific
    public function assignTicket($id)
    {
        $instanceC = new CenterModel();
        $centerId = $instanceC->getAllRepairingCenters();
        $data['id'] = $id;
        $data['centerId'] = $centerId;
        return view('Project/Tickets/assignTicketsTrue', $data);
    }

    public function assignTicketPost($id)
    {
        $instanceT = new TicketModel();
        $valueR = [
            'r_center_code' => $this->request->getPost("idRepair"),
        ];
        $instanceT->assignTicket($id, $valueR);
        return redirect()->to('viewTickets');
    }

    //updateTicket
    public function updateTicket()
    {
        return redirect()->to(base_url('assign'));
    }


    public function confirmDelete($id)
    {
        $data = [
            'id' => $id,
        ];

        return view('/Project/confirm', $data);
    }


    //deleteTicket
    public function deleteTicket($ticket)
    {

        // dd($ticket);
        // fet i validat 
        $instanceI = new InterventionModel();

        $Interventions = $instanceI->getSpecificInterventions($ticket);

        if ($Interventions != null) {
            session()->setFlashdata('error', 'no es pot borrar el ticket');
            // return redirect()->back();
            return redirect()->to('viewTickets');
        }
        $instanceT = new TicketModel();
        $instanceT->deleteTicket($ticket);

        // dd($arr);
        // dd($interventionModel->getSpecificInterventions($ticket));

        // return redirect()->back()->withInput();
        return redirect()->to('viewTickets');
    }
}
