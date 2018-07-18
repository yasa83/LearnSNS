<?php
    $errors = [];

    // emptyは空かどうかを調べる
    // isssetは変数が存在するかどうかチェック

    // 空のものがあるとポスト送信しない
    if(!empty($_POST)){
        $name = $_POST['input_name'];
        $email = $_POST['input_email'];
        $password = $_POST['input_password'];

        // ユーザー名の空チェック         // ifemptyを使うと０もblankとして処理されてしまう
if($name == ''){             $errors['name'] = 'blank';         }
if($email == ''){             $errors['email'] = 'blank';         }
$count = strlen($password);         if($password == ''){
$errors['password'] = 'blank';         } elseif ($count < 4 || 16 < $count) {
$errors['password'] = 'length';         }     $file_name =
$_FILES['input_img_name']['name'];         if(!empty($file_name)){
} else{                 $errors['img_name'] = 'blank';             }
}

?>
<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>Learn SNS</title>
        <link rel="stylesheet" type="text/css" href="../assets/css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="../assets/font-awesome/css/font-awesome.css">
    </head>
    <body style="margin-top: 60px">
        <div class="container">
            <div class="row">
                <!-- ここにコンテンツ -->

      <!-- ここから -->
      <div class="col-xs-8 col-xs-offset-2 thumbnail">
        <h2 class="text-center content_header">アカウント作成</h2>
        <form method="POST" action="signup.php" enctype="multipart/form-data">
          <div class="form-group">
            <label for="name">ユーザー名</label>
            <input type="text" name="input_name" class="form-control" id="name" placeholder="山田 太郎">
            <?php if (isset($errors['name']) && $errors['name'] == 'blank'): ?>
                <p class="text-danger">ユーザー名を入力してください。</p>
            <?php endif; ?>
          </div>

          <div class="form-group">
            <label for="email">メールアドレス</label>
            <input type="email" name="input_email" class="form-control" id="email" placeholder="example@gmail.com">
            <?php if (isset($errors['email']) && $errors['email'] == 'blank'): ?>
                <p class="text-danger">メールアドレスを入力してください。</p>
            <?php endif; ?>
          </div>
          <div class="form-group">
            <label for="password">パスワード</label>
            <input type="password" name="input_password" class="form-control" id="password" placeholder="4 ~ 16文字のパスワード">
            <?php if (isset($errors['password']) && $errors['password'] == 'blank'): ?>
                <p class="text-danger">パスワードを入力してください。</p>
            <?php endif; ?>
            <?php if (isset($errors['password']) && $errors['password'] == 'length') :?>
                <p class="text-danger">パスワードは４文字以上１６字以内で入力して下さい。</p>
            <?php endif; ?>

          </div>
          <div class="form-group">
            <label for="img_name">プロフィール画像</label>
            <input type="file" name="input_img_name" accept = "image/*" id="img_name">
            <?php if(isset($errors['img_name']) && $errors['img_name'] == 'blank')
            : ?>
            <p class="text-danger">画像を選択してください。</p>
            <?php endif; ?>
          </div>
          <input type="submit" class="btn btn-default" value="確認">
          <a href="../signin.php" style="float: right; padding-top: 6px;" class="text-success">サインイン</a>
        </form>
      </div>
      <!-- ここまで -->
            </div>
        </div>
        <script src="../assets/js/jquery-3.1.1.js"></script>
        <script src="../assets/js/jquery-migrate-1.4.1.js"></script>
        <script src="../assets/js/bootstrap.js"></script>
    </body>
</html>