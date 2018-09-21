<?php

// ログインユーザー情報
function get_user($dbh,$user_id)
{
    $sql = 'SELECT * FROM `users` WHERE `id` =?';
    $data = array($user_id);
    $stmt = $dbh->prepare($sql);
    $stmt ->execute($data);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// つぶやきの保存
function create_feed($dbh, $feed,$user_id)
{
    $sql = 'INSERT INTO `feeds` SET `feed` =?, `user_id`=?, `created` =NOW()';
    $data = array($feed,$user_id);
    $stmt = $dbh->prepare($sql);
    $stmt ->execute($data);
}

// いいねの件数
function count_like($dbh, $feed_id)
{
    $like_sql = "SELECT COUNT(*) AS `like_cnt` FROM `likes` WHERE `feed_id` = ?";
    $like_data = [$feed_id];
    $like_stmt = $dbh->prepare($like_sql);
    $like_stmt->execute($like_data);

    $like = $like_stmt->fetch(PDO::FETCH_ASSOC);
    return $like["like_cnt"];
}

// いいね済みかどうかの確認
function is_liked($dbh,$user_id,$feed_id)
{
    $like_flg_sql = "SELECT * FROM `likes` WHERE `user_id` = ? AND `feed_id` = ?";
    $like_flg_data =[$user_id,$feed_id];
    $like_flg_stmt = $dbh->prepare($like_flg_sql);
    $like_flg_stmt->execute($like_flg_data);

    $is_liked = $like_flg_stmt->fetch(PDO::FETCH_ASSOC);

    return $is_liked ? true : false;
}

// ヒットしたレコードの数を取得するSQL
function get_last_page($dbh)
{
    $sql_count = "SELECT COUNT(*)AS `cnt` FROM `feeds`";
    $stmt_count = $dbh->prepare($sql_count);
    $stmt_count->execute();
    $record_cnt = $stmt_count->fetch(PDO::FETCH_ASSOC);

    //取得したページ数を1ページあたりに表示する件数で割って何ページが最後になるか取得
    return ceil($record_cnt['cnt']/CONTENT_PER_PAGE);
}


    // つぶやき数を取得する文
function count_feed($dbh, $feed_id)
{
    $feed_sql = "SELECT COUNT(*) AS `feed_cnt` FROM `feeds` WHERE
    `user_id` = ?";
    $feed_data = [$feed_id];
    $feed_stmt = $dbh->prepare($feed_sql); 
    $feed_stmt->execute($feed_data);
    $feed = $feed_stmt->fetch(PDO::FETCH_ASSOC);

    return $feed["feed_cnt"];
}