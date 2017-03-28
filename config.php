<?php

$host = 'mysql525.loopia.se';
$db = 'zocomutbildning_se_db_9';
$user = 'hyresv@z164682';
$password = '12hyr3sv4rld3n67';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			  PDO::ATTR_EMULATE_PREPARES   => false  ];
$pdo = new PDO($dsn, $user, $password, $options);

?>