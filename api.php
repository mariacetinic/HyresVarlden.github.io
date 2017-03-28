<?php
//en kommentar för att se om git ger respond

session_start();
header('Access-Control-Allow-Origin: *');

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

$user = $_POST['user'];
$pwd = $_POST['pwd'];

$sql = "SELECT * FROM `gastinlogg` WHERE epost = :user AND pwd = :pwd";
$statement = $pdo->prepare($sql);
$statement->execute(array(':user' => $user, ':pwd' => $pwd));

$row = $statement->fetch(PDO::FETCH_ASSOC);

$result = [];

if (!is_null($row['ID'])) {
	$_SESSION['ID'] = $row['ID'];
	$result = [
		"user" => true,
		"pwd" => true
	];
}

else {

	$result = [
		"user" => false,
		"pwd" => false
	];

}

echo json_encode($result);

?>
