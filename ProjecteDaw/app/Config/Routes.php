<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//get per defecte tickets
//tickets
$routes->match(['GET','POST'], '/viewTickets', 'TicketsController::viewTickets');

// change Language
$routes->get('/changeLang/(:segment)', 'SessionController::changeLang');


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

//iintervencio en concret
$routes->get('/intervention/(:segment)/', 'InterventionsController::viewInterventions');

//assignacio tickets
$routes->get('/assignTicket/(:segment)', 'TicketsController::assignTicket/$1');
$routes->post('/assignTicket/(:segment)', 'TicketsController::assignTicketPost/$1');

//crud Intervencions
$routes->get('/addIntervention/(:segment)', 'InterventionsController::addIntervention/$1');
$routes->get('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention/$1');
$routes->get('/delIntervention/(:segment)', 'InterventionsController::delIntervention/$1');

$routes->post('/addIntervention', 'InterventionsController::addIntervention_post');
$routes->post('/updateIntervention/(:segment)', 'InterventionsController::updateIntervention/$1');

$route['default_controller'] = 'TicketsController::viewTickets';

//stock
$routes->MATCH(['GET','POST'], '/viewStock', 'StockController::viewStock');
//add
$routes->get('/addStock', 'StockController::addStock');
$routes->post('/addStock', 'StockController::addStock_post');
//update
$routes->get('/updateStock/(:segment)', 'StockController::updateStock/$1');
$routes->post('/updateStock/(:segment)', 'StockController::updateStock_post/$1');
//del
$routes->get('/delStock/(:segment)', 'StockController::deleteStock/$1');

$routes->get('/', 'SessionController::redirectToLogin');
//AJAX
$routes->get('/emailCenter/(:segment)', 'Gets::emailByCenter/$1');

//les sessions son 1 SSTT 2 centres / 3 professors / centre 4 Alumne 
//sessions: 
//mail: el mail de literal qualsevol usuari
//idSessionUser: el rol del usuari, previament descrit 
//idCenter: la id del centre del usuari excepte SSTT que no tenen centre assignat