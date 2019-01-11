<?php
include "../db.php";
session_start();

?>

<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Concert</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/concert.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">

    <link href="../public/side_bar.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


    <style>
        .menu_concert {
            color: #FBAA48 !important;
        }

    </style>

    <script>
        function doOpenCheck(chk){
            var obj = document.getElementsByName("check_box");
            for(var i=0; i<obj.length; i++){
                if(obj[i] != chk){
                    obj[i].checked = false;
                }
            }
        }

        $(document).ready(function(){
            $("#test-1").change(function(){
                if($("#test-1").is(":checked")){
                    $("#re_support_hover1").css("background-color", "#FBAA48");
                    $("#re_support_hover2").css("background-color", "#FFFFFF");
                    $("#re_support_hover3").css("background-color", "#FFFFFF");
                }else{
                    $("#re_support_hover2").css("background-color", "#FFFFFF");
                    $("#re_support_hover3").css("background-color", "#FFFFFF");
                    $("#re_support_hover1").css("background-color", "#FFFFFF");
                }
            });

            $("#test-2").change(function(){
                if($("#test-2").is(":checked")){
                    $("#re_support_hover2").css("background-color", "#FBAA48");
                    $("#re_support_hover3").css("background-color", "#FFFFFF");
                    $("#re_support_hover1").css("background-color", "#FFFFFF");
                }else{
                    $("#re_support_hover2").css("background-color", "#FFFFFF");
                    $("#re_support_hover3").css("background-color", "#FFFFFF");
                    $("#re_support_hover1").css("background-color", "#FFFFFF");
                }
            });

            $("#test-3").change(function(){
                if($("#test-3").is(":checked")){
                    $("#re_support_hover3").css("background-color", "#FBAA48");
                    $("#re_support_hover1").css("background-color", "#FFFFFF");
                    $("#re_support_hover2").css("background-color", "#FFFFFF");
                }else{
                    $("#re_support_hover2").css("background-color", "#FFFFFF");
                    $("#re_support_hover3").css("background-color", "#FFFFFF");
                    $("#re_support_hover1").css("background-color", "#FFFFFF");
                }
            });
        });
    </script>

</head>

<body>

<!--header 로드-->
<div class="main_nav"></div>
<script>$(".main_nav").load("/public/main_nav.php");</script>

<!-- Page Content -->
<div class="container my_font_main" style="min-height: 800px; padding-bottom: 200px">

    <!-- Page Heading/Breadcrumbs -->
    <h1 class="mt-4 mb-3 my_font_index" style="padding-bottom: 100px">Payment</h1>

    <!-- Page Content -->

    <div class="row" id="check_group">

        <div class="input-group re_hover_class mb-3 col-8 offset-2 center" style="min-height: 150px; border-radius: 10px"
             id="re_support_hover1" >
            <input name="check_box" type="checkbox" id="test-1" aria-label="Checkbox for following text input" onclick="doOpenCheck(this)">
            <label disabled type="text" for="test-1" class="form-control center" aria-label="Text input with checkbox"
                   style="background-color: transparent; border-color: transparent; height: 100%">선택해라</label>
        </div>

        <div class="input-group re_hover_class mb-3 col-8 offset-2 center" style="min-height: 150px; border-radius: 10px"
             id="re_support_hover2">
            <input name="check_box" type="checkbox" id="test-2" aria-label="Checkbox for following text input" onclick="doOpenCheck(this)">
            <label disabled type="text" for="test-2" class="form-control center" aria-label="Text input with checkbox"
                   style="background-color: transparent; border-color: transparent; height: 100%">선택해라</label>
        </div>


        <div class="input-group re_hover_class mb-3 col-8 offset-2 center" style="min-height: 150px; border-radius: 10px"
             id="re_support_hover3" >
            <input name="check_box" type="checkbox" id="test-3" aria-label="Checkbox for following text input" onclick="doOpenCheck(this)">
            <label disabled type="text" for="test-3" class="form-control center" aria-label="Text input with checkbox"
                   style="background-color: transparent; border-color: transparent; height: 100%">선택해라</label>
        </div>

    </div>

</div>

<!--footer 로드-->
<div class="main_footer"></div>
<script>$(".main_footer").load("/public/main_footer.html");</script>

<!-- Bootstrap core JavaScript -->
<script src="../vendor/jquery/jquery.min.js"></script>
<script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<script defer src="https://use.fontawesome.com/releases/v5.0.13/js/all.js"></script>
<script src="../public/side_bar.js"></script>
<script src="/public/page.js"></script>

</body>

</html>