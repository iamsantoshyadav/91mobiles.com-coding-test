<?php
namespace Src\Model\Stocks;

class Stock {
    private $db = null;

    public function __construct($db){
        $this->db = $db;
    }

    public function listAll(){
        $statement = "SELECT * FROM STOCKS;";

        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            //REPORT THIS ERROR
            exit($e->getMessage());
        }
    }



}
