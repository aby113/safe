<?php
if(!isset($_SESSION)){
    session_start();
}

$cart = new Cart($con);
    if (isset($_SESSION['login'])) {    
        $items = $cart->getCart($_SESSION['login']['mno']);
    }




?>