<?php include $_SERVER['DOCUMENT_ROOT'] . "/doc03/db.php";

$bno = $_GET['idx'];
$username = $_POST['name'];
$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT);
$title = $_POST['title'];
$content = $_POST['content'];
$sql = mq("update board set date = now(), name='" . $username . "',pw='" . $userpw . "',title='" . $title . "',content='" . $content . "' where idx='" . $bno . "'"); ?>

<script type="text/javascript">alert("수정되었습니다."); </script>
<meta http-equiv="refresh" content="0 url=/ex/doc03/page/board/read.php?idx=<?php echo $bno; ?>">