<?php
require 'DBHelper.php';

$host = "localhost";
$db = "contacts_db";
$pass = "1";
$user = "root";
$foo = new DBHelper($user, $pass, $host, $db);
$cont = $foo->find_contact();
var_dump($cont);





