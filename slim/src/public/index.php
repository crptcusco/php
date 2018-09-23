<?php
use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

require '../vendor/autoload.php';

//incluyendo clases propias
spl_autoload_register(function ($classname) {
    require ("../classes/" . $classname . ".php");
});

//Config Settings
$config['displayErrorDetails'] = true;
$config['addContentLengthHeader'] = false;

$config['db']['host']   = "localhost";
$config['db']['user']   = "root";
$config['db']['pass']   = "Ubuntu2111";
$config['db']['dbname'] = "db_slim";


$app = new \Slim\App(["settings" => $config]);

//Agregando un container para La Inyeccion de Depemdencias
$container = $app->getContainer();

//Agregando un container para las vistas a forma de templates
$container['view'] = new \Slim\Views\PhpRenderer("../templates/");
//agregando un componete para la coneccion a la bd
$container['db'] = function ($c) {
    $db = $c['settings']['db'];
    $pdo = new PDO("mysql:host=" . $db['host'] . ";dbname=" . $db['dbname'],
        $db['user'], $db['pass']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    return $pdo;
};

//agregando un Componente para Logueo al container
$container['logger'] = function($c) {
    $logger = new \Monolog\Logger('my_logger');
    $file_handler = new \Monolog\Handler\StreamHandler("../logs/app.log");
    $logger->pushHandler($file_handler);
    return $logger;
};

$app->get('/', function (Request $request, Response $response) {
//    $mapper = new TicketMapper($this->db);
//    $this->logger->addInfo("Something interesting happened");
    $response = $this->view->render($response,"principal.phtml",["variable"=>$variable]);
    return $response;                       
});


$app->get('/hello/{name}', function (Request $request, Response $response) {
//    $mapper = new TicketMapper($this->db);
//    $this->logger->addInfo("Something interesting happened");
    $name = $request->getAttribute('name');
    $response->getBody()->write(" Que tal : $name");

    return $response;                       
});

$app->get('/tickets', function (Request $request, Response $response) {
    $this->logger->addInfo("Ticket list");
    $mapper = new TicketMapper($this->db);
    $tickets = $mapper->getTickets();

    $response = $this->view->render($response, "tickets.phtml", ["tickets" => $tickets]);
    return $response;
});

$app->get('/ticket/{id}', function (Request $request, Response $response, $args) {
    $ticket_id = (int)$args['id'];
    $mapper = new TicketMapper($this->db);
    $ticket = $mapper->getTicketById($ticket_id);

    $response->getBody()->write(var_export($ticket, true));
    $response = $this->view->render($response, "tickets.phtml", ["tickets" => $tickets, "router" => $this->router]);
    return $response;
})->setName("ticket-detail");

$app->post('/ticket/new', function (Request $request, Response $response) {
    $data = $request->getParsedBody();
    $ticket_data = [];
    $ticket_data['title'] = filter_var($data['title'], FILTER_SANITIZE_STRING);
    $ticket_data['description'] = filter_var($data['description'], FILTER_SANITIZE_STRING);

});



$app->run();