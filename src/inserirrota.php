
<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/inserir/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inserir/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'inserir.phtml', $args);


    });
    $app->post('/inserir/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/inserir/' route");

        $params = $request->getParsedBody();

        $conexao = $container->get('pdo');

        $conexao->query('INSERT INTO carro (modelo, marca, ano) VALUES("'.$params['modelo'].'", "'.$params['marca'].'", "'.$params['ano'].'")')->fetchAll();
        $id = $conexao->query('SELECT LAST_INSERT_ID()')->fetchAll();
        $conexao->query('INSERT INTO dono (nome, carro_id) VALUES("'.$params['nome'].'", '.$id[0]['LAST_INSERT_ID()'].')')->fetchAll();

        // Render index view
        return $container->get('renderer')->render($response, 'inserir.phtml', $args);
    });
};
