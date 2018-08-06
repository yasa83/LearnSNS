<?php
$dsn = 'mysql:dbname=LearnSNS;host=localhost';
$user = 'root';
$password = '';
$dbh = new PDO($dsn,$user,$password);

$dbh->setAtribute(ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
$dbh->query('SET NAMES utf8');

?>