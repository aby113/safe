<?php
include "include/config.php";
include "include/classes/ProductDAO.php";
include "include/handlers/index-handler.php";

?>
<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" type="image⁄x-icon" href="images/title-logo.png">

    <title>꽃잎마을</title>
    <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/handlebars/handlebars.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/business-frontpage.css" rel="stylesheet">
<link rel="stylesheet" href="css/header.css">
<link rel="stylesheet" href="css/index.css">

<style>
.carousel-inner{
    position: relative;
    bottom: 20px;
}
</style>
</head>

  <body>
  <?php
  include "view/header.php";
  ?>
<section>

  <!-- 헤더끝 -->
  <!-- Header with Background Image -->
  <div id="demo" class="carousel slide" data-ride="carousel">
    
    <!-- Indicators -->
    <ul class="carousel-indicators">
      <li data-target="#demo" data-slide-to="0" class="active"></li>
      <li data-target="#demo" data-slide-to="1"></li>
      <li data-target="#demo" data-slide-to="2"></li>
      <li data-target="#demo" data-slide-to="3"></li>
    </ul>
    
    <!-- The slideshow -->
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/banner1.jpg" alt="Los Angeles">
      </div>
      <div class="carousel-item">
        <img src="images/banner2.jpg" alt="Chicago">
      </div>
      <div class="carousel-item">
        <img src="images/banner3.jpg" alt="New York">
      </div>
      <div class="carousel-item">
        <img src="images/banner4.jpg" alt="New York">
      </div>
    </div>
    
    <!-- Left and right controls -->
    <a class="carousel-control-prev" href="#demo" data-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </a>
    <a class="carousel-control-next" href="#demo" data-slide="next">
      <span class="carousel-control-next-icon"></span>
    </a>
    
  </div>
  <!-- 점보트론끝 -->
  <article>
    <div class="contents-header"></div>
    <div class="main-box">
      <ul>
        <li><a href="#"><img src="images/main-box-img1.jpg" alt=""></a></li>
        <li><a href="#"><img src="images/main-box-img1.jpg" alt=""></a></li>
        <li><a href="#"><img src="images/main-box-img1.jpg" alt=""></a></li>
        <li><a href="#"><img src="images/main-box-img1.jpg" alt=""></a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <!-- 메인박스끝 -->
    <!-- 제품리스트시작 -->
    <div class="category">
      <h2>Category BEST <span class="h2-category" role="tablist">카테고리별 베스트 상품</span></h2>
      <ul class="nav nav-tabs cate-list">
        <!-- <li class="nav-item"><a class="nav-link" href="#">꽃다발/꽃상자</a></li> -->
        <li class="nav-item" data-cno="5"><a class="nav-link"  href="#">축하화환</a></li>
        <li class="nav-item" data-cno="6"><a class="nav-link"  href="#">서양란</a></li>
        <li class="nav-item" data-cno="4"><a class="nav-link"  href="#">동양란</a></li>
        <li class="nav-item" data-cno="3"><a class="nav-link"  href="#">관엽/화분</a></li>
        <li class="nav-item" data-cno="2"><a class="nav-link"  href="#">근조화환</a></li>
        <li class="nav-item" data-cno="1"><a class="nav-link"  href="#">꽃바구니</a></li>
      </ul>
      <div class="clear"></div>
    </div>
    <!-- 메인박스 카테고리끝 -->
    <hr>
    <!-- 상품리스트 -->
    <div class="row text-center item-list">
    <!-- 아이템  시작 -->
<?php
foreach ($result as $vo) {
    ?>
        <div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="<?=$vo['pno']?>"><img class="card-img-top" src="images/product1.jpg" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="<?=$vo['pno']?>"><?=$vo['p_name']?></a>
              </h4>
              <!-- 상품 내용 -->
              <p class="card-text">
                <?= number_format($vo['p_price']) . "원"; ?>
              </p>
            </div>
          </div>
        </div>
        <!-- 아이템 종료 -->
        <?php
}
?>
      </div>
      <!-- 상품리스트 끝 -->

  </article>


</section>
  
  
    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2018</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script>
    $(document).ready(function () {
      
      $(".category").on("click", "li.nav-item",function (e) {
        e.preventDefault();
        $cno = $(this).data("cno");
        $perPageNum = 8;
        $order = "pno";
        $sort = "DESC";
        var data = {cno:$cno, perPageNum:$perPageNum, order:$order, sort:$sort};
        console.log(data);
        $.get("include/handlers/ajax-handler.php", data,
          function (data, textStatus, jqXHR) {
            var list = JSON.parse(data);
            printHtml($(".item-list"), $("#entry-template"), list);
          },
          "text"
        );

      });


    });
    
    // 카테고리 상품링크 클릭(상세보기이동)
    $(".item-list").on("click", "a", function (e) {
       e.preventDefault();
       var pno = $(this).attr("href");
       location.href = 'view/goods-view.php?pno='+pno;

    });


    function printHtml($target, $template, data){

      var template = Handlebars.compile($template.html());
      var html = template(data);
      $target.html(html);
    }
    
    
    
    </script>
<script id="entry-template" type="text/x-handlebars-template">
{{#each .}}
<div class="col-lg-3 col-md-4 col-sm-6 portfolio-item">
          <div class="card h-100">
            <a href="{{pno}}"><img class="card-img-top" src="{{f_url}}" alt=""></a>
            <div class="card-body">
              <h4 class="card-title">
                <a href="{{pno}}">{{p_name}}</a>
              </h4>
              <!-- 상품 내용 -->
              <p class="card-text">
                {{p_price}}원
              </p>
            </div>
          </div>
        </div>

{{/each}}
</script>


  </body>

</html>
