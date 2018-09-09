<?php
include "../include/config.php";
include "../include/classes/Constants.php";
include "../include/classes/Account.php";
include "../include/handlers/join-handler.php";

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
    <link rel="stylesheet" href="../css/join.css">
    <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/handlebars/handlebars.js"></script>
    <script src="http://dmaps.daum.net/map_js_init/postcode.v2.js"></script>
</head>

<body>

    <?php
    include "header.php";
    ?>

    <!-- 컨텐츠시작 -->
    <section class="container">
        <header>
            <span>홈&gt;</span>
            <span>회원가입&gt;</span>
            <span>약관동의</span>
        </header>
        <article>
            <header>
                <h2>회원가입</h2>
                <div class="top">
                    <span><strong>01</strong>약관동의</span>
                    <span class="this"><strong>02</strong>정보입력</span>
                    <span><strong>03</strong>가입완료</span>
                </div>
            </header>
            <hr>
            <div class="body">
                <div class="title">
                    <h3>기본정보</h3>
                    <p><img src="../images/squre-red.png" alt=""> 표시는 반드시 입력하셔야 하는 항목입니다.</p>

                </div>
                <form action="<?=$_SERVER['PHP_SELF']?>" method="post">
                    <input type="hidden" name="email" id="email" value="">
                    <table>
                        <tr>
                            <th><img src="../images/squre-red.png" alt=""> 아이디</th>
                            <td class="required">
                                <input type="text" name="id" id="" placeholder="※ 영문자, 숫자, _ 만 입력 가능. 최소 3자이상 입력하세요."
                                   value="<?=rememberInpVal('id')?>" required>
                                <?=$account->getError(Constants::$idCharacters); ?>
                                <?=$account->getError(Constants::$idTaken); ?>
                            </td>
                        </tr>
                        <tr>
                            <th><img src="../images/squre-red.png" alt="">비밀번호</th>
                            <td class="required">
                                <input type="text" name="pw" id="" value="<?=rememberInpVal('pw')?>" required placeholder="5이상 30자 이하로 입력해주세요.">
                                <?=$account->getError(Constants::$passwordCharacters)?>
                            </td>
                        </tr>
                        <tr>
                            <th><img src="../images/squre-red.png" alt="">비밀번호확인</th>
                            <td class="required">
                                <input type="text" name="pwConfirm" id="" value="<?=rememberInpVal('pwConfirm')?>" required>
                                <?=$account->getError(Constants::$passwordsDoNoMatch)?>
                            </td>
                        </tr>
                        <tr>
                            <th>이메일</th>
                            <td>
                                <input type="text" name="email1" id="email1" value="<?=rememberInpVal('email1')?>">
                                <select name="email2" id="email2" value="<?=rememberInpVal('email2')?>">
                                    <option value="naver.com">naver.com</option>
                                    <option value="daum.net">daum.net</option>
                                    <option value="nate.com">nate.com</option>
                                    <option value="hanmail.net">hanmail.net</option>
                                    <option value="gmail.com">gmail.com</option>
                                </select>
                                <p>
                                    <input type="checkbox" name="sms" id="email">
                                    <label for="email">
                                        정보/이벤트 메일 수신에 동의합니다.
                                    </label>
                                </p>
                                <?=$account->getError(Constants::$emailInvalid)?>
                                <?=$account->getError(Constants::$emailsDoNotMatch)?>
                                <?=$account->getError(Constants::$emailTaken)?>
                            </td>
                        </tr>
                        <tr>
                            <th>휴대폰번호</th>
                            <td><input type="text" name="ph" id="ph" placeholder="- 없이 입력하세요." value="<?=rememberInpVal('ph')?>">
                                <p>
                                    <input type="checkbox" name="sms" id="sms">
                                    <label for="sms">
                                        정보/이벤트 SMS 수신에 동의합니다.
                                    </label>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th>전화번호</th>
                            <td><input type="text" name="hp" id="hp" placeholder="- 없이 입력하세요." value="<?=rememberInpVal('hp')?>"></td>
                        </tr>
                        <tr>
                            <th>주소</th>
                            <td class="address">
                                <input type="text" name="post_cd" id="postcode" readonly="readonly">
                                <button class="btn btn-outline-success searchBtn" type="button">우편번호 검색</button>
                                <p>
                                    <input type="text" name="address" id="address" readonly="readonly">
                                </p>
                                <p>
                                    <input type="text" name="addr_sub" id="addr_sub">
                                </p>
                            </td>
                        </tr>

                    </table>
                    <div class="btn-group">
                        <button class="btn btn-outline-danger" type="reset">취소</button>
                        <button class="btn btn-danger" name="joinBtn" type="submit">회원가입</button>
                    </div>


                </form>

            </div>


        </article>
        <script>
            $(document).ready(function () {
                // 경고메세지 span태그 생성
                var reqPath = '<?= $_SERVER['PHP_SELF'] ?>';
                console.log(reqPath);
                spanInit();
                var isVaild = 0;
                $(".searchBtn").click(function (e) {
                    e.preventDefault();
                    execDaumPostcode();
                });

                $("input[name=id]").change(function () {
                    $id = $("input[name=id]").val();

                    $.ajax({
                        type: "post",
                        url: reqPath + "?vaild=id",
                        data: {
                            "id": $id
                        },
                        dataType: "text",
                        success: function (result) {
                            console.log(result);
                            if (result == true) {
                                $(".id.danger").text("이미 존재하는 아이디입니다.");
                            }
                        }
                    });
                });

                $("input[name=pwConfirm]").change(function () {

                    var pw = $("input[name=pw]").val();
                    var pwConfirm = $(this).val();
                    if (pw !== pwConfirm) {
                        $(".pw.danger").text("비밀번호가 서로 다릅니다.");
                    } else {
                        $(".pw.danger").text("");
                    }

                });

                $("input[name=email1]").change(function () {
                    var regExp =
                        /^[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*@[0-9a-zA-Z]([-_.]?[0-9a-zA-Z])*.[a-zA-Z]{2,3}$/i;
                    var email1 = $("input[name=email1]").val();
                    var email2 = $("#email2").val();
                    var email = email1 + "@" + email2;
                    console.log(email);
                    if (email.match(regExp) == null) {
                        $(".email.danger").text("정확한 이메일 주소를 입력해주시기 바랍니다.");
                    } else {
                        $(".email.danger").text("");
                    }


                    $.ajax({
                        type: "post",
                        url: reqPath + "?vaild=email",
                        data: {
                            "email": email
                        },
                        dataType: "text",
                        success: function (result) {
                            console.log(result);
                            if (result == true) {
                                $(".email.danger").text("이미 존재하는 이메일입니다.");
                            }
                        }
                    });



                });


                $("#email2").change(function (e) {
                    $("#email1").trigger("change");
                });


                $("#hp").change(function (e) {
                    e.preventDefault();
                    var val = $(this).val();
                    var result = val.replace(/-/gi, '');
                    $("#hp").val(result);
                    vaildNum($(".hp.danger"), result);
                });

                $("#ph").change(function (e) {
                    e.preventDefault();
                    var val = $("#ph").val();
                    var result = val.replace(/-/gi, '');
                    $("#ph").val(result);
                    vaildNum($(".ph.danger"), result);
                });

                $("#postcode").click(function () {
                    $(".searchBtn").trigger("click");
                });

                $("#address").click(function (e) {
                    e.preventDefault();
                    $(".searchBtn").trigger("click");
                });


                $("form").submit(function (e) {
                    var email1 = $("#email1").val();
                    var email2 = $("#email2").val();
                    var email = email1 + "@" + email2;
                    $("#email").val(email);

                });

                // 경고메세지 span태그 생성
                function spanInit() {

                    $("input[name=id]").after("<span class='id danger'></span>");
                    $("input[name=pwConfirm]").after("<span class='pw danger'></span>");
                    $("input[name=email1]").parent().append("<span class='email danger'></span>");
                    $("#ph").after("<span class='ph danger'></span>");
                    $("#hp").after("<span class='hp danger'></span>");
                }

                function vaildNum($target, result) {
                    var regex = /[^0-9]/g;
                    if (regex.test(result)) {
                        $target.text("숫자만 입력하세요.");
                    } else {
                        $target.text("");
                    }
                }








            });











            function execDaumPostcode() {
                new daum.Postcode({
                    oncomplete: function (data) {
                        // 팝업에서 검색결과 항목을 클릭했을때 실행할 코드를 작성하는 부분.

                        // 도로명 주소의 노출 규칙에 따라 주소를 조합한다.
                        // 내려오는 변수가 값이 없는 경우엔 공백('')값을 가지므로, 이를 참고하여 분기 한다.
                        var fullRoadAddr = data.roadAddress; // 도로명 주소 변수
                        var extraRoadAddr = ''; // 도로명 조합형 주소 변수

                        // 법정동명이 있을 경우 추가한다. (법정리는 제외)
                        // 법정동의 경우 마지막 문자가 "동/로/가"로 끝난다.
                        if (data.bname !== '' && /[동|로|가]$/g.test(data.bname)) {
                            extraRoadAddr += data.bname;
                        }
                        // 건물명이 있고, 공동주택일 경우 추가한다.
                        if (data.buildingName !== '' && data.apartment === 'Y') {
                            extraRoadAddr += (extraRoadAddr !== '' ? ', ' + data.buildingName : data.buildingName);
                        }
                        // 도로명, 지번 조합형 주소가 있을 경우, 괄호까지 추가한 최종 문자열을 만든다.
                        if (extraRoadAddr !== '') {
                            extraRoadAddr = ' (' + extraRoadAddr + ')';
                        }
                        // 도로명, 지번 주소의 유무에 따라 해당 조합형 주소를 추가한다.
                        if (fullRoadAddr !== '') {
                            fullRoadAddr += extraRoadAddr;
                        }

                        // 우편번호와 주소 정보를 해당 필드에 넣는다.
                        document.getElementById('postcode').value = data.zonecode; //5자리 새우편번호 사용
                        document.getElementById('address').value = fullRoadAddr;
                        document.getElementById('addr_sub').value = data.jibunAddress;

                        // 사용자가 '선택 안함'을 클릭한 경우, 예상 주소라는 표시를 해준다.
                        if (data.autoRoadAddress) {
                            //예상되는 도로명 주소에 조합형 주소를 추가한다.
                            var expRoadAddr = data.autoRoadAddress + extraRoadAddr;
                            document.getElementById('guide').innerHTML = '(예상 도로명 주소 : ' + expRoadAddr +
                                ')';

                        } else if (data.autoJibunAddress) {
                            var expJibunAddr = data.autoJibunAddress;
                            document.getElementById('guide').innerHTML = '(예상 지번 주소 : ' + expJibunAddr +
                                ')';

                        } else {
                            document.getElementById('guide').innerHTML = '';
                        }
                    }
                }).open();
            }
        </script>