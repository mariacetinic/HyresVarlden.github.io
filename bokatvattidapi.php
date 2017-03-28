<?php
session_start();
require("config.php");

$tidID = $_POST['idnr'];
$user = $_SESSION['ID'];
$resultatboka = [];
    $sql = " SELECT `tvattID` FROM `bokatvattid` WHERE tidID = :tidID";
    $statement = $pdo->prepare($sql);
    $statement->execute(['tidID' => $tidID]);
    if ($statement->rowCount() != 0 ) { 
        $resultatboka = [
            "idnr" => false
        ];
    }
    else {
        $sql = "INSERT INTO bokatvattid (`userID`, `tidID`) VALUES(:userID, :tidID)";
        $statement = $pdo->prepare($sql);
        $statement->execute(['userID' => $user, 'tidID' => $tidID]);
        $resultatboka = [
            "idnr" => true
        ];
    }
echo json_encode($resultatboka);

?>
