<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Libraries\UUID;
use App\Models\CenterModel;
use App\Models\StockModel;
use App\Models\StockTypeModel;
use \Hermawan\DataTables\DataTable;

class StockController extends BaseController
{
    public function viewStock()
    {
        $stockTypeModel = new StockTypeModel();
        $data['types'] = $stockTypeModel->findAll();
        return view('Project/stock/viewStock', $data);
    }

    public function loadTableData($id)
    {
        if (session()->get('role') == 'Admin' || session()->get('role') == 'SSTT' || session()->get('role') == 'Professor' || session()->get('role') == 'Student') {
            $stockModel = new StockModel();
            $builder = $stockModel->stockByCenterId($id);
            return DataTable::of($builder)
                ->add('action', function ($row) {
                    return '<button type="button" class="btn btn-primary btn-sm" onclick=edit("' . $row->stock_id . '","' . $row->stock_type_id . '","' . str_replace(" ", "¬", $row->description) . '","' . $row->purchase_date . '","' . $row->price . '") ><i class="fas fa-edit"></i></button>
                    <a href="'. base_url('delStock/'. $row->stock_id) . '"><button type="button" class="btn btn-danger btn-sm"><i class="fa-solid fa-trash"></i></button></a>';
                }, 'last')
                ->hide('stock_id')
                ->hide('stock_type_id')
                ->toJson();
        } else {
            echo '<alert>No tens permisos</alert>';
            return redirect()->to('login');
        }
    }
    public function addStock_post()
    {
        $validationRules = [
            'type' => [
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
            'date' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Falten camps',
                ],
            ],
            'price' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Falten camps',
                ],
            ],
            'amount' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Falten camps',
                ],
            ],
        ];
        //validation
        if ($this->validate($validationRules)) {
            d($this->request->getPost());
            if ($this->request->getPost('addButton') !== null) {
                $stockModel = new StockModel();
                $amount = $this->request->getPost('amount');
                if ($amount <= 0) {
                    $amount = 1;
                }
                for ($i = 0; $i < $amount; $i++) {
                    $stockModel->addStock($this->request->getPost('type'), $this->request->getPost('description'), $this->request->getPost('price'), $this->request->getPost('date'), session()->get('idCenter'));
                }
            } else {
                $stockModel = new StockModel();
                $stockModel->editStock($this->request->getPost('stockId'), $this->request->getPost('type'), $this->request->getPost('description'), $this->request->getPost('date'), $this->request->getPost('price'));
            }
            return redirect()->to(base_url('/viewStock'));
        } else {
            session()->setFlashdata('error', 'dades insuficients');
            return redirect()->back()->withInput();
        }
    }
    public function deleteStock($id) {
        $stockModel = new StockModel();
        $item = $stockModel->retrieveItem($id);
        if (!$item['intervention_id']) {
            if (session()->get('role') == 'Professor' && session()->get('idCenter') == $item['center_id']) {
                $stockModel->deleteStock($id);
                return redirect()->to('viewStock');
            } else {
                return redirect()->to('login');
            }
        }
    }
    // public function viewStock()
    // {
    //     helper('lang');
    //     $crud = new KpaCrud();
    //     /**
    //      * Retorno true o false depent de la pag on estem, per mostrar o no el boto de add ticket
    //      */
    //     if ($crud->isEditMode()) {
    //         $data['badd'] = false;
    //     } else {
    //         $data['badd'] = true;
    //     }
    //     $crud->setTable('stock');
    //     $crud->setPrimaryKey('stock_id');
    //     $crud->setRelation('stock_type_id', 'stocktype', 'stock_type_id', 'name');
    //     $crud->setRelation('center_id', 'centers', 'center_id', 'name');
    //     $crud->setColumns(['stock_id', 'stocktype__name', 'intervention_id', 'centers__name', 'purchase_date', 'price']);
    //     $crud->setColumnsInfo([
    //         'stock_id' => [
    //             'name' => 'Identificador',
    //             'type' => KpaCrud::READONLY_FIELD_TYPE,
    //             'default' => UUID::v4(),
    //             'html_atts' => [
    //                 'disabled'
    //             ]
    //         ],
    //         'stocktype__name' => [
    //             'name' => 'Tipus de stock'
    //         ],
    //         'intervention_id' => [
    //             'name' => 'Intervencio assignada'
    //         ],
    //         'centers__name' => [
    //             'name' => 'centre del stock',
    //         ],
    //         'purchase_date' => [
    //             'name' => 'dia de compra',
    //         ],
    //         'price' => [
    //             'name' => 'preu (unitari)',
    //         ],
    //     ]);
    //     $crud->addItemLink('updateStock', 'fa-solid fa-school', base_url('updateStock'), 'Update stock');
    //     $crud->addItemLink('delTicket', 'fa fa-trash-o', base_url('/delStock'), 'Eliminar stock');

    //     $crud->setConfig('ssttView');
    //     $data['output'] = $crud->render();
    //     /*if(permisos usuari) {
    //         $crud->addWhere('center_id', session de id)

    //     }*/

    //     return view('Project/stock/viewStock', $data);
    // }

    // public function addStock()
    // {
    //     $instanceST = new StockTypeModel();
    //     $instanceC = new CenterModel();
    //     $data['types'] = $instanceST->retrieveAllTypes();
    //     $data['center'] =  $instanceC->getAllCentersId();
    //     return view('Project/stock/createStock', $data);
    // }

    public function updateStock($id)
    {
        $instance = new StockModel();
        $instanceST = new StockTypeModel();
        $instanceC = new CenterModel();
        $updateLevel = $instance->checkIfInterventionAssigned($id);
        //el stock en especific
        $data['stock'] = $instance->retrieveItem($id);
        // types
        $data['types'] = $instanceST->retrieveAllTypes();
        //center
        $data['center'] =  $instanceC->getAllCentersId();
        if ($updateLevel == true) {
            //tiquet assignat
            session()->setFlashdata("level", 1);
        } else {
            //tiquet no assignat
            session()->setFlashdata("level", 0);
        }
        return view('Project/stock/updateStock', $data);
    }

    public function updateStock_post($id)
    {
        if (session()->getFlashdata("level") == 1) {
        }
        if (session()->getFlashdata("level") == 0) {
            $validationRules = [
                'description' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
                'type_piece' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
                'price' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
                'center' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
                'number_units' => [
                    'rules' => 'required',
                    'errors' => [
                        'required' => 'camp requerit',
                    ],
                ],
            ];
            //validation
            if ($this->validate($validationRules)) {
                $instanceS = new StockModel();
                $description = $this->request->getPost('description');
                $typePiece = $this->request->getPost('type_piece');
                $price = $this->request->getPost('price');
                $center = $this->request->getPost('center');
                $numberItems = $this->request->getPost('number_units');
                if ($numberItems <= 0) {
                    $numberItems = 1;
                }
                for ($i = 0; $i < $numberItems; $i++) {
                    $instanceS->addStock($description, $typePiece, $center, $price);
                }
            } else {
                session()->setFlashdata('error', 'dades insuficients');
                return redirect()->back()->withInput();
            }
        }
        return redirect()->back()->withInput();
    }

    // public function deleteStock($stock)
    // {
    //     $instanceS = new StockModel();
    //     $item = $instanceS->retrieveSpecificItem($stock);
    //     if ($item['intervention_id'] != null) {
    //         session()->setFlashdata('error', 'no es pot eliminar un ticket assignat');
    //         redirect()->back();
    //     }
    //     //fe soft delete
    //     $instanceS->delete($stock);
    //     return redirect()->back();
    // }
}
