<?php

$account = new Account($con);
if(isset($_POST["joinBtn"])){
   $pw = sanitizeInp($_POST["pw"]);
   $pw2 = sanitizeInp($_POST["pwConfirm"]);
   $email = sanitizeInp($_POST["email"]);
   $ph = sanitizeInp($_POST["ph"]);
   $hp = sanitizeInp($_POST["hp"]);
   $address = sanitizeInp($_POST["address"]);
   $id = sanitizeInp($_POST["id"]);
   $post_cd = sanitizeInp($_POST["post_cd"]);
   $addr_sub = sanitizeInp($_POST["addr_sub"]);
   $member = array($pw, $pw2, $email, $ph, $hp, $address, $id, $post_cd, $addr_sub);
   $wasSuccess = $account->register($member); 

   if($wasSuccess){
        header("Location:/index.php");
   }
}

// 실시간 ajax 유효성 처리
if(isset($_GET["vaild"])){

    $mod = $_GET["vaild"];
    if($mod === "id"){
        vaildId();
    }else if($mod === "email"){
        vaildEmail();
    }
    exit;
}

function vaildId(){
    global $account;
    $result = $account->isAccount($_POST["id"]);
    echo $result?'1':'0';
}

function vaildEmail(){
    global $account;
    $result = $account->isEmail($_POST["email"]);
    echo $result?'1':'0';
}

function sanitizeInp($inpVal){
    $inpVal = strip_tags($inpVal);
    $inpVal = str_replace(" ", "", $inpVal);
    return $inpVal;
}


function rememberInpVal($name){

    if(isset($_POST[$name])){
        return $_POST[$name];
    }
}


?>