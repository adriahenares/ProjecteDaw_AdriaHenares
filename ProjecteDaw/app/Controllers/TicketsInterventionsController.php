<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;
use App\Models\StockModel;
use App\Models\TicketModel;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\StatusModel;
use \Hermawan\DataTables\DataTable;


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
        if (session()->get('role') == 'Admin' || session()->get('role') == 'SSTT' || session()->get('role') == 'Professor' || session()->get('role') == 'Student') {
            $ticketModel = new TicketModel();
            $statusModel = new StatusModel();
            $data['id'] = $id;
            $data['ticket'] = $ticketModel->retrieveSpecificData($id);
            $data['status'] = $statusModel->getStatus($data['ticket']['status_id']);
            $stockModel = new StockModel();
            $data['stock'] = $stockModel->getStockByCenterId(session()->get('idCenter'));
            return view('Project/intermediaryTicInter/intermediary', $data);
        } else {
            echo '<alert>No tens permisos</alert>';
            return redirect()->to('login');
        }
    }
    public function loadTableData($id)
    {
        if (session()->get('role') == 'Admin' || session()->get('role') == 'SSTT' || session()->get('role') == 'Professor' || session()->get('role') == 'Student') {
            $interventionsModel = new InterventionModel();
            $builder = $interventionsModel->interventionsByTicketId($id);
            return DataTable::of($builder)
                ->add('action', function ($row) {
                    return  '<a href="' . base_url('deleteIntervention/' . $row->intervention_id) . '"><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></a>';
                }, 'last')
                ->toJson();
        } else {
            echo '<alert>No tens permisos</alert>';
            return redirect()->to('login');
        }
    }
    public function addIntervention($id)
    {
        $validationRules = [
            'stock' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Falten camps',
                ],
            ],
            'description' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Falten camps',
                ],
            ],
        ];
        if ($this->validate($validationRules)) {
            if ($this->request->getPost('addButton') !== null) {
                $interventionId = UUID::v4();
                $interventionModel = new InterventionModel();
                $stockModel = new StockModel();
                $item = $stockModel->retrieveItem($this->request->getPost('stock'));
                $interventionType = 1;
                if ($item['stock_type_id'] == 6) {
                    $interventionType = 2;
                }
                if (session()->get('role') == 'Professor' || session()->get('role') == 'Center') {
                    $interventionModel->addIntervention($interventionId, $id, session()->get('id'), null, $interventionType, $this->request->getPost('description'), $this->request->getPost('course'), $this->request->getPost('studies'));
                } else if (session()->get('role') == 'Student') {
                    $interventionModel->addIntervention($interventionId, $id, null, session()->get('id'), $interventionType, $this->request->getPost('description'), $this->request->getPost('course'), $this->request->getPost('studies'));
                }
                $stockModel->addItemToIntervention($this->request->getPost('stock'), $interventionId);
                return redirect()->back();
            }
        } else {
            session()->setFlashdata('error', 'Falten camps');
            return redirect()->back()->withInput();
        }
    }

    public function deleteIntervention($id)
    {
        if (session()->get('role') == 'Professor') {
            $stockModel = new StockModel();
            $stockModel->removeStockIntervention($id);
            $interventionModel = new InterventionModel();
            $interventionModel->deleteIntervention($id);
        }
        return redirect()->back();
    }
}
