<?php

$host = 'localhost'; 
$db = 'hyresvarlden';
$user = 'root';
$password = 'root';
$charset = 'utf8';
$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [ PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			  PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			  PDO::ATTR_EMULATE_PREPARES   => false  ];
$pdo = new PDO($dsn, $user, $password, $options);





/*cykel start bort med tider?*/
$veckonummer = $_POST;

/*$fastaTider = array("01:00", "24:00");*/

$week_start = new DateTime();
$week_start->setISODate(2017,6);
$startmonday = $week_start->format('Y-m-d');
$week_start->modify('- 1 day');

//echo "<table>";

$resultat = array();

for ($i = 0; $i < 7; $i ++) {
  $week_start->modify('+ 1 day');
  $datum = $week_start->format('Y-m-d');
 /* for ($x = 0; $x < 2; $x++){*/

 /*   $fasttid = $fastaTider[$x];*/
    $sql = " SELECT * FROM bokacyklar WHERE cykelDatum = :firstdayofweek";
    $statement = $pdo->prepare($sql);
    $statement->execute(['firstdayofweek' => $datum]);


    //echo "<tr> <th>Id</th> <th>Datum</th> <th>Pris</th></tr>";
    foreach($statement as $row) {
      /*echo "<tr>";
      echo "<td>{$row['cykelID']}</td>";
      echo "<td>{$row['cykelDatum']}</td>";
      echo "<td>{$row['cykelPris']}</td>";
      echo "</tr>";*/
      $resultat[] = $row;
    
   }
}

  //echo "</table>";
  //echo "<br><br><br>";
  echo json_encode($resultat);
//echo "<br><br><br>";
/*$res = null;
$conn = null;

$sql_check = "SELECT COUNT(*) FROM `bokacyklar`";
if ($res = $pdo->query($sql_check)) {

 if ($res->fetchColumn() > 0) {

      $sql_check = "SELECT * FROM bokacyklar";
      foreach ($pdo->query($sql_check) as $row) {
          print "Dessa datum har en eller fler cyklar bokade. " .  $row['cykelDatum'] . "<br>";
      }
 }
 else {
     print "Inte bokad";
 }
}*/

?>