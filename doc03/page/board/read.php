<?php
include $_SERVER['DOCUMENT_ROOT'] . "/doc03/db.php"; /* db load */
?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="/ex/doc03/css/style.css"/>
    <script type="text/javascript" src="/ex/doc03/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/ex/doc03/js/jquery-ui.js"></script>
    <script type="text/javascript" src="/ex/doc03/js/common.js"></script>
</head>
<body style="padding-top: 7em">
<?php
$bno = $_GET['idx']; /* bno에 idx값을 받아와 넣음*/
$sql = "select * from board where idx='" . $bno . "'";
$hit = mysqli_fetch_array(mq($sql));
$hit = $hit['hit'] + 1; /* 조회수 증가 */
$fet = mq("update board set hit = '" . $hit . "' where idx = '" . $bno . "'");
$sql = mq($sql);
$board = $sql->fetch_array();
$dt = date("Y-m-d", strtotime($board['date']));
?>
<!-- 글 불러오기 -->
<div id="board_read">
    <h2><?php echo $board['title']; ?></h2>
    <div id="user_info">
        <!--        이름 날짜 조회수 -->
        <?php echo $board['name']; ?> <?php echo $dt; ?> 조회:<?php echo $board['hit']; ?>
        <div id="bo_line"></div>
    </div>
    <!--    내용-->
    <div id="bo_content">
        <?php echo nl2br("$board[content]"); ?>
    </div>
    <!--     목록으로, 수정, 삭제 태그 -->
    <div id="bo_ser">
        <ul>
            <li><a href="/ex/doc03/index.php">[목록으로]</a></li>
            <li><a href="modify.php?idx=<?php echo $board['idx']; ?>">[수정]</a></li>
            <li><a href="delete.php?idx=<?php echo $board['idx']; ?>">[삭제]</a></li>
        </ul>
    </div>
</div>
<!--- 댓글목록 -->
<div class="reply_view">
    <h4>댓글목록</h4>
    <div id="bo_line"></div>
    <?php
    $sql3 = mq("select * from reply where con_num='" . $bno . "' order by idx desc");
    while ($reply = $sql3->fetch_array()) {
        ?>
        <div class="dap_lo">
            <div><?php echo $reply['name']; ?> <?php echo $reply['date']; ?></div>
            <div class="rep_me dap_to"></div>
            <div class="dap_to comt_edit">
                <?php // 잠김 글이라면
                if ($reply['lock_post'] == 1) { ?>
                    비밀이라 안보여줄껀뎅 id 확인하는 것도 없는데 어케 봐야하지..
                    <?php
                } else {
                    echo nl2br("$reply[content]");
                }
                ?>
            </div>
            <div class="rep_me rep_menu">
                <!--                post로 값 넘기기 위한 태그-->
                <?php // 잠긴 글이라면
                if ($reply['lock_post'] == 1) { ?>
                    <a class="dat_delete_pw_bt" href="#" >삭제</a>
                    <?php
                } else { ?>
                    <a class="dat_delete_bt" href="#">삭제</a>
                    <?php
                }
                ?>
            </div>
            <!--             댓글 삭제확인 -->
            <div class='dat_delete_pw'>
                <form action="reply_delete.php" method="post">
                    <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>"/>
                    <input type="hidden" name="b_no" value="<?php echo $bno; ?>"/>
                    비밀번호<input type="password" name="pw"/>
                    <p><input type="submit" value="확인"></p>
                </form>
            </div>
            <div class='rep_delete'>
                <form action="reply_delete.php" method="post">
                    <input type="hidden" name="rno" value="<?php echo $reply['idx']; ?>"/>
                    <input type="hidden" name="b_no" value="<?php echo $bno; ?>"/>
                    <p><input type="submit" value="확인"></p>
                </form>
            </div>
        </div>
    <?php } ?>

    <!--     댓글 입력 -->
    <div class="dap_ins">
        <h5>댓글작성</h5>
        <form action="reply_ok.php?idx=<?php echo $bno; ?>" method="post">
            <input type="text" name="dat_user" id="dat_user" class="dat_user" size="15" placeholder="아이디">
            <input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
            <div style="margin-top:10px; ">
                <textarea name="content" class="reply_content" id="re_content" style="width: 790px; height: 56px; "></textarea>
                <button id="rep_bt" class="re_bt">댓글</button>
            </div>
        </form>
    </div>
</div>
</div>
</body>
</html>