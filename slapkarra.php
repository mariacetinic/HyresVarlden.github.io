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





/*Släpkärra*/

$veckonummer = $_POST;

$fastaStrl = array("liten", "stor");

$week_start = new DateTime();
$week_start->setISODate(2017,6);
$startmonday = $week_start->format('Y-m-d');
$week_start->modify('- 1 day');

//echo "<table>";

$resultat = array();

for ($i = 0; $i < 7; $i ++) {
  $week_start->modify('+ 1 day');
  $datum = $week_start->format('Y-m-d');
 for ($x = 0; $x < 2; $x++){

 $karrastrl = $fastaStrl[$x];
    $sql = " SELECT * FROM bokaslapkarra WHERE karraDatum = :firstdayofweek AND karraStrl = :fastaStrl";
    $statement = $pdo->prepare($sql);
    $statement->execute(['firstdayofweek' => $datum, 'fastaStrl' => $karrastrl]);


    //echo "<tr> <th>Id</th> <th>Datum</th> <th>Pris</th><th>Storlek</th></tr>";
    foreach($statement as $row) {
      /*echo "<tr>";
      echo "<td>{$row['slapkarraID']}</td>";
      echo "<td>{$row['karraDatum']}</td>";
      echo "<td>{$row['karraPris']}</td>";
      echo "<td>{$row['karraStrl']}</td>";
      echo "</tr>";*/
      $resultat[] = $row;
    }
   }
}

  //echo "</table>";
  //echo "<br><br><br>";
  echo json_encode($resultat);
//echo "<br><br><br>";
/*$res = null;
$conn = null;

$sql_check = "SELECT COUNT(*) FROM `bokaslapkarra`";
if ($res = $pdo->query($sql_check)) {

 if ($res->fetchColumn() > 0) {

      $sql_check = "SELECT * FROM bokaslapkarra";
      foreach ($pdo->query($sql_check) as $row) {
          print "Släpkärror är bokade på dessa datum: " .  $row['karraDatum'] . "<br>";
      }
 }
 else {
     print "Inte bokad";
 }
}*/

?>