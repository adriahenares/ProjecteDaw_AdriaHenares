<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//Sessions
$routes->get('/login', 'SessionController::google_login');
$routes->post('/login', 'SessionController::login_post_Normal');
$routes->get('/logout', 'SessionController::logout');

//Langs
$routes->get('/changeLang/(:segment)', 'SessionController::changeLang/$1');

//Tickets
$routes->match(['GET', 'POST'], '/viewTickets', 'TicketsController::viewTickets');
$routes->get('/addTickets', 'TicketsController::addTicket');
$routes->post('/addTickets', 'TicketsController::addTicketPost');
$routes->get('/delTicket/(:segment)', 'TicketsController::deleteTicket/$1');
$routes->get('/confirmDel/(:segment)', 'TicketsController::confirmDelete/$1');

//Interventions
$routes->match(['GET', 'POST'], '/Ticket/(:segment)', 'TicketsInterventionsController::viewIntermediary/$1');
$routes->get('/interventionsByTicketId/(:segment)', 'TicketsInterventionsController::loadTableData/$1');

//Stock
$routes->get('/viewStock', 'StockController::viewStock');
$routes->get('/stockByCenterId/(:segment)', 'StockController::loadTableData/$1');
$routes->post('/addStock', 'StockController::addStock_post');
$routes->get('/delStock/(:segment)', 'StockController::deleteStock/$1');

//Students
$routes->get('/students', 'StudentsController::validateStudents');
$routes->post('/students', 'StudentsController::validateStudents_post');
$routes->get('/studentsByCenterId/(:segment)', 'StudentsController::loadTableData/$1');




















//get per defecte tickets
//tickets

// change Language


// addTickets 



//eliminar Tickets

// confirm delete ticket



//Iniciar seesio SSTT
// $routes->get('/loginAuth', 'SessionController::loginNormal');

//iniciar sessio profe, alum



//validar el centre 
$routes->post('/validateCenter', 'SessionController::validateCenter');
//register de alumnes

//logOut

//pagina intermitja entre tickets i intervencio

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
//add
$routes->get('/addStock', 'StockController::addStock');
//update
$routes->get('/updateStock/(:segment)', 'StockController::updateStock/$1');
$routes->post('/updateStock/(:segment)', 'StockController::updateStock_post/$1');
//del

$routes->get('/', 'SessionController::redirectToLogin');
//AJAX
$routes->get('/emailCenter/(:segment)', 'Gets::emailByCenter/$1');

//les sessions son 1 SSTT 2 centres / 3 professors / centre 4 Alumne 
//sessions: 
//mail: el mail de literal qualsevol usuari
//idSessionUser: el rol del usuari, previament descrit 
//idCenter: la id del centre del usuari excepte SSTT que no tenen centre assignat