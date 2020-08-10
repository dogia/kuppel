<?php
use Slim\Factory\AppFactory;

require __DIR__ . '/../vendor/autoload.php';

require __DIR__ . '/../src/config/db.php';

//Incluye todos los archivos de la carpeta modules que son los que contienen los handlers
foreach (glob(__DIR__ . '/../src/modules/*.php') as $file) {
    require $file;
}

$app = AppFactory::create();
$app->setBasePath('/api');

$app->get('/clientes', $clientsHandlerGet);
$app->post('/clientes', $clientsHandlerPost);

$app->run();