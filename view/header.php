<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
    <header>

        <!-- Navigation -->
        <nav class="head-wrap">
            <div class="top-link-wrap">
                <ul class="top-link">
                    <li><a href="">고객센터</a></li>
                    <li><a href="/view/cart.php">장바구니</a></li>
                    <li><a href="">마이페이지</a></li>
                    <li><a href="/view/join-agreement.php">회원가입</a></li>
                    <li>
<?php
if(empty($_SESSION["login"])){
    echo "<a href='/view/login.php'>로그인</a>";
}else{
    echo "<a class='logout' href='#'>로그아웃</a>";
}
?>
                    </li>
                </ul>
            </div>
            <div class="container text-center">
                <h1>
                   <a href="/">
                             <img src="../images/logo.png" alt="">
                    </a>
                </h1>

            </div>
            <div class="top-service">
                <div class="container">
                    <ul>
                        <li><a href="1">꽃바구니</a></li>
                        <li><a href="2">근조화환</a></li>
                        <li><a href="3">관엽/화분</a></li>
                        <li><a href="4">동양란</a></li>
                        <li><a href="5">축하화환</a></li>
                        <li><a href="6">서양란</a></li>
                        <li><a href="7">꽃다발/꽃상자</a></li>
                        <li><a href="8">공기정화식물</a></li>
                        <li><a href="9">분재</a></li>
                    </ul>
                </div>

            </div>
        </nav>
    </header>
    <!-- 헤더끝 -->
    <script>
    $(document).ready(function () {
        $(".logout").click(function (e) { 
            e.preventDefault();
            var result = confirm("로그아웃 하시겠습니까?");
            if(!result)return;
            $.ajax({
                type: "post",
                url: "/view/login.php",
                data: {logout:"true"},
                dataType: "text",
                success: function (response) {
                    location.reload();
                }
            });
        });

        $(".top-service a").click(function (e) { 
            e.preventDefault();
            var cno = $(this).attr("href");
            var perPageNum = 8;
            var order = "pno";
            var sort = "DESC";
            location.href = "/view/goods-list.php?cno="+cno+"&perPageNum="+perPageNum+"&order="+order+"&sort="+sort;

            
        });

    });
    
    
    
    </script>