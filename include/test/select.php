<?php
include "Config.php";
$con = new PDO(Config::$URL, Config::$USER, Config::$PW);
$order = "pno";
$sort = "DESC";
$sql = "SELECT p.*, f.f_url FROM product p, category c, file f
WHERE p.cno = :cno AND p.cno = c.cno AND p.pno = f.pno
GROUP BY pno
ORDER BY {$order} {$sort}
LIMIT :perPageNum";
$cno = 1;
$perPageNum = 8;

$stmt = $con->prepare($sql);
$stmt->bindParam(":cno", $cno, PDO::PARAM_INT);
$stmt->bindParam(":perPageNum", $perPageNum, PDO::PARAM_INT);
//$stmt->bindParam(":order", $order, PDO::PARAM_STR);
//$stmt->bindParam(":sort", $sort, PDO::PARAM_STR);
$stmt->execute();
$result = $stmt->fetchAll();

foreach($result as $vo){
    var_dump($vo);
}
?>