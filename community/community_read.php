<?php
include "../db.php"; /* db load */
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Every Busking - Community</title>

    <!-- Bootstrap core CSS -->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="../css/modern-business.css" rel="stylesheet">
    <link href="../side_bar.css" rel="stylesheet">
    <link href="../css/public.css" rel="stylesheet">
    <link href="community_read.css" rel="stylesheet">

    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->
    <link href="https://fonts.googleapis.com/css?family=Rokkitt" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="community_read.css" rel="stylesheet">

    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
          integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous">

    <style>
        .menu_community{
            color: #FBAA48 !important;
        }

    </style>

</head>
<body>

<div class="container">

    <h1 class="mt-4 mb-3 my_font_index">Community</h1>

    <h6 class="my_font_main">※ 깨끗한 인터넷 문화를 만들어갑시다. :)</h6>



    <!--header 로드-->
    <div class="main_nav"></div>
    <script>$(".main_nav").load("/public/main_nav.php");</script>

    <?php
    $bno = $_GET['idx']; /* bno함수에 idx값을 받아와 넣음*/
    $hit = mysqli_fetch_array(mq("select * from community_tb where idx ='" . $bno . "'"));
    $hit = $hit['hit'] + 1;
    $fet = mq("update community_tb set hit = '" . $hit . "' where idx = '" . $bno . "'");
    $sql = mq("select * from community_tb where idx='" . $bno . "'"); /* 받아온 idx값을 선택 */
    $board = $sql->fetch_array();
    ?>

    <section class="hero">
        <div class="container">
            <div class="row">

                <div class="col-lg-8 offset-lg-2">

                    <div class="cardbox shadow-lg bg-white">

                        <div class="cardbox-heading">
                            <!-- START dropdown-->
                            <div class="dropdown float-right">
                                <button class="btn btn-flat btn-flat-icon" type="button" data-toggle="dropdown"
                                        aria-expanded="false">
                                    <em class="fa fa-ellipsis-h"></em>
                                </button>
                                <div class="dropdown-menu dropdown-scale dropdown-menu-right" role="menu"
                                     style="position: absolute; transform: translate3d(-136px, 28px, 0px); top: 0px; left: 0px; will-change: transform;">
                                <?php if($_SESSION != null){
                                    echo '<a class="dropdown-item" href="community.php">목록으로</a>
                                    <a class="dropdown-item" href="community_write.php?idx='. $board['idx'].'">수정</a>
                                    <a class="dropdown-item" href="community_delete_p.php?idx='. $board['idx'].'">삭제</a>
                                ';
                                }else{
                                    echo '<a class="dropdown-item" href="/Sign/sign_in.html">로그인하기</a>';
                                } ?>
                                </div>
                            </div><!--/ dropdown -->
                            <div class="media m-0">
                                <!--<div class="d-flex mr-3">-->
                                <!--<a href=""><img class="img-fluid rounded-circle" src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/users/4.jpg" alt="User"></a>-->
                                <!--</div>-->
                                <div class="media-body">
                                    <p class="m-0"><?php echo $board['title']; ?></p>
                                    <small><span class="float-right" style="position: relative;left: 50px; top: 20px"><i
                                                    class="icon ion-md-time"></i> <?php echo $board['date']; ?></span>
                                    </small>
                                    <small><span class="float-right" style="position: relative;left: 50px; top: 20px"><i
                                                    class="icon ion-md-pin"></i> <?php echo $board['name']; ?></span>
                                    </small>
                                </div>
                            </div><!--/ media -->
                        </div><!--/ cardbox-heading -->

                        <div class="cardbox-item" style=" padding: 5px 5px 5px 5px">
                            <!--<img class="img-fluid"-->
                            <!--src="http://www.themashabrand.com/templates/bootsnipp/post/assets/img/1.jpg"-->
                            <!--alt="Image">-->

                            <a class="thumbnail" href="#" data-image-id="" data-toggle="modal" data-title=""
                               data-image=<?php echo $board['picture']; ?>
                               data-target="#image-gallery">
                                <img class="img-thumbnail" style="width: 100%; height: 100%;"
                                     src=<?php echo $board['picture']; ?> alt="Another alt text">
                            </a>
                        </div><!--/ cardbox-item -->
                        <div class="cardbox-item" style="padding-bottom: 20px">
                            <p class="media-body my_font_main"
                               style="margin-top: 10px; margin-left: 10px; margin-right: 10px;"><?php echo nl2br("$board[content]"); ?></p>

                        </div>

<!--                        <ul class="cardbox-base">-->

                            <!--                            <ul class="float-right">-->
                            <!--아이콘 없어짐-->
                            <!--                                <li><a><i class="far fa-comment"></i></a></li>-->
                            <!--                                <li><a><em class="mr-5"> 12</em></a></li>-->
                            <!--<li><a><i class="fa fa-share-alt"></i></a></li>-->
                            <!--<li><a><em class="mr-3">03</em></a></li>-->
                            <!--                            </ul>-->
                            <!--                            <ul>-->
                            <!--                                <li><a><i class="fa fa-thumbs-up"></i></a></li>-->
                            <!--                                <li><a href="#"><img src="../img/main_cover_01.jpg" class="img-fluid rounded-circle" alt="User"></a></li>-->
                            <!--                                <li><a href="#"><img src="../img/main_cover_02.jpg" class="img-fluid rounded-circle" alt="User"></a></li>-->
                            <!--                                <li><a href="#"><img src="../img/main_cover_03.jpg" class="img-fluid rounded-circle" alt="User"></a></li>-->
                            <!--                                <li><a href="#"><img src="../img/login_background.jpg" class="img-fluid rounded-circle" alt="User"></a></li>-->
                            <!--                                <li><a><span>10 Likes</span></a></li>-->
                            <!--                            </ul>-->
<!--                        </ul>-->
                        <?php if($_SESSION != null){
                            echo ' <div class="cardbox-comments">
			  <span class="comment-avatar float-left">
                  <a href=""><img class="rounded-circle"
                               src='.$_SESSION['profile'].'
                               alt="..." style="margin-top: 5px"></a></span>

                            <div class="input-group input-group-sm mb-3 my_font_main"
                                 style="width: 90%;height: 40px; margin-top: 5px; left: 15px">
                                <input type="text" class="form-control col-sm-10" aria-label="Sizing example input"
                                       aria-describedby="inputGroup-sizing-sm" placeholder="댓글을 작성해주세요 :)">
                                <input type="button" class="col-sm-2 btn"
                                       style="left: 10px; background-color: #FBAA48; color: white" id="support_1"
                                       value="댓글 달기">

                            </div>';
                        }else{
                        } ?>


                        </div><!--/ cardbox-like -->

                    </div>

                </div><!--/ col-lg-6 -->
            </div><!--/ row -->
        </div><!--/ container -->
    </section>
</div>

<div class="modal fade" id="image-gallery" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header my_font_main"><?php echo $board['title']; ?>
                <h4 class="modal-title" id="image-gallery-title"></h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">x</span>
                </button>
            </div>
            <div class="modal-body">
                <img id="image-gallery-image" class="img-responsive col-md-12" src="">
            </div>
            <div class="modal-footer">
            </div>
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
<script src="../side_bar.js"></script>
<script src="community.js"></script>
<script src="read_view.js"></script>

</body>