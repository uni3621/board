<?php
include $_SERVER['DOCUMENT_ROOT'] . "/doc03/db.php";

$rno = $_POST['rno'];
$sql = mq("select * from reply where idx='" . $rno . "'");
$reply = $sql->fetch_array();

$bno = $_POST['b_no'];
$sql2 = mq("select * from board where idx='" . $bno . "'");
$board = $sql2->fetch_array();

$bpw = $reply['pw'];
if (isset($_POST['pw'])) {
    $pwk = $_POST['pw'];
    // 비밀번호가 맞지 않으면 exit
    if (!password_verify($pwk, $bpw)) { ?>
        <script type="text/javascript">alert('비밀번호가 틀립니다');
            history.back();
        </script>
        <?php
        exit();
    }
}
// 글을 삭제하는 공통 부분
$sql = mq("delete from reply where idx='" . $rno . "'"); ?>
<script type="text/javascript">alert('댓글이 삭제되었습니다.');
    location.replace("read.php?idx=<?php echo $board["idx"]; ?>");
</script>
