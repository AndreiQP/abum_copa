<?php
namespace App\Connection;

include __DIR__ . "/../../vendor/autoload.php";

use Exception;
use App\Connection\ConnectionFactory;


class ConnectionTest {

    public function connectionTest(){
        
        try{
            $connectionFactory = new ConnectionFactory();
            $connectionFactory->getConnection();

            print "### Tudo certo com sua conexão!###";

        } catch (Exception $exception){
            print "### erro: " . $exception->getMessage();
        }
    }
}

$test = new ConnectionTest();
$test->connectionTest();