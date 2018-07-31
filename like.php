<?php

require_once("dbconnect.php");

    $feed_id = $_POST["feed_id"];
    $user_id = $_POST["user_id"];

    $sql = "INSERT INTO `likes` (`user_id`, `feed_id`) VALUES (?, ?);";

    $data = [$user_id, $feed_id];
    $stmt = $dbh->prepare($sql);
    $res = $stmt->execute($data); //上手くいくとtrue,失敗するとfalseの答えを使う

     echo json_encode($res);
