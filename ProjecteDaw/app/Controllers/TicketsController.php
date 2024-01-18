<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\TicketsModel;

class TicketsController extends BaseController
{
    public function viewTickets()
    {
        $instance = new TicketsModel();
        $data['tickets'] = $instance->findAll();
        return view ('Project/Tickets/viewTickets', $data);
    }
}
