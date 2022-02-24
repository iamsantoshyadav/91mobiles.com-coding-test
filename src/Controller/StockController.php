<?php

namespace Src\Controller;
use Src\Model\Stocks\Stock;

class StockController {
    private $db;
    private $requestMethod;
    private $stock;

    public function __construct($db, $requestMethod)
    {
        $this->db = $db;
        $this->requestMethod = $requestMethod;

        $this->stock = new Stock($db);
    }

    public function processRequest()
    {
        switch ($this->requestMethod) {
            case 'POST':
                $response = $this->maxProfitOfStock();
                break;
            default:
                $response = $this->notFoundResponse();
                break;
        }
        header($response['status_code_header']);
        if ($response['body']) {
            echo $response['body'];
        }
    }

    private function maxProfitOfStock() {
        try {
            $input = (array) json_decode(file_get_contents('php://input'), TRUE);
            $data = $this->stock->maxProfitOfStock($input);
            return $this->successfulResponse($data);
        }catch (\Exception $e){
            exit($e->getMessage());
        }

    }

    private function successfulResponse($data) {
        $response['status_code_header'] = 'HTTP/1.1 200 OK';
        $response['body'] = json_encode($data);
        return $response;
    }


    private function notFoundResponse()
    {
        $response['status_code_header'] = 'HTTP/1.1 404 Not Found';
        $response['body'] = null;
        return $response;
    }

}
