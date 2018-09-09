<?php
include "../include/config.php";
include "../include/classes/Criteria.php";
include "../include/classes/Constants.php";
include "../include/classes/ProductDAO.php";
include "../include/handlers/view-handler.php";
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
    <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/handlebars/handlebars.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/business-frontpage.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/header.css">
    <link rel="stylesheet" href="../css/goods-view.css">
    
</head>

<body>
   <?php
   include "header.php";
   ?>
    <!-- 헤더끝 -->
    <section class="container">
        <header>
            <span>홈><?=$vo['c_name']?></span>
        </header>
        <article>
            <div class="left-box">
                <img src="../images/product2.jpg" alt="">
            </div>
            <div class="right-box">
                <h4><?=$vo['p_name']?></h4>
                <ul class="item">
                    <li>
                        <strong>짧은설명</strong>
                        <div>꽃가게 최적 꽃잎마을</div>
                    </li>
                    <li> <strong>소비자가</strong>
                        <div><?=number_format($vo['p_price'])?>원</div>
                    </li>
                    <li> <strong>판매가</strong>
                        <div class="price"><?=number_format($vo['p_price'])?>원</div>
                    </li>
                    <li> <strong>배송비</strong>
                        <div>2,500</div>
                    </li>
                    <li> <strong></strong>
                        <div>주문시결제(선결제)</div>
                    </li>
                    <li> <strong>상품코드</strong>
                        <div>10003432423</div>
                    </li>
                </ul>
                <div class="amount-box">
                    <strong><?=$vo['p_name']?></strong>
                    <span class="count">
                        <input type="text" class="goods-cnt" title="수량" data-key="0" name="goodsCnt[]" value="1"
                            data-value="1" data-stock="0">
                        <span class="count-area">
                           <a class="upBtn" href="#">
                               <img src="../images/up-btn.png" alt="">
                           </a> 
                           <a class="downBtn" href="#">
                               <img src="../images/downBtn.png" alt="">
                            </a>
                        </span>
                    </span>
                </div>
                <div class="price-box">

                    <div class="space"></div>
                    <div class="price-right">
                        <div><span>총 상품금액</span><strong class="goods-amount"><?=number_format($vo['p_price'])?>원</strong></div>
                        <div><span id="amount">총 합계금액</span><strong class="total-amount"><?=number_format($vo['p_price'])?>원</strong></div>
                    </div>
                </div>
                <div class="btngroup">
                    <button class="btn btn-danger">구매하기</button>
                    <button class="btn btn-success">장바구니</button>
                    <button class="btn btn-primary">관심상품</button>
                </div>
            </div>

        </article>
        <div class="clear"></div>
        <div class="contents">
            <div class="btn-group">
                <button type="button" class="btn btn-outline-secondary">상품상세정보</button>
                <button type="button" class="btn btn-outline-secondary">배송안내</button>
                <button type="button" class="btn btn-outline-secondary">상품후기</button>
                <button type="button" class="btn btn-outline-secondary">상품문의</button>
            </div>
            <div class="guid-msg">
                <img src="http://kukujj.godohosting.com/2016common/sample_detail_01.gif" alt="">
            </div>
        </div>



    </section>
    <script>
    $(document).ready(function () {

        var price = "<?=$vo['p_price']?>";
        // 상품 수량 텍스트
        var $goodsInp = $(".goods-cnt");
        var $goodsAmt = $(".goods-amount");
        var $totalAmt = $(".total-amount");

// 입력값 검증후 -> 계산 -> 텍스트 변경처리
        $(".upBtn").click(function (e) { 
            e.preventDefault();
            var amount = $goodsInp.val();
            $goodsInp.val(++amount);
            $goodsInp.trigger("change");
           
        });

        $(".downBtn").click(function (e) { 
            e.preventDefault();
            var amount = $goodsInp.val();
            $goodsInp.val(--amount);
            $goodsInp.trigger("change");
        });

        $goodsInp.change(function (e) { 
            e.preventDefault();
            var amt = $goodsInp.val();
            var totalCnt = 0;
            amt = validAmt(amt);
            totalCnt = calc(amt);
            changeText(amt, totalCnt);
        });



        function validAmt(amount){
            if(amount < 1)amount = 1;
            if(amount > 999)amount = 999;
            return amount;
        }

        function calc(amount){
            if(amount < 1)amount = 1;
            if(amount > 999)amount = 999;
            return price * amount;
        }



        function changeText(amount, totalVal){
            $goodsInp.val(amount);
            $totalAmt.text(totalVal+"원");
            $goodsAmt.text(totalVal+"원");
        }
    });
    
    
    </script>