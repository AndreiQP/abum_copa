<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Repositories\PlayerRepository;
use App\Routes\Routes;

class PlayerController extends AbstractController {

    public $repository;

    public function __construct()
    {
        $this->repository = new PlayerRepository();
    }

    public function get(Request $request, Response $response, array $args){
        $teams = $request->getQueryParams()['selecao'] ?? null;
        $positions = $request->getQueryParams()['posicao'] ?? null;
        $names = $request->getQueryParams()['nome'] ?? null;
        $all = array();
        if($teams==null && $names == null && $positions == null){
            $resultados = $this->getAll($request, $response, $args);
            return $resultados;
            die;
        }else if($teams!=null || $names != null || $positions != null){
            if($teams!=null){
                $teams = $this->getByTeam($request, $response, $args);
                $all = $this->populate($all, $this->populate($teams, $all));
            }if($names != null){
                $names = $this->getByLikeName($request, $response, $args);
                $all = $this->populate($all, $this->populate($names, $all));
            }if($positions != null){
                $positions = $this->getByPosition($request, $response, $args);
                $all = $this->populate($all, $this->populate($positions, $all));
            }

            return $this->emComum($all);
        }

    }

    public function getAll(Request $request, Response $response, array $args){
        return $this->repository->getAll();
    }

    public function getById(Request $request, Response $response, array $args){
        $id = $args['id'];
        return $this->repository->getById($id);
    }

    public function getByTeam(Request $request, Response $response, array $args){
        $selecao = $request->getQueryParams()['selecao'];
        return $this->repository->getByTeam($selecao);
    }
    public function getByLikeName(Request $request, Response $response, array $args){
        $nome = $request->getQueryParams()['nome'];
        return $this->repository->getByLikeName($nome);
    
    }
    public function getByPosition(Request $request, Response $response, array $args){
        $posicao = $request->getQueryParams()['posicao'];
        return $this->repository->getByPosition($posicao);
    
    }

    public function create(Request $request, Response $response, array $args){

        //Obter campo por campo
        //$data = $request->getParam('nome_do_campo');

        //Obter todos os campos do formulario
        //$data = $request->getParams();
        
        //obter todos os dados de envio
        $data = $request->getParsedBody();

        $data['id'] = $this->repository->create($data['texto']);

        return $response->withJson(["id" => $data]);

    }

    public function update(Request $request, Response $response, array $args){
        $data = $request->getParsedBody();
        $insertedId = $this->repository->update($data['id'], $data['texto']);
        $response->write($insertedId);
        return $response;
    }

    public function delete(Request $request, Response $response, array $args){
        $response->write($this->repository->delete($args['id']));
        return $response;
    }

}