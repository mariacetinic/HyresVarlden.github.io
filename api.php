<?php

session_start();
header('Access-Control-Allow-Origin: *');

$host = 'localhost';
$db = 'hyresvarlden';
$user = 'root';
$password = '';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			  PDO::ATTR_EMULATE_PREPARES   => false  ];
$pdo = new PDO($dsn, $user, $password, $options);

$user = $_POST['user'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM `gastinlogg` WHERE epost = :user AND pwd = :pwd";
$statement = $pdo->prepare($sql);
$statement->execute(array(':user' => $user, ':pwd' => $pwd));

$row = $statement->fetch(PDO::FETCH_ASSOC);

$resultat = [];

if (!is_null($row['ID'])) {
	$_SESSION['ID'] = $row['ID'];
	$resultat = [
		"user" => true,
		"pwd" => true
	];
}

else {

	$resultat = [
		"user" => false,
		"pwd" => false
	];

}

echo json_encode($resultat);

?>
