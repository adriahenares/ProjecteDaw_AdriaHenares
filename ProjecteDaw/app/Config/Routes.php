<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//get per defecte tickets
$routes->match(['GET','POST'],  '/', 'TicketsController::loadPage');

//tickets
$routes->match(['GET','POST'], '/viewTickets', 'TicketsController::viewTickets');

// addTickets 
$routes->get('/addTickets', 'TicketsController::addTicket');
$routes->post('/addTickets', 'TicketsController::addTicketPost');

//eliminar Tickets
$routes->get('/delTicket/(:segment)', 'TicketsController::deleteTicket/$1');

//registrar
$routes->get('/loginAuth', 'SessionController::loginNormal');
$routes->post('authentication/loginAuth', 'SessionController::register_post_Normal');

// iniciar sessio
$routes->get('/login', 'SessionController::google_login');
$routes->post('authetication/login', 'SessionController::login_post');

//pagina intermitja entre tickets i intervencio
$routes->get('/interventionsOfTicket/(:segment)', 'TicketsInterventionsController::viewIntermediary/$1');
///interventions/821198ce-5c27-43

//iintervencio en concret
$routes->get('/intervention/(:segment)/', 'InterventionsController::viewInterventions');

//assignacio tickets
$routes->match(['GET','POST'], '/assing', 'TicketsController::assingTicketsView');
$routes->get('/assingTicket/(:segment)', 'TicketsController::assingTicket/$1');
$routes->post('/assingTicket/(:segment)', 'TicketsController::assingTicketPost/$1');

//pagina intermitja entre tickets i intervencio
$routes->get('/interventionsOfTicket/(:segment)', 'TicketsInterventionsController::viewIntermediary/$1');

//crud Intervencions
$routes->get('/addIntervention/(:segment)', 'InterventionsController::addIntervention/$1');
$routes->get('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention/$1');
$routes->get('/delIntervention/(:segment)', 'InterventionsController::delIntervention/$1');

$routes->post('/addIntervention', 'InterventionsController::addIntervention_post');
$routes->post('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention/$1');











