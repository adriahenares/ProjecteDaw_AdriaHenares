<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//get per defecte tickets
$routes->match(['get','post'],  '/', 'TicketsController::loadPage');

//tickets
$routes->match(['get','post'], '/viewTickets', 'TicketsController::viewTickets');

// addTickets es pot borrar
$routes->get('/addTickets', 'TicketsController::addTickets');
$routes->post('/addTickets', 'TicketsController::addTickets_post');

//registrar
$routes->get('/register', 'SessionController::register');
$routes->post('authentication/register', 'SessionController::register_post');

// iniciar sessio
$routes->get('/login', 'SessionController::login');
$routes->post('authetication/login', 'SessionController::login_post');

//pagina intermitja entre tickets i intervencio
$routes->get('/interventionsOfTicket/(:segment)', 'TicketsInterventionsController::viewIntermediary/$1');
///interventions/821198ce-5c27-43

//iintervencio en concret
$routes->get('/intervention/(:segment)/', 'InterventionsController::viewInterventions');

//assignacio tickets
$routes->match(['get','post'], '/assing', 'TicketsController::assingTicketsView');
$routes->get('/assingTicket/(:segment)', 'TicketsController::assingTicket/$1');
$routes->post('/assingTicket/(:segment)', 'TicketsController::assingTicketPost/$1');









