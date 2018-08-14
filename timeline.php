<?php
// timeline.phpの処理を記載
session_start();
require('dbconnect.php');
require('function.php');

// 直接このページに来たらsignup.phpに飛ぶようにする
// これを入れないと直接このページに来たらSESSONの値が無いのでUndifind indexになる
if(!isset($_SESSION['id'])){
    header('Location:signin.php');
    exit();
}

// ユーザー情報を受け取る関数
$signin_user = get_user($dbh, $_SESSION['id']);

// 初期化
$errors = array();


// 何ページ目を開いているか取得する
if(isset($_GET['page'])){
    $page = $_GET['page'];
}else{
    $page =1;
}

// 定数を定義（1ページあたりの件数は変更しないから）
const CONTENT_PER_PAGE = 5;


// ー1ページなどの不正な値を渡されたときの対策
$page = max($page, 1);

// ページカウント
$last_page = get_last_page($dbh);

// 最後のページより大きい値を渡された場合の対策
$page = min($page,$last_page);

$start = ($page -1)*CONTENT_PER_PAGE;


// ユーザーが投稿ボタンを押したら発動
if(!empty($_POST)){
$feed = $_POST['feed'];


// 投稿の空チェック
// ifemptyを使うと０もblankとして処理されてしまう
if ($feed != '') {
    // 投稿処理の関数
    create_feed($dbh, $feed, $signin_user['id']);

// これが無いと画面更新したときに何度もデータを送ってしまう
    unset($_SESSION['register']);
    header("Location:timeline.php");
    exit();

    } else {
     $errors['feed'] = 'blank';
    }
}

// 結合したデータを取り出す
// 表示件数を5件に絞る
// LIMITやOFFSETの後半角スペースを開ける
    $sql = 'SELECT `f`.*, `u`.`name`,`u`.`img_name` FROM `feeds` AS `f` LEFT JOIN `users` AS `u` ON `f`.`user_id` = `u`.`id` ORDER BY `created` DESC LIMIT '.CONTENT_PER_PAGE.' OFFSET '.$start;
    $data = array();
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);

    // 表示用の配列を初期化
    $feeds=array();

    while(true){
        $record = $stmt->fetch(PDO::FETCH_ASSOC);
        if($record == false){
            break;
        }
        $feeds[] =$record;
    }
    
    // 検索機能
    if(isset($_GET['search_word'])){
        $sql ='SELECT `f`.*, `u`.`name`,`u`.`img_name` FROM `feeds` AS `f` LEFT JOIN `users` AS `u` ON `f`.`user_id`=`u`.`id` WHERE f.feed LIKE "%"?"%" ORDER BY `created` DESC LIMIT '. CONTENT_PER_PAGE.' OFFSET '.$start;
        $data = [$_GET['search_word']];
    }else{
        // LEFT JOINで全件取得
        $sql = 'SELECT `f`.*, `u`.`name`, `u`.`img_name` FROM `feeds` AS `f` LEFT JOIN `users` AS `u` ON `f`.`user_id`=`u`.`id` ORDER BY `created` DESC LIMIT '.CONTENT_PER_PAGE.' OFFSET '.$start;
                $data=[];
    }

        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);


    // 表示用の配列を初期化
        $feeds=array();

        while(true){

            $record = $stmt->fetch(PDO::FETCH_ASSOC);
            if($record == false){
                break;
            }

            // いいね済みかどうかの確認
            $record["is_liked"] = is_liked($dbh,$signin_user['id'],$record["id"]);

            // 何件いいねされているか確認する関数
            $record ["like_cnt"] = count_like($dbh,$record["id"]);


            $feeds[] =$record;

            }

       

?>


<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="utf-8">
    <title>Learn SNS</title>
    <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="assets/font-awesome/css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">
</head>
<body style="margin-top: 60px;">

