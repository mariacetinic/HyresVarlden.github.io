<?php

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

/*tvättkalender start */
$veckonummer = $_POST;

$fastaTider = array("06:00", "12:00", "18:00");

$week_start = new DateTime();
$week_start->setISODate(2017,6);
$startmonday = $week_start->format('Y-m-d');
$week_start->modify('- 1 day');

$resultat = array();

for ($i = 0; $i < 7; $i ++) {
  $week_start->modify('+ 1 day');
  $datum = $week_start->format('Y-m-d');
  for ($x = 0; $x < 3; $x++){

    $fasttid = $fastaTider[$x];
    $sql = " SELECT * FROM bokatvattid WHERE tvattDatum = :firstdayofweek AND tvattTid = :fastaTider";
    $statement = $pdo->prepare($sql);
    $statement->execute(['firstdayofweek' => $datum, 'fastaTider' => $fasttid]);


    foreach($statement as $row) {
      $resultat[] = $row;
    }
   }
}

  echo json_encode($resultat);

$res = null;
$conn = null;
?>
