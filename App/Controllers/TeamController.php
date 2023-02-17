<?php

namespace App\Controllers;

use Slim\Http\Request;
use Slim\Http\Response;
use App\Repositories\TeamRepository;

class TeamController extends AbstractController{

    public $repository;

    public function __construct()
    {
        $this->repository = new TeamRepository();
    }

    public function get(Request $request, Response $response, array $args){
        $groups = $request->getQueryParams()['grupo'] ?? null;
        $names = $request->getQueryParams()['nome'] ?? null;
        $all = array();
        if($groups==null && $names == null){
            $resultados = $this->getAll($request, $response, $args);
            return $resultados;
            die;
        }else if ($groups!=null || $names!=null){
            if($groups!=null){
                $teams = $this->getByGroup($request, $response, $args);
                $all = $this->populate($all, $this->populate($teams, $all));
            }
            if($names!=null){
                $names = $this->getByTeamName($request, $response, $args);
                $all = $this->populate($all, $this->populate($names, $all));
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

    public function getByTeamName(Request $request, Response $response, array $args){
        $name = $request->getQueryParams()['nome'];
        return $this->repository->getByName($name);
    }

    public function getByGroup(Request $request, Response $response, array $args){
        $group = $request->getQueryParams()['grupo'];
        return $this->repository->getByGroup($group);
    }

    public function create(Request $request, Response $response, array $args){
        $data = $request->getParsedBody();
        $data['id'] = $this->repository->create($data['texto']);
        return $response->withJson(["id" => $data])->withStatus(200);
    }

    public function update(Request $request, Response $response, array $args){
        $data = $request->getParsedBody();
        $response->write($this->repository->update($data['id'], $data))->withStatus(200);
        return $response;
    }

    public function delete(Request $request, Response $response, array $args){
        $response->write($this->repository->delete($args['id']))->withStatus(200);
        return $response;
    }

}