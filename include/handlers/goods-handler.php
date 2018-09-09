<?php

$prodDAO = new ProductDAO($con);
$cri = new Criteria();
if(isset($_GET["cno"])){
    // 만약 sort가 null 이면 내림차순으로 초기화
    $list = $prodDAO->getProductList($_GET["cno"], $_GET["perPageNum"], $_GET["order"], $_GET["sort"]);
    $prodCnt = count($list);
}





function isSelected($order){

    if(isset($_GET["order"])){
        return $_GET["order"] === $order? "selected":"";
    }
}


?>