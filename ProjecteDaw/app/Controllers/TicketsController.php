<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CenterModel;
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

        $crud = new KpaCrud();
        /**
         * Retorno true o false depent de la pag on estem, per mostrar o no el boto de add ticket
         */
        if ($crud->isEditMode()) {
            $data['badd'] = false;
        } else {
            $data['badd'] = true;
        }
        //KpaCrud
        $crud->setTable('tickets');
        $crud->setPrimaryKey('ticket_id');
        $crud->setRelation('status_id', 'status', 'status_id', 'status');
        $crud->setRelation('device_type_id', 'deviceType', 'device_type_id', 'device_type');
        $crud->setRelation('email_person_center_g', 'professors', 'email', 'email');
        //$crud->setRelation('name_person_center_g', 'professors2', 'name', 'name');
        $crud->setRelation('g_center_code', 'centers', 'center_id', 'name');
        $crud->setRelation('r_center_code', 'centers2', 'center_id', 'name');
        $crud->setColumns(['ticket_id', 'deviceType__device_type', 'fault_description', 'centers__name', 'centers2__name', 'created_at', 'status__status']);
        $crud->setColumnsInfo([
            'ticket_id' => [
                'name' => 'Identificador',
                'type' => KpaCrud::READONLY_FIELD_TYPE,
                'default' => UUID::v4(),
                'html_atts' => [
                    'disabled'
                ]
            ],
            'deviceType__device_type' => [
                'name' => 'Tipus de dispositiu'
            ],
            'fault_description' => [
                'name' => 'Descripció'
            ],
            'centers__name' => [
                'name' => 'Institut generador',
            ],
            'centers2__name' => [
                'name' => 'Institut reparador',
            ],
            'email_person_center_g' => [
                'name' => 'Email generador',
            ],
            'name_person_center_g' => [
                'name' => 'Nom generador',
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
            ],
            'deleted_at' => [
                'name' => 'Data esborrar',
                'html_atts' => [
                    'disabled'
                ]
            ],
            'status__status' => [
                'name' => 'Estat',
            ]
        ]);

        $crud->addItemLink('view', 'fa-solid fa-eye', base_url('/interventionsOfTicket'), 'Mostrar intervencions');
        $crud->addItemLink('delTicket', 'fa fa-trash-o', base_url('/delTicket'), 'Eliminar ticket');
        $crud->addItemLink('assign', 'fa fa-arrow-right', base_url('/assignTicket'), 'Assignar');

        // document.querySelector("#item-1 > td:nth-child(4) > a:nth-child(3)") meter text-danger y borrar text-primary
        $crud->setConfig('ssttView');
        $data['output'] = $crud->render();
        // $data['title'] = lang('ticketsLang.titleG');
        // $data['title'] = '';

        return view('Project/Tickets/viewTickets', $data);
    }

    public function addTicket()
    {
        $instanceDT = new DeviceTypeModel();
        $instanceC = new CenterModel();
        $data = [
            'title' => lang('ticketsLang.titleG'),
            'device' => $instanceDT->getAllDevices(),
            'center' => $instanceC->getAllCentersId(),
        ];
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
            'center_g' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'center_r' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'email' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
            'name' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'camp requerit',
                ],
            ],
        ];
        //validacio temporal
        $email =$this->request->getPost('email');
        $name = $this->request->getPost('name');
        if ($email != 'anilei@xtec.cat') {
            session()->setFlashdata('error', 'el email: ' . $email . ' no esta a la base de dades, en desenvolupament');
            return redirect()->back()->withInput();
        }
        if ($name != 'Alexander') {
            session()->setFlashdata('error', 'el nom: ' . $name . ' no esta a la base de dades, en desenvolupament');
            return redirect()->back()->withInput();
        }
        //validation
        if ($this->validate($validationRules)) {
            // si ets SSTT el g_center_code es obligatori
            // name email gCenter es sessio si ets professor 
            $data = [
                'ticket_id' => $uuid::v4(),
                'device_type_id' => $this->request->getPost('device'),
                'fault_description' => $this->request->getPost('description'),
                'g_center_code' => $this->request->getPost('center_g'),
                'r_center_code' => $this->request->getPost('center_r'),
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
        $centerId = $instanceC->getAllCentersId();
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
        return redirect()->to('assign');
    }

    //updateTicket
    public function updateTicket()
    {
        return redirect()->to(base_url('assign'));
    }

    //deleteTicket
    public function deleteTicket($ticket)
    {
        // securitzar
        $instanceT = new TicketModel();
        $instanceT->delete($ticket);
        return redirect()->back()->withInput();
    }
}
