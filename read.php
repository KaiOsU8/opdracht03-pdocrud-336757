<?php
/**
 * Maak een verbinding met de mysqlserver en database
 */
include('config.php');

$dsn = "mysql:host=$dbHost;dbname=$dbName;charset=UTF8";

try {
    $pdo = new PDO($dsn, $dbUser, $dbPass);
    if ($pdo) {
        // echo "Er is een verbinding met de mysql server";
    } else {
        echo "Er is een interne server error opgetreden"; 
    }
} catch(PDOException $e) {
    echo $e->getMessage();
}

/**
 * Maak een select query om de gegevens uit de tabel Persoon te halen
 */

$sql = "SELECT Id
              ,Achtbaan
              ,Pretpark
              ,Land
              ,Topsnelheid
              ,Hoogte
              ,Datum
              ,Cijfer
        FROM Achtbaan";

//Bereid de de query voor met de method prepare
$statement = $pdo->prepare($sql);

// Voer de query uit
$statement->execute();

// Zet de opgehaalde gegevens in een array van objecten
$result = $statement->fetchAll(PDO::FETCH_OBJ);
// var_dump($result);

$tableRows = "";

foreach($result as $info) {
    $tableRows .= "<tr>
                        <td>$info->Achtbaan</td>
                        <td>$info->Pretpark</td>
                        <td>$info->Land</td>
                        <td>$info->Topsnelheid</td>
                        <td>$info->Hoogte</td>
                        <td>$info->Datum</td>
                        <td>$info->Cijfer</td>
                        <td>
                            <a href='delete.php?Id=$info->Id'>
                                <img src='img/b_drop.png' alt='cross'>
                            </a>
                        </td>
                        <td>
                            <a href='update.php?Id=$info->Id'>
                                <img src='img/b_edit.png' alt='pencil'>
                            </a>
                        </td>
                   </tr>";
}
?>
<h3>Achtbaan-Info</h3>

<a href="index.php">
    <input type="button" value="Maak een nieuw record">
</a>

<br><br>
<table border='1'>
    <thead>
        <th>Achtbaan</th>
        <th>Pretpark</th>
        <th>Land</th>
        <th>Topsnelheid</th>
        <th>Hoogte</th>
        <th>Datum</th>
        <th>Cijfer</th>
        <th></th>
        <th></th>
    </thead>
    <tbody>
        <?php echo $tableRows; ?>
    </tbody>
</table>



