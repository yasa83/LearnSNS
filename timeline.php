<?php
// timeline.phpの処理を記載


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
<body style="margin-top: 60px; background: #E4E6EB;">
    <div class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse1" aria-expanded="false">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Learn SNS</a>
            </div>
            <div class="collapse navbar-collapse" id="navbar-collapse1">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#">タイムライン</a></li>
                    <li><a href="#">ユーザー一覧</a></li>
                </ul>
                <form method="GET" action="" class="navbar-form navbar-left" role="search">
                    <div class="form-group">
                        <input type="text" name="search_word" class="form-control" placeholder="投稿を検索">
                    </div>
                    <button type="submit" class="btn btn-default">検索</button>
                </form>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="https://placehold.jp/18x18.png" width="18" class="img-circle">ユーザー名 <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">マイページ</a></li>
                            <li><a href="signout.php">サインアウト</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php
// timeline.phpの処理を記載
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
            <body style="margin-top: 60px; background: #E4E6EB;">
                <div class="navbar navbar-default navbar-fixed-top">
                    <div class="container">
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse1" aria-expanded="false">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a class="navbar-brand" href="#">Learn SNS</a>
                        </div>
                        <div class="collapse navbar-collapse" id="navbar-collapse1">
                            <ul class="nav navbar-nav">
                                <li class="active"><a href="#">タイムライン</a></li>
                                <li><a href="#">ユーザー一覧</a></li>
                            </ul>
                            <form method="GET" action="" class="navbar-form navbar-left" role="search">
                                <div class="form-group">
                                    <input type="text" name="search_word" class="form-control" placeholder="投稿を検索">
                                </div>
                                <button type="submit" class="btn btn-default">検索</button>
                            </form>
                            <ul class="nav navbar-nav navbar-right">
                                <li class="dropdown">
                                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="https://placehold.jp/18x18.png" width="18" class="img-circle">ユーザー名 <span class="caret"></span></a>
                                    <ul class="dropdown-menu">
                                        <li><a href="#">マイページ</a></li>
                                        <li><a href="signout.php">サインアウト</a></li>
                                    </ul>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div aria-label="Page navigation">
                <ul class="pager">
                    <li class="previous disabled"><a href="#"><span aria-hidden="true">&larr;</span> Newer</a></li>
                    <li class="next"><a href="#">Older <span aria-hidden="true">&rarr;</span></a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script src="assets/js/jquery-3.1.1.js"></script>
<script src="assets/js/jquery-migrate-1.4.1.js"></script>
<script src="assets/js/bootstrap.js"></script>
</body>
</html>


