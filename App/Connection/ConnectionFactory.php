<?php 

namespace App\Connection;

use PDO;

class ConnectionFactory  {

    public $user     = "root";
    public $password = "";
    public $database = "db_album";
    
    public function getConnection(){

        $pdo = new PDO(
            "mysql:host=localhost;dbname={$this->database}",
             $this->user,
             $this->password 
        );

        /**
         * Essa configuração faz com que os erros que eventualmente possar ocorrer
         * com uma consulta ou durante a conexão, lancem uma exceção;
         * Isso traz 2 principais benefícios: 
         * i) você fica sabendos dos erros
         * ii) você pode tratar os erros com try-catch
         */ 
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }
}
