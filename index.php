<pre>
<?php

error_reporting(E_ALL); // error_reporting(E_ALL & ~E_NOTICE);
ini_set('display_errors', 1);
ini_set('display_startup_errors','On');

$m = new MongoClient('mongodb://skipeUserAdditional:asdfOYUYKHK57fasdf@ds027771.mongolab.com:27771/skipe');
$db = $m->selectDB('skipe');
$collection = new MongoCollection($db, 'user');
$cursor = $collection->find();
$result = [];
foreach ($cursor as $doc) {
    $result[] = $doc;
}
var_export($result);
