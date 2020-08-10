<?php
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

$clientsHandlerGet = function (Request $request, Response $response, array $args){
    $mdb = new mongodb("dbUser", "dogiaAtlas", "cluster.oxs3r.gcp.mongodb.net", "kuppel", "clientes");

    if(isset($_GET["delete"])){//Eliminar Cliente
        if(!isset($_GET["STICKER"]) || $_GET["STICKER"] != "0055e02801c134be13c8a971456e0180bcd515ce504de1b8e0d964c1172d4f0929efa591092c4dd2e25d2b88a6ff5ebe279291fb9c906b2d7fb7a600d2abf80d"){//token to validate request
            die("Corrupci&oacute;n en la petici&oacute;n");
        }

        $doc = [
            "nombre" => $_GET["nombre"],
            "apellido" => $_GET["apellido"],
            "ccid" => (int)$_GET["ccid"],
        ];

        $mdb->deleteDocument($doc);
        print_r($doc);
    }else if(isset($_GET["update"])){
        if(!isset($_GET["STICKER"]) || $_GET["STICKER"] != "0055e02801c134be13c8a971456e0180bcd515ce504de1b8e0d964c1172d4f0929efa591092c4dd2e25d2b88a6ff5ebe279291fb9c906b2d7fb7a600d2abf80d"){//token to validate request
            die("Corrupci&oacute;n en la petici&oacute;n");
        }

        $filters = ['_id' => new MongoDB\BSON\ObjectID($_GET["update"])];
        $update = [
            "nombre" => $_GET["firstName"],
            "segundoNombre" => $_GET["secondName"],
            "apellido" => $_GET["lastName"],
            "segundoApellido" => $_GET["secondLastName"],
            "email" => $_GET["userEmail"],
            "ccid" => (int)$_GET["ccid"],
            "totalCompras" => (int)$_GET["totalBuys"],
        ];

        $mdb->updateDocument($filters, $update);

        $response = $response->withStatus(302);
        return $response->withHeader("Location", "../");
    }else{
        $response->getBody()->write($mdb->getDocuments([],[]));
    }
    return $response;
};

$clientsHandlerPost = function (Request $request, Response $response){
    $mdb = new mongodb("dbUser", "dogiaAtlas", "cluster.oxs3r.gcp.mongodb.net", "kuppel", "clientes");
    
    $doc = [
        "nombre" => $_POST["firstName"],
        "segundoNombre" => $_POST["secondName"],
        "apellido" => $_POST["lastName"],
        "segundoApellido" => $_POST["secondLastName"],
        "email" => $_POST["userEmail"],
        "ccid" => (int)$_POST["ccid"],
        "totalCompras" => (int)$_POST["totalBuys"],
    ];
    $mdb->insertDocument($doc);

    $response = $response->withStatus(302);
    return $response->withHeader("Location", "../");
};
?>