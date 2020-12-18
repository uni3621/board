<?php include $_SERVER['DOCUMENT_ROOT'] . "/doc03/db.php"; ?>
    <link rel="stylesheet" type="text/css" href="/ex/doc03/css/style.css"/>
<?php

$idx = $_GET['idx'];
$sql = mq("select * from board where idx='" . $idx . "'");
$board = $sql->fetch_array();

?>
    <div style="margin: 100px 100px 100px 100px">
        <form action="" method="post">
            <p>비밀번호<input type="password" name="pw_ck"/></p>
            <input type="submit" value="확인"/>
        </form>
    </div>
<?php
$bpw = $board['pw'];

if (isset($_POST['pw_ck'])) // 만약 pw_ck라는 POST값이 있다면
{
    $pwk = $_POST['pw_ck']; // $pwk변수에 POST값으로 받은 pw_ck를 넣고
    if (password_verify($pwk, $bpw)) // DB의 pw와 입력하여 받아온 bpw와 값이 같은지 비교를 하고
    {
        $pwk == $bpw;
        ?>
        <script type="text/javascript">location.replace("read.php?idx=<?php echo $board["idx"]; ?>");</script>
        <?php
    } else { ?>
        <script type="text/javascript">alert('비밀번호가 틀립니다');</script>
    <?php }
} ?>