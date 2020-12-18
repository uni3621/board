<?php
include $_SERVER['DOCUMENT_ROOT'] . "/doc03/db.php";

$lockpost = 0;
$bno = $_GET['idx'];
$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
if (!password_verify("", $userpw)) {
    $lockpost = 1; // 비밀번호 가 설정되어 있다면
}

if ($bno && $_POST['dat_user'] && $userpw && $_POST['content']) {
    $sql = mq("insert into reply(con_num, name,pw, content, lock_post) values('" . $bno . "', '" . $_POST['dat_user'] . "', '" . $userpw . "', '" . $_POST['content'] . "', '" . $lockpost . "')");
    echo "<script>alert('댓글이 작성되었습니다.'); 
        location.href='/ex/doc03/page/board/read.php?idx=$bno';</script>";
} else {
    echo "<script>alert('댓글 작성에 실패했습니다.'); 
        history.back();</script>";
}