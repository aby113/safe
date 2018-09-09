<?php
if (!isset($_SESSION)) {
    session_start();
}
$account = new Account($con);
if (isset($_POST["loginBtn"])) {
    $id = Utils::sanitizeInp($_POST["id"]);
    $pw = Utils::sanitizeInp($_POST["pw"]);
    $result = $account->login($id, $pw);
    if($result){
        Utils::redirect("/index.php");
    }
}

if(isset($_POST["logout"])){

    session_destroy();
    exit;
}









?>