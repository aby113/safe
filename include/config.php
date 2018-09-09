<?php
define('url', "mysql:host=localhost;dbname=flowershop;charset=utf8");
define('user', "bm");
define('pw', "bm");
try {
    $con = new PDO(url, user, pw);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    print $e->getMessage();
}
?>