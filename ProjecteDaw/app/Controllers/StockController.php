<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use SIENSIS\KpaCrud\Libraries\KpaCrud;
use App\Libraries\UUID;
use App\Models\CenterModel;
use App\Models\StockModel;
use App\Models\StockTypeModel;
use Google\Service\CloudRedis\RedisEmpty;

class StockController extends BaseController
{
    public function viewStock()
    {
        helper('lang');
        $crud = new KpaCrud();
        /**
         * Retorno true o false depent de la pag on estem, per mostrar o no el boto de add ticket
         */
        if ($crud->isEditMode()) {
            $data['badd'] = false;
        } else {
            $data['badd'] = true;
        }
        $crud->setTable('stock');
        $crud->setPrimaryKey('stock_id');
        $crud->setRelation('stock_type_id', 'stocktype', 'stock_type_id', 'name');
        $crud->setRelation('center_id', 'centers', 'center_id', 'name');
        $crud->setColumns(['stock_id', 'stocktype__name', 'intervention_id', 'centers__name', 'purchase_date', 'price']);
        $crud->setColumnsInfo([
            'stock_id' => [
                'name' => 'Identificador',
                'type' => KpaCrud::READONLY_FIELD_TYPE,
                'default' => UUID::v4(),
                'html_atts' => [
                    'disabled'
                ]
            ],
            'stocktype__name' => [
                'name' => 'Tipus de stock'
            ],
            'intervention_id' => [
                'name' => 'Intervencio assignada'
            ],
            'centers__name' => [
                'name' => 'centre del stock',
            ],
            'purchase_date' => [
                'name' => 'dia de compra',
            ],
            'price' => [
                'name' => 'preu (unitari)',
            ],
        ]);

        $crud->addItemLink('delTicket', 'fa fa-trash-o', base_url('/delStock'), 'Eliminar item');

        $crud->setConfig('ssttView');
        $data['output'] = $crud->render();
        /*if(permisos usuari) {
            $crud->addWhere('center_id', session de id)

        }*/

        return view('Project/stock/viewStock', $data);
    }

    public function addStock() {
        $instanceST = new StockTypeModel();
        $instanceC = new CenterModel();
        $data['types'] = $instanceST->retrieveAllTypes();
        $data['center'] =  $instanceC->getAllCentersId();
        return view('Project/stock/createStock', $data);
    }

    public function addStock_post() {
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
            return redirect()->to(base_url('/viewStock'));
        } else {
            var_dump("hola");
            die;
            session()->setFlashdata('error', 'dades insuficients');
            return redirect()->back()->withInput();
        }
    }

    public function updateStock() {

    }

    public function updateStock_post() {

    }    

    public function deleteStock($stock) {
        $instanceS = new StockModel();
        $item = $instanceS->retrieveSpecificItem($stock);
        if ($item['intervention_id'] != null) {
            session()->setFlashdata('error', 'no es pot eliminar un ticket assignat');
            redirect()->back();
        }
        $instanceS->delete($stock);
        return redirect()->back();
    }
    
}
