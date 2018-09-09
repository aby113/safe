<?php

define('url', "mysql:host=localhost;dbname=flowershop;charset=utf8mb4");
define('user', "bm");
define('pw', "bm");
try {
    $con = new PDO(url, user, pw);
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}catch(Exception $e){
    print $e->getMessage();
}

    $rows = $con->query("SELECT * FROM agreement");
    $result = $rows->fetchAll();
    $agr_use = $result['0']['agr_cont'];
    $privacy = $result['1']['agr_cont'];
?>