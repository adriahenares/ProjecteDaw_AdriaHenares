<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketsModel;

class TicketsController extends BaseController
{
    public function viewTickets()
    {
<<<<<<< Updated upstream
        $instance = new TicketsModel();
        $data = $instance->findAll();
        
=======
        // poner la data
        return ('layout/');
>>>>>>> Stashed changes
    }
}
