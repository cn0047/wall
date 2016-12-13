<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors','On');

require __DIR__ .'/wall/bootstrap.php';

$mysqlConf = $config['mysql'];
$dbh = new PDO(
    sprintf('mysql:host=%s;dbname=%s', $mysqlConf['host'], $mysqlConf['dbname']),
    $mysqlConf['user'],
    $mysqlConf['password']
);
$sth = $dbh->prepare('SELECT NOW()');
$sth->execute();
$result = $sth->fetchAll(PDO::FETCH_ASSOC);
var_export($result);
