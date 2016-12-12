<pre>
<?php

$m = new MongoClient('mongodb://skipeUserAdditional:asdfOYUYKHK57fasdf@ds027771.mongolab.com:27771/skipe');
$db = $m->selectDB('skipe');
$collection = new MongoCollection($db, 'user');
$cursor = $collection->find();
$result = [];
foreach ($cursor as $doc) {
    $result[] = $doc;
}
var_export($result);
