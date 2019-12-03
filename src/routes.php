<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/' route");

        $conexao = $container->get('pdo');

        $resultSet = $conexao->query('SELECT carro.id, modelo, marca, ano, nome FROM carro INNER JOIN dono WHERE carro.id = carro_id ORDER BY carro.id')->fetchAll();

        $args['carros'] = $resultSet;

        // Render index view
        return $container->get('renderer')->render($response, 'index.phtml', $args);


    });

};
