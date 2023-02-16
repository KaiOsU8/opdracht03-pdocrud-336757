<?php
// Voeg de database-gegevens
require('config.php');

// Maak de $dsn oftewel de data sourcename string
$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    // Maak een nieuw PDO object zodat je verbinding hebt met de mysql database
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Verbinding is gelukt";
    } else {
        echo "Interne server-error";
    }
} catch (PDOException $e) {
    $e->getMessage();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // echo "skdf";exit();
    try {
        // Maak een update query voor het updaten van een record
        $sql = "UPDATE Achtbaan
                SET Achtbaan = :Achtbaan,
                    Pretpark = :Pretpark,
                    Land = :Land,
                    Topsnelheid = :Topsnelheid,
                    Hoogte = :Hoogte,
                    Datum = :Datum,
                    Cijfer = :Cijfer
                WHERE Id = :Id";

        // Roep de prepare-method aan van het PDO-object $pdo
        $statement = $pdo->prepare($sql);

        // We moeten de placeholders een waarde geven in de sql-query
        $statement->bindValue(':Id', $_POST['Id'], PDO::PARAM_INT);
        $statement->bindValue(':Achtbaan', $_POST['achtbaan'], PDO::PARAM_STR);
        $statement->bindValue(':Pretpark', $_POST['pretpark'], PDO::PARAM_STR);
        $statement->bindValue(':Land', $_POST['land'], PDO::PARAM_STR);
        $statement->bindValue(':Topsnelheid', $_POST['snelheid'], PDO::PARAM_STR);
        $statement->bindValue(':Hoogte', $_POST['hoogte'], PDO::PARAM_STR);
        $statement->bindValue(':Datum', $_POST['opendate'], PDO::PARAM_STR);
        $statement->bindValue(':Cijfer', $_POST['cijfer'], PDO::PARAM_STR);

        // We gaan de query uitvoeren op de mysql-server
        $statement->execute();

        echo "Het record is geupdate";
        header("Refresh:3; read.php");

    } catch(PDOException $e) {
        echo "Het record is niet geupdate";
        header("Refresh:3; read.php");
    }
    exit();
}

// Maak een select-query
$sql = "SELECT * FROM Achtbaan
        WHERE Id = :Id";

// Voorbereiden van de query
$statement = $pdo->prepare($sql);

$statement->bindValue(':Id', $_GET['Id'], PDO::PARAM_INT);

$statement->execute();

$result = $statement->fetch(PDO::FETCH_OBJ);

// var_dump($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">
    <title>PDO CRUD</title>
</head>
<body>
    <h1>PDO CRUD</h1>

    <form action="update.php" method="post">

        <label for="achtbaan">Naam Achtbaan:</label><br>
        <input type="text" name="achtbaan" id="achtbaan" value="<?php echo $result->Achtbaan; ?>"><br><br>

        <label for="pretpark">Naam Pretpark:</label><br>
        <input type="text" name="pretpark" id="pretpark" value="<?php echo $result->Pretpark; ?>"><br><br>

        <label for="land">Naam Land:</label><br>
        <input type="text" name="land" id="land" value="<?php echo $result->Land; ?>"><br><br>

        <label for="snelheid">Topsnelheid (km/u):</label><br>
        <input type="number" name="snelheid" id="snelheid" value="<?php echo $result->Topsnelheid; ?>"><br><br>

        <label for="hoogte">Hoogte (m):</label><br>
        <input type="number" name="hoogte" id="hoogte" value="<?php echo $result->Hoogte; ?>"><br><br>

        <label for="opendate">Datum eerste opening:</label><br>
        <input type="date" name="opendate" id="opendate" value="<?php echo $result->Datum; ?>"><br><br>
        
        <label for="cijfer">Cijfer voor achtbaan:</label><br>
        <input type="range" name="cijfer" id="cijfer" value="<?php echo $result->Cijfer; ?>"><br><br>

        <input type="hidden" name="Id" value="<?php echo $result->Id; ?>">

        <input type="submit" value="Verstuur">
    </form>
</body>
</html>