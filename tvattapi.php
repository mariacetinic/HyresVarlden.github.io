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

/*tvättkalender start */
$veckonummer = $_POST;

$fastaTider = array("06:00", "12:00", "18:00");

$week_start = new DateTime();
$week_start->setISODate(2017,6);
$startmonday = $week_start->format('Y-m-d');
$week_start->modify('- 1 day');

//echo "<table>";

$resultat = array();

for ($i = 0; $i < 7; $i ++) {
  $week_start->modify('+ 1 day');
  $datum = $week_start->format('Y-m-d');
  for ($x = 0; $x < 3; $x++){

    $fasttid = $fastaTider[$x];
    $sql = " SELECT * FROM bokatvattid WHERE tvattDatum = :firstdayofweek AND tvattTid = :fastaTider";
    $statement = $pdo->prepare($sql);
    $statement->execute(['firstdayofweek' => $datum, 'fastaTider' => $fasttid]);


    //echo "<tr> <th>Id</th> <th>Datum</th> <th>Tid</th></tr>";
    foreach($statement as $row) {
      /*echo "<tr>";
      echo "<td>{$row['tvattID']}</td>";
      echo "<td>{$row['tvattDatum']}</td>";
      echo "<td>{$row['tvattTid']}</td>";
      echo "</tr>";*/
      $resultat[] = $row;
    }
   }
}

  //echo "</table>";
  echo json_encode($resultat);
//echo "<br>";
$res = null;
$conn = null;

/*$sql_check = "SELECT COUNT(*) FROM bokatvattid";
if ($res = $pdo->query($sql_check)) {

 // Check the number of rows that match the SELECT statement
 if ($res->fetchColumn() > 0) {

      // Issue the real SELECT statement and work with the results
      $sql_check = "SELECT tvattDatum, tvattTid FROM bokatvattid";
      foreach ($pdo->query($sql_check) as $row) {
          print "Dessa tider är just nu uppbokade: " .  $row['tvattDatum'] . "<br>";
      }
 }
 // No rows matched -- do something else
 else {
     print "Inte bokad";
 }
}*/

?>
