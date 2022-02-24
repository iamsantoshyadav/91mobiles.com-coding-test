<?php
namespace Src\Model\Stocks;

class Stock {
    private $db = null;
    const NO_OF_BUYING_SELLING_STOCKS = 200;

    public function __construct($db){
        $this->db = $db;
    }

    public function getStocks($date1, $date2, $stockName){
        $statement = "SELECT *
                      FROM stocks
                      WHERE (date BETWEEN '$date1' AND '$date2')
                      AND (name LIKE '%$stockName%')
                      ORDER BY date;";
        try {
            $statement = $this->db->query($statement);
            $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
            return $result;
        } catch (\PDOException $e) {
            //REPORT THIS ERROR
            exit($e->getMessage());
        }
    }

    public function maxProfitOfStock($inputs) {
        (new StockValidator($inputs))->validateMaxProfitOfStockReq();
        $stocks = $this->getStocks($inputs['date_1'],$inputs['date_2'],$inputs['stock_name']);
        $minPrice = PHP_INT_MAX;
        $maxProfit = 0;

        $buyingStock = null;
        $sellingStock = null;
        $minPriceStockIndex = null;

        foreach ($stocks as $index => $stock) {
            if($stock['price'] < $minPrice){
                $minPrice = $stock['price'];
                $minPriceStockIndex = $index;

            }else if ($stock['price'] - $minPrice > $maxProfit) {
                $maxProfit = $stock['price'] - $minPrice;
                //Do not consider buying and selling in same
                if($stock['date'] > $stocks[$minPriceStockIndex]['date']){
                    $buyingStock = $stocks[$minPriceStockIndex];
                    $sellingStock = $stock;
                }

            }

        }

        $data = new \stdClass();
        if($buyingStock && $sellingStock){
            $data->stock_name   = $inputs['stock_name'];
            $data->buying_date  = $buyingStock['date'];
            $data->buying_price = $buyingStock['price'];
            $data->selling_date = $sellingStock['date'];
            $data->selling_price= $sellingStock['price'];
            $data->max_profit   = $maxProfit;
        }else {
            $data->message = "Did not found any stock which has maximum profit or minimum loss";
        }

        return $data;
    }



}
