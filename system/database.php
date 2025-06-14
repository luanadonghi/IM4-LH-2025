<?php

require_once 'config.php';

$dsn = 'mysql:dbname=' . $databaseName . ';host=' . $databaseHost;
$user = $databaseUser;
$password = $databasePassword;

$db = new PDO($dsn, $user, $password);
