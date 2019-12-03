
<?php

use Slim\App;
use Slim\Http\Request;
use Slim\Http\Response;

return function (App $app) {
    $container = $app->getContainer();

    $app->get('/editar/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editar/' route");

        // Render index view
        return $container->get('renderer')->render($response, 'editar.phtml', $args);


    });

    $app->post('/editar/', function (Request $request, Response $response, array $args) use ($container) {

        // Sample log message
        $container->get('logger')->info("Slim-Skeleton '/editar/' route");

        $params = $request->getParsedBody();

        $conexao = $container->get('pdo');

        $conexao->query('UPDATE carro SET modelo = "'.$params['modelo'].'", marca = "'.$params['marca'].'", ano = '.$params['ano'].' WHERE id = '.$params['id'])->fetchAll();

        // Render index view
        return $container->get('renderer')->render($response, 'editar.phtml', $args);
    });


};
