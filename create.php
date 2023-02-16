<?php
// var_dump($_POST);exit();
include('config.php');

// DSN staat voor data sourcename.
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    echo "Er is een verbinding met de database";
} catch(PDOException $e) {
    echo "Er is helaas geen verbinding met de database.<br>
          Neem contact op met de Administrator<br>";
    echo "Systeemmelding: " . $e->getMessage();
}
// Maak de sql query voor het inserten van een record
$sql = "INSERT INTO Achtbaan (Id
                            ,Achtbaan
                            ,Pretpark
                            ,Land
                            ,Topsnelheid
                            ,Hoogte
                            ,Datum
                            ,Cijfer)
        VALUES              (NULL
                            ,:achtbaan
                            ,:pretpark
                            ,:land
                            ,:snelheid
                            ,:hoogte
                            ,:opendate
                            ,:cijfer);";
// Maak de query gereed met de prepare-method van het $pdo-object
$statement = $pdo->prepare($sql);
$statement->bindValue(':achtbaan', $_POST['achtbaan'], PDO::PARAM_STR);
$statement->bindValue(':pretpark', $_POST['pretpark'], PDO::PARAM_STR);
$statement->bindValue(':land', $_POST['land'], PDO::PARAM_STR);
$statement->bindValue(':snelheid', $_POST['snelheid'], PDO::PARAM_STR);
$statement->bindValue(':hoogte', $_POST['hoogte'], PDO::PARAM_STR);
$statement->bindValue(':opendate', $_POST['opendate'], PDO::PARAM_STR);
$statement->bindValue(':cijfer', $_POST['cijfer'], PDO::PARAM_STR);

// Vuur de query af op de database...
$statement->execute();

// Hiermee sturen we automatisch door naar de pagina read.php
header('Location: read.php');



