<?php

$pdDAO = new ProductDAO($con);
$result = $pdDAO->getProductList(1, 8, "pno", "DESC");



?>