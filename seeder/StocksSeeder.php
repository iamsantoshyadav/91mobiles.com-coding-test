<?php
require '../bootstrap.php';

$statement = <<<EOS
    CREATE TABLE IF NOT EXISTS stocks (
        id INT NOT NULL AUTO_INCREMENT,
        name VARCHAR(200) NOT NULL,
        date DATE NOT NULL,
        price INT NOT NULL,
        PRIMARY KEY (id)
    ) ENGINE=INNODB;

    INSERT INTO stocks
        (id, name, date, price)
    VALUES
        (1, 'LIC', '2022-02-11', 320),
        (2, 'FLIPKAR', '2022-02-11', 1510),
        (3, 'YAHOO', '2022-02-11', 185),
        (4, 'FLIPKAR', '2022-02-12', 1518),
        (5, 'YAHOO', '2022-02-12', 184),
        (6, 'LIC', '2022-02-13', 324),
        (7, 'FLIPKAR', '2022-02-14', 1520),
        (8, 'LIC', '2022-02-15', 319),
        (9, 'FLIPKAR', '2022-02-15', 1523),
        (10, 'YAHOO', '2022-02-15', 189),
        (11, 'FLIPKAR', '2022-02-16', 1530),
        (12, 'LIC', '2022-02-18', 319),
        (13, 'YAHOO', '2022-02-18', 187),
        (14, 'LIC', '2022-02-19', 323),
        (15, 'LIC', '2022-02-21', 313),
        (16, 'FLIPKAR', '2022-02-21', 1483),
        (17, 'YAHOO', '2022-02-21', 178),
        (18, 'FLIPKAR', '2022-02-22', 1485),
        (19, 'YAHOO', '2022-02-22', 180),
        (20, 'LIC', '2022-02-23', 320);
EOS;

try {
    $createTable = $dbConnection->exec($statement);
    echo "Success!\n";
} catch (\PDOException $e) {
    exit($e->getMessage());
}
