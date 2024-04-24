<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


$routes->get('/', 'SessionController::redirectToLogin');
//get per defecte tickets
$routes->match(['GET','POST'], '/ssttView', 'TicketsController::ssttView');
//tickets
$routes->match(['GET','POST'], '/viewTickets', 'TicketsController::viewTickets');




// addTickets 
$routes->get('/addTickets', 'TicketsController::addTicket');
$routes->post('/addTickets', 'TicketsController::addTicketPost');

//eliminar Tickets
$routes->get('/delTicket/(:segment)', 'TicketsController::deleteTicket/$1');

//Iniciar seesio SSTT
$routes->get('/loginAuth', 'SessionController::loginNormal');
$routes->post('/loginAuth', 'SessionController::login_post_Normal');

//iniciar sessio profe, alum
$routes->get('/login', 'SessionController::google_login');

//validar el centre
$routes->post('/validateCenter', 'SessionController::validateCenter');
//register de alumnes
$routes->get('/validateStudents', 'SessionController::validateStudents');
$routes->post('/validateStudents', 'SessionController::validateStudents_post');

//logOut
$routes->get('/logout', 'SessionController::logout');

//pagina intermitja entre tickets i intervencio
$routes->match(['GET','POST'], '/interventionsOfTicket/(:segment)', 'TicketsInterventionsController::viewIntermediary/$1');
///interventions/821198ce-5c27-43

//iintervencio en concret
$routes->get('/intervention/(:segment)/', 'InterventionsController::viewInterventions');

//assignacio tickets
$routes->match(['GET','POST'], '/assing', 'TicketsController::assingTicketsView');
$routes->get('/assingTicket/(:segment)', 'TicketsController::assingTicket/$1');
$routes->post('/assingTicket/(:segment)', 'TicketsController::assingTicketPost/$1');

//crud Intervencions
$routes->get('/addIntervention/(:segment)', 'InterventionsController::addIntervention/$1');
$routes->get('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention/$1');
$routes->get('/delIntervention/(:segment)', 'InterventionsController::delIntervention/$1');

$routes->post('/addIntervention', 'InterventionsController::addIntervention_post');
$routes->post('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention/$1');

$route['default_controller'] = 'TicketsController::ssttView';
