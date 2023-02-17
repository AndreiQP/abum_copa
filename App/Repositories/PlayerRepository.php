<?php 

namespace App\Repositories;

use App\Connection\ConnectionFactory;
use PDO;

class PlayerRepository {

    public $connection;

    public function __construct()
    {
        $factory = new ConnectionFactory();
        $this->connection = $factory->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM tb_jogadores";
        $table = $this->connection->query($sql); 
        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getById(int $id){
        $sql = "SELECT * FROM tb_jogadores WHERE id = :id";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":id", $id);

        $table->execute();

        $resultados = $table->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    
    public function getByTeam(string $team){
        $timeRepository = new TeamRepository();
        $time = $timeRepository->getByName($team);

        $sql = "SELECT * FROM tb_jogadores WHERE id_selecao = :team";
        $table = $this->connection->prepare($sql);
        $table->bindParam(":team", $time['id']);
        $table->execute();
        $resultadosDef = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultadosDef;
    }
    
    public function getByLikeName(string $nome){
        $sql = "SELECT * FROM tb_jogadores WHERE nome LIKE :nome";
        $table = $this->connection->prepare($sql);
        $nome = '%'.$nome.'%';
        $table->bindParam(":nome", $nome);
        $table->execute();
        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }
    
    public function getByPosition(string $posicao){
        $sql = "SELECT * FROM tb_jogadores WHERE posicao = :posicao";
        $table = $this->connection->prepare($sql);
        $table->bindParam(":posicao", $posicao);
        $table->execute();
        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }
    public function create(string $texto){

        $sql = "INSERT INTO tb_selecoes (abv, nome, grupo) VALUES('$texto')";

        $statement = $this->connection->exec($sql);

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function update($id, $data){
        $sql = "UPDATE tb_jogadores SET altura=:altura, nome=:nome, peso =:peso, data_nascimento = :nasc, posicao = :posicao, selecao = :selecao WHERE id = :id";
        $table = $this->connection->prepare($sql);
        $table->bindParam(":altura", $data["altura"]);
        $table->bindParam(":nome", $data["nome"]);
        $table->bindParam(":peso", $data["peso"]);
        $table->bindParam(":id", $data["id"]);
        $table->bindParam(":nasc", $data["nasc"]);
        $table->bindParam(":posicao", $data["posicao"]);
        $table->bindParam(":selecao", $data["selecao"]);

        $table->execute();

        $resultados = $table->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function delete(int $id){
        $sql = "DELETE FROM tb_jogadores WHERE id=:id";

        $table = $this->connection->prepare($sql);
        $table->bindParam(":id", $id);
        $table->execute();

        return "Deletado o time de id = ".$id;
    }

    public function mapPlayer($players){
        $result = array();
        foreach ($players as $player):

        endforeach;
    }
}