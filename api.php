<?php
//en kommentar för att se om git ger respond

session_start();
//header('Access-Control-Allow-Origin: *'); 
require("config.php");


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
