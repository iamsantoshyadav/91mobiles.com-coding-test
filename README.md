# 91mobiles.com-coding-test
Followings are steps to make it working

1. Install dependecies

    `composer install`

2. Setup/seed database

    i. Link .env.local to .env file by using following command
    `ln -s .env.local .env`
    
    ii. Once Enviournment is ready now create database and update your configuration in .env.local file 
    
    iii. Seed your database by following command
    
    `cd seeder`
    
    `php seeder/StocksSeeder.php`
    
3. Serve this project locally by following command (From project root directory)
    `php -S 127.0.0.1:8000 -t public`
    
4. Now its time to test this assignment

    Make a POST request to http://127.0.0.1:8000/getMaxProfitOfStock with following inputs
    
    ```
      {
        "date_1": "2022-02-20",
        "date_2": "2022-02-22",
        "stock_name": "yahoo"
      }
    ```
    
    Your response should be like this
    
    
    ```
    {
      "stock_name": "yahoo",
      "buying_date": "2022-02-21",
      "nos_of_stocks": 200,
      "buying_price": 35600,
      "selling_date": "2022-02-22",
      "selling_price": 36000,
      "max_profit": 400
    }
    ```
    
    ![Screenshot 2022-02-25 at 1 39 18 PM](https://user-images.githubusercontent.com/34602540/155678818-baa73a0a-37c9-4c7e-b2f4-c53f30819420.png)
