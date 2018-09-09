<?php

define('url', "mysql:host=localhost;dbname=flowershop;charset=utf8");
define('user', "bm");
define('pw', "bm");

try {
    $con = new PDO(url, user, pw);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM member LIMIT 0, 10";
    $stmt=$con->prepare($sql);
    $stmt->execute();
    $result = $stmt->rowCount();
    print_r($stmt->fetch());
}catch(Exception $e){
    $e->getMessage();
}

?>