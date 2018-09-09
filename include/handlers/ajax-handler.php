<?php
include "../config.php";
include "../classes/ProductDAO.php";
$pdoDAO = new ProductDAO($con);

if (isset($_GET["cno"])) {
    $result = $pdoDAO->getProductList($_GET["cno"], $_GET["perPageNum"], $_GET["order"], $_GET["sort"]);
    echo json_encode($result);
    exit;
}



?>