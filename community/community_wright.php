<?php
require_once "../db.php";

session_start();

if ($_SESSION == null) {
    echo '<script>alert("로그인 후 이용바랍니다.");history.back()</script>';
} else {
}
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="community_wright.css"/>
</head>
<body>
<div id="board_write">
    <h1><a href="/">자유게시판</a></h1>
    <h4>글을 작성하는 공간입니다.</h4>
    <div id="write_area">
        <form action="community_wright_p.php" method="post">
            <div id="in_title">
                <textarea name="title" id="utitle" rows="1" cols="55" placeholder="제목" maxlength="20"
                          required></textarea>
            </div>
            <div id="in_content">
                <textarea name="content" id="ucontent" placeholder="내용" required></textarea>
            </div>
            <div class="bt_se">
                <button type="submit">글 작성</button>
            </div>
        </form>
    </div>
</div>
</body>