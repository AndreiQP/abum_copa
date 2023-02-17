<?php 

namespace App\Repositories;

use App\Connection\ConnectionFactory;
use PDO;

class TeamRepository {

    public $connection;

    public function __construct()
    {
        $factory = new ConnectionFactory();
        $this->connection = $factory->getConnection();
    }

    public function getAll(){
        $sql = "SELECT * FROM tb_selecoes";
        $table = $this->connection->query($sql); 
        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getById(int $id){
        $sql = "SELECT * FROM tb_selecoes WHERE id = :id";

        $table = $this->connection->prepare($sql); 
        $table->bindParam(":id", $id);

        $table->execute();

        $resultados = $table->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function getByGroup(string $group){
        $sql = 'SELECT * FROM tb_selecoes WHERE grupo="'.$group.'"';
        $table = $this->connection->query($sql);
        $resultados = $table->fetchAll(PDO::FETCH_ASSOC);
        return $resultados;
    }

    public function getByName(string $nome){
        $sql = 'SELECT * FROM tb_selecoes WHERE nome="'.$nome.'"';
        $table = $this->connection->query($sql);
        $resultado = $table->fetch(PDO::FETCH_ASSOC);
        return $resultado;
    }

    public function create(string $texto){

        $sql = "INSERT INTO tb_selecoes VALUES('$texto')";

        $this->connection->exec($sql);

        $id = $this->connection->lastInsertId();

        return $id;
    }

    public function update($id, $data){
        $sql = "UPDATE tb_selecoes SET abv=:abv, nome=:nome, grupo = :grupo WHERE id = :id";
        $table = $this->connection->prepare($sql);
        $table->bindParam(":grupo", $data["grupo"]);
        $table->bindParam(":abv", $data["abv"]);
        $table->bindParam(":nome", $data["nome"]);
        $table->bindParam(":id", $id);

        $table->execute();

        $resultados = $table->fetch(PDO::FETCH_ASSOC);

        return $resultados;
    }

    public function delete(int $id){
        $sql = "DELETE FROM tb_selecoes WHERE id=:id";

        $table = $this->connection->prepare($sql);
        $table->bindParam(":id", $id);
        $table->execute();

        return "Deletado o time de id = ".$id;
    }
}