<?php include('navbar.php');?>

    <div class="container">
        <div class="row">
            <div class="col-xs-3">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="timeline.php?feed_select=news">新着順</a></li>
                    <li><a href="timeline.php?feed_select=likes">いいね！済み</a></li>
                    <!-- <li><a href="timeline.php?feed_select=follows">フォロー</a></li> -->
                </ul>
            </div>
            <div class="col-xs-9">
                <div class="feed_form thumbnail">
                    <form method="POST" action="">
                        <div class="form-group">
                            <textarea name="feed" class="form-control" rows="3" placeholder="Happy Hacking!" style="font-size: 24px;"></textarea><br>
                            <?php if (isset($errors['feed']) && $errors['feed'] == 'blank'): ?>
                            <p class="text-danger">コメントを入力してください。</p>
                            <?php endif; ?>
                        </div>
                        <input type="submit" value="投稿する" class="btn btn-primary">
                    </form>
                </div>
                <?php foreach($feeds as $feed):?>
                <div class="thumbnail">
                    <div class="row">
                        <div class="col-xs-1">
                            <img src="user_profile_img/<?php echo $feed['img_name']; ?>" width="40">
                        </div>
                        <div class="col-xs-11">
                            <?php echo $feed['name']?><br>
                            <a href="#" style="color: #7F7F7F;"><?php echo $feed['created']; ?></a>
                        </div>
                    </div>
                    <div class="row feed_content">
                        <div class="col-xs-12" >
                            <span style="font-size: 24px;">
                                <?php echo $feed['feed']; ?>
                            </span>
                        </div>
                    </div>
                    <div class="row feed_sub">
                        <div class="col-xs-12">

                            <!-- Ajaxで更新するように修正 -->
                            <span hidden class="feed-id"><?= $feed["id"] ?></span>
                                <?php if($feed['is_liked']): ?>
                                <button class="btn btn-default btn-xs js-unlike">
                                <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                <span>いいねを取り消す</span>
                                </button>
                                <?php else: ?>
                                <button class="btn btn-default btn-xs js-like">
                                    <i class="fa fa-thumbs-up" aria-hidden="true"></i>
                                    <span>いいね!</span>
                                </button>
                            <?php endif; ?>
                                <span>いいね数 : </span>
                                <span class="like_count"><?= $feed['like_cnt'] ?></span>
                            <!-- ここまで -->
                            <a href="#collapseComment<?=$feed["id"]?>" data-toggle="collapse" aria-expanded="false">
                            <span>コメントする</span>
                            </a>
                            <span class="comment_count">コメント数 : 9</span>
                            <?php if($feed["user_id"] == $_SESSION["id"]): ?>
                            <a href="edit.php?feed_id=<?php echo $feed["id"]?>" class="btn btn-success btn-xs">編集</a>
                            <a onclick="return confirm('ほんとに消すの？');" href="delete.php?feed_id=<?php echo $feed["id"] ?>" class="btn btn-danger btn-xs">削除</a>
                        <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
                <div aria-label="Page navigation">
                    <ul class="pager">
                        <?php if($page == 1): ?>
                        <li class="previous disabled"><a><span aria-hidden="true">&larr;</span>Newer</a></li>
                        <?php else: ?>
                            <li class="previous"><a href="timeline.php?page=<?=$page -1;?>"><span aria-hidden="true">&larr;</span>Newer</a></li>
                        <?php endif; ?>

                        <?php if($page == $last_page): ?>
                            <li class="next disabled"><a>Older<span aria-hidden="true">&rarr;</span></a></li>
                            <?php else: ?>
                                <li class="next"><a href="timeline.php?page=<?=$page+1; ?>">Older<span aria-hidden="true">&rarr;</span></a></li>
                            <?php endif; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/jquery-3.1.1.js"></script>
    <script src="assets/js/jquery-migrate-1.4.1.js"></script>
    <script src="assets/js/bootstrap.js"></script>
    <script src="assets/js/app.js"></script>

</body>
</html>