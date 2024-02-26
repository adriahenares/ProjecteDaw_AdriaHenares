<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//per defecte tickets
$routes->get('/', 'TicketsController::viewTickets');

//tickets
$routes->get('/viewTickets', 'TicketsController::viewTickets');

// addTickets
$routes->get('/addTickets', 'TicketsController::addTickets');
$routes->post('/addTickets', 'TicketsController::addTickets_post');

//registrar
$routes->get('/register', 'SessionController::register');
$routes->post('authentication/register', 'SessionController::register_post');

// iniciar sessio
$routes->get('/login', 'SessionController::login');
$routes->post('authetication/login', 'SessionController::login_post');

//pagina intermitja entre tickets i intervencio
$routes->get('/interventions/(:segment)', 'TicketsInterventionsController::viewIntermediary');


//intervencions  mirar despres el tema segment
//$routes->get('/interventions/(:segment)/', 'InterventionsController::viewInterventions');






