<?php
session_start();
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

$tidID = $_POST['idnr'];
$user = $_SESSION['ID'];
$resultatboka = [];
    $sql = " SELECT `tvattID` FROM `bokatvattid` WHERE tidID = :tidID";
    $statement = $pdo->prepare($sql);
    $statement->execute(['tidID' => $tidID]);
    if ($statement->rowCount() == 0 ) { //om det inte finns en rad, skrivs if satsen ut. om det finns en rad hoppar den till else och tar bort en rad
        $resultatboka = [
            "idnr" => false
        ];
    }
    else {
        $sql = "DELETE FROM bokatvattid WHERE userID = :userID AND tidID = :tidID";
        $statement = $pdo->prepare($sql);
        $statement->execute(['userID' => $user, 'tidID' => $tidID]);
        $resultatboka = [
            "idnr" => true
        ];
    }
echo json_encode($resultatboka);
?>