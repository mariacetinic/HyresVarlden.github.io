<?php
session_start();
require("config.php");

$tidID = $_POST['idnr'];
$user = $_SESSION['ID'];
$resultatboka = [];
$sql = " SELECT `tvattID` FROM `bokatvattid` WHERE tidID = :timeID";
$statement = $pdo->prepare($sql);
$statement->execute(['tidID' => $timeID]);
if ($statement->rowCount() != 0 ) { 
    $resultatbooking = [
        "idnr" => false
    ];
}
else {
    $sql = "INSERT INTO bokatvattid (`userID`, `tidID`) VALUES(:userID, :timeID)";
    $statement = $pdo->prepare($sql);
    $statement->execute(['userID' => $user, 'tidID' => $timeID]);
    $resultbooking = [
        "idnr" => true
    ];
}
echo json_encode($resultatbooking);

