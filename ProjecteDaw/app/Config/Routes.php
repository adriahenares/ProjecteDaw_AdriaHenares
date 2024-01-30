<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//get per defecte tickets
$routes->get('/', 'TicketsController::viewTickets');
$routes->get('/(:segment)/interventions', 'InterventionsController::viewInterventions');

//get get addTickets
$routes->get('/addTickets', 'TicketsController::addTickets');
$routes->post('/addTickets', 'TicketsController::addTickets_post');




