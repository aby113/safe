<?php
include "Config.php";

$con = new PDO(Config::$URL, Config::$USER, Config::$PW);

$sql = "INSERT INTO category(c_name) VALUES(?)";
$data = array("꽃바구니", "근조화환", "관엽/화분", "동양란", "축하화환", "서양란", "꽃다발/꽃상자", "공기정화식물", "분재");
$stmt = $con->prepare($sql);
for($i = 0; $i < count($data); $i++){
    $stmt->execute(array($data[$i]));
}


?>