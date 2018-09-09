<?php
if (isset($_GET["pno"])) {
    $dao = new ProductDAO($con);
    $vo = $dao->getProduct($_GET["pno"]);
}


?>