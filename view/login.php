<?php
include "../include/config.php";
include "../include/classes/Utils.php";
include "../include/classes/Constants.php";
include "../include/classes/Account.php";
include "../include/handlers/login-handler.php";
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image⁄x-icon" href="../images/title-logo.png">

    <title>꽃잎마을</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/business-frontpage.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/login.css">
    <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/handlebars/handlebars.js"></script>
</head>

<body>
   <?php
   include "header.php";
   ?>
    <!-- 헤더끝 -->
    <section class="container">
        <header>
            <span>홈>로그인</span>

        </header>
        <h2>로그인</h2>       
        <article>
            <h3>회원 로그인</h3>
            <div class="contents">
                <form action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <div class="login">
                        <div class="input-info">
                            <div class="form-group">    
                                <input class="form-control" type="text" name="id" id="id"  placeholder="아이디">
                            </div>
                           <div class="form-group">
                                <input class="form-control"  type="text" name="pw" id="pw" placeholder="비밀번호">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger loginBtn" name="loginBtn">로그인</button>
                        <div class="clear"></div>
                    </div>
                    <div class="save">
                        <input type="checkbox" name="" id="">
                        <span>아이디저장</span>
                    </div>
                    <hr>
                    <div class="btn-group">
                        <button class="btn btn-outline-info" type="button">회원가입</button>
                        <button class="btn btn-outline-info" type="button">아이디 찾기</button>
                        <button class="btn btn-outline-info" type="button">비밀번호 찾기</button>
                    </div>
                </form>
            </div>

        </article>


    </section>
    <script>
    $(document).ready(function () {
        
        var isLoginFail = "<?= empty($account->errorArr); ?>";
        var msg = "<?= Constants::$loginFailed ?>";
        console.log(isLoginFail);
        // if(isLoginFail != null){
        //     alert(msg);
        // }


    });
    
    
    
    
    </script>

</body>

</html>