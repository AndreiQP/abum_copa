<?php

use App\Controllers\PlayerController;
use Slim\App;
use App\Controllers\TeamController;
use Slim\Views\PhpRenderer;

$app = new App(['settings' => ['displayErrorDetails']]);
$container= $app->getContainer();
$container['view'] = new \Slim\Views\PhpRenderer(__DIR__ . '/../templates/');


/**
 * As linhas 12 a 20 são necessárias para se permitir o acesso dessas rotas por outros sistemas.
 * O padrão é ter acesso liberado somente para quem estiver no mesmo servidor. Essa restrição está relacionada ao CORS 
 */
$app->options('/{routes:.+}', function ($request, $response, $args) {
    return $response;
});

$app->add(function ($req, $res, $next) {
    $response = $next($req, $res);
    return $response->withHeader('Access-Control-Allow-Origin', '*')
    ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
});

/**
 * Adicione o mapeamento das rotas para os métodos do controlador de recados nas linhas abaixo
 */

$app->get('/selecoes', function($request, $response, $args){
    $selecaoController = new TeamController();
    $selecoes = $selecaoController->get($request, $response, $args);

    $response = $this->view->render($response, "selecoes.php", ["selecoes" => $selecoes]);
    return $response;
});

$app->get('/selecoes/{id}', function($request, $response, $args){
    $selecoesController = new TeamController();
    $selecoes = $selecoesController->getById($request, $response, $args);

    $data['base_path'] = "localhost:8080";
    $data['selecoes']  = $selecoes;


    $response = $this->view->render($response, "selecoes.php", ["selecoes" => $selecoes]);
    return $response;
});

 
 $app->get('/jogadores', function($request, $response, $args){
    $playerController = new PlayerController();
    $jogadores = $playerController->get($request, $response, $args);

    $response = $this->view->render($response, "jogadores.php", ["jogadores" => $jogadores]);
    return $response;
 });

$app->get('/jogadores/{id}', function($request, $response, $args){
    $playerController = new PlayerController();
    $jogadores = $playerController->getById($request, $response, $args);

    $response = $this->view->render($response, "jogadores.php", ["jogadores" => $jogadores]);
    return $response;
});

$app->run();
