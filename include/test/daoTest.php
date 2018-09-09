<?php
include "Config.php";
include "../classes/ProductDAO.php";
$con = new PDO(Config::$URL, Config::$USER, Config::$PW);
$dao = new ProductDAO($con);
$result=$dao->getProduct(1);
var_dump($result);
?>