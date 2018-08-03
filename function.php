<?PHP

    //  SQLから配列を受け取る
    function get_user($dbh,$user_id)
    {
        $sql = 'SELECT * FROM `users` WHERE `id`=?';
        $data = [$user_id];
        $stmt = $dbh->prepare($sql);
        $stmt->execute($data);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }