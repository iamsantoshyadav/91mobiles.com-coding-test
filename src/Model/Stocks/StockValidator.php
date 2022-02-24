<?php
namespace Src\Model\Stocks;

class StockValidator {

    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function validateMaxProfitOfStockReq(){
        /**
         * Validate Dates
         */
        if(empty($this->data['date_1'])){
            throw new \Exception("Date 1 field date is required");
        }
        if(empty($this->data['date_2'])){
            throw new \Exception("Date 2 field date is required");
        }
        if(!$this->validateDate($this->data['date_1'])){
            throw new \Exception("Not a valid date");
        }
        if($this->data['date_1'] >= $this->data['date_2']){
            throw new \Exception("Date 1 should be smaller then Date 2 field date is required");
        }

        /**
         * Validate stock name
         */
        if(empty($this->data['stock_name'])){
            throw new \Exception("Stock name field date is required");
        }
    }

    function validateDate($date, $format = 'Y-m-d'){
        $d = \DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) === $date;
    }
}
