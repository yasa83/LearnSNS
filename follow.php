<?php 
session_start();

require("dbconnect.php");

$user_id = $_GET["following_id"];

$follower_id = $_SESSION["id"];

$sql = "INSERT INTO `followers` (`user_id`, `follower_id`) VALUES (?, ?);";
$data = array($user_id, $follower_id); 
$stmt = $dbh->prepare($sql); 
$stmt->execute($data);

header("Location: profile.php?user_id=".$user_id); 
exit();