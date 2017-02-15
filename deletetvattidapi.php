<?php
session_start();
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
/*tvättkalender start */
$tidID = $_GET['idnr'];
$user = 1; //$_SESSION['userID'];
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
        $sql = "DELETE FROM bokatvattid WHERE(:userID, :tidID)";
        $statement = $pdo->prepare($sql);
        $statement->execute(['userID' => $user, 'tidID' => $tidID]);
        $resultatboka = [
            "idnr" => true
        ];
    }
echo json_encode($resultatboka);
//$fastaTider = array("06:00", "12:00", "18:00");
/*
$week_start = new DateTime();
$week_start->setISODate(2017,6);
$startmonday = $week_start->format('Y-m-d');
$week_start->modify('- 1 day');
*/
//$resultat = array();
/*for ($i = 0; $i < 7; $i ++) {
  $week_start->modify('+ 1 day');
  $datum = $week_start->format('Y-m-d');
  for ($x = 0; $x < 3; $x++){
*/
/*if (!is_null($row['ID'])) {
    $_SESSION['ID'] = $row['ID'];
    //echo "Uppbokad";
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
}*/
//insert into
    //$fasttid = $fastaTider[$x];


/*
    foreach($statement as $row) {

      $resultat[] = $row;
    }
   }
}*/
// hur ska userID kopplas till gästinlogg
// true eller false?
//json encode
//tidID
//datefunktion
?>
