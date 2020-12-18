<?php include $_SERVER['DOCUMENT_ROOT'] . "/doc03/db.php"; ?>

<!doctype html>
<head>
    <meta charset="UTF-8">
    <title>게시판</title>
    <link rel="stylesheet" type="text/css" href="/ex/doc03/css/style.css"/>
</head>
<body style="padding-top: 7em">
<div id="board_area">
    <h1>게시판</h1>
    <table class="list-table">
        <thead>
        <tr>
            <th width="70">번호</th>
            <th width="500">제목</th>
            <th width="120">글쓴이</th>
            <th width="100">작성일</th>
            <th width="100">조회수</th>
        </tr>
        </thead>
        <!--        db에 있는 게시글 목록-->
        <?php
        $sql = mq("select * from board order by idx desc");
        for ($i = $sql->num_rows; $i > 0; $i--) {
            $board = $sql->fetch_array();
            $title = $board["title"];
            ?>
            <tbody>
            <tr>
                <td width="70"><?php echo $i; ?></td>
                <td width="500"><?php
                    if ($board['lock_post'] == 1) { ?>
                    <a href='/ex/doc03/page/board/password_ck.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title;
                        } else { ?>
                        <a href='/ex/doc03/page/board/read.php?idx=<?php echo $board["idx"]; ?>'><?php echo $title;
                            } ?></a>
                <td width="120"><?php echo $board['name'] ?></td>
                <td width="100"><?php echo date("Y-m-d", strtotime($board['date'])) ?></td>
                <td width="100"><?php echo $board['hit']; ?></td>
            </tr>
            </tbody>
        <?php } ?>
    </table>
    <div id="write_btn">
        <a href="/ex/doc03/page/board/writer.php">
            <button>글쓰기</button>
        </a>
    </div>
</div>
</body>
</html>