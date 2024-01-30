<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'TicketsController::viewTickets');
$routes->get('/(:segment)/interventions', 'InterventionsController::viewInterventions');

