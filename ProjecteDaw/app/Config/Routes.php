<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//get per defecte tickets
$routes->match(['GET','POST'],  '/', 'TicketsController::loadPage');

//tickets
$routes->match(['GET','POST'], '/viewTickets', 'TicketsController::viewTickets');

// addTickets es pot borrar
$routes->get('/addTickets', 'TicketsController::addTicket');
$routes->post('/addTickets', 'TicketsController::addTicketPost');

//registrar
$routes->get('/register', 'SessionController::register');
$routes->post('authentication/register', 'SessionController::register_post');

// iniciar sessio
$routes->get('/login', 'SessionController::login');
$routes->post('authetication/login', 'SessionController::login_post');

//pagina intermitja entre tickets i intervencio
$routes->match(['GET','POST'], '/interventionsOfTicket/(:segment)', 'TicketsInterventionsController::viewIntermediary/$1');
///interventions/821198ce-5c27-43

//iintervencio en concret
$routes->get('/intervention/(:segment)/', 'InterventionsController::viewInterventions');

//assignacio tickets
$routes->match(['GET','POST'], '/assing', 'TicketsController::assingTicketsView');
$routes->get('/assingTicket/(:segment)', 'TicketsController::assingTicket/$1');
$routes->post('/assingTicket/(:segment)', 'TicketsController::assingTicketPost/$1');









