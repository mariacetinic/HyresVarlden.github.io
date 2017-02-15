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





/*kalender start */
$veckonummer = $_POST;

$fastaTider = array("09:00", "12:00", "15:00", "18:00", "21:00");

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
    $sql = " SELECT * FROM bokabastu WHERE bastuDatum = :firstdayofweek AND bastuTid = :fastaTider";
    $statement = $pdo->prepare($sql);
    $statement->execute(['firstdayofweek' => $datum, 'fastaTider' => $fasttid]);


    //echo "<tr> <th>Id</th> <th>Datum</th> <th>Tid</th></tr>";
    foreach($statement as $row) {
      /*echo "<tr>";
      echo "<td>{$row['bastuID']}</td>";
      echo "<td>{$row['bastuDatum']}</td>";
      echo "<td>{$row['bastuTid']}</td>";
      echo "</tr>";*/
      $resultat[] = $row;
    }
   }
}

  //echo "</table>";
  echo json_encode($resultat);
//secho "<br>";

/*$res = null;
$conn = null;

$sql_check = "SELECT COUNT(*) FROM bokabastu";
if ($res = $pdo->query($sql_check)) {


 if ($res->fetchColumn() > 0) {

      
      $sql_check = "SELECT bastuDatum, bastuTid FROM bokabastu";
      foreach ($pdo->query($sql_check) as $row) {
          print "Dessa tider är just nu uppbokade: " .  $row['bastuDatum'] . "<br>";
      }
 }

 else {
     print "Inte bokad";
 }
}*/

?>