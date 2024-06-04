<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\InterventionModel;
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
            $builder = $interventionsModel->interventionsByTicket($id);
            return DataTable::of($builder)
                ->add('action', function ($row) {
                    return '<button type="button" class="btn btn-primary btn-sm" onclick="alert(\'edit customer: ' . $row->intervention_id . '\')" ><i class="fas fa-edit"></i></button>';
                }, 'last')
                ->toJson();
        } else {
            echo '<alert>No tens permisos</alert>';
            return redirect()->to('login');
        }
    }
}
