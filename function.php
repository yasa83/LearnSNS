<?PHP

    //  SQLからユーザー情報の配列を受け取る
    function get_user($dbh,$user_id)
    {
        $sql = 'SELECT * FROM `users` WHERE `id`=?';
        $data = [$user_id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 投稿処理を関数化
    function create_feed($dbh,$feed,$user_id)
    {
    $sql = 'INSERT INTO `feeds` SET `feed`=?, `user_id`=?, `created`=NOW()';
    $data = array($feed, $user_id);
    $stmt = $dbh->prepare($sql);
    $stmt->execute($data);
    }