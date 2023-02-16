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

    <form action="create.php" method="post">
        <label for="achtbaan">Naam Achtbaan:</label><br>
        <input type="text" name="achtbaan" id="achtbaan"><br>

        <label for="pretpark">Naam Pretpark:</label><br>
        <input type="text" name="pretpark" id="pretpark"><br>

        <label for="land">Naam Land:</label><br>
        <input type="text" name="land" id="land"><br>

        <label for="snelheid">Topsnelheid (km/u):</label><br>
        <input type="number" name="snelheid" id="snelheid"><br>

        <label for="hoogte">Hoogte (m):</label><br>
        <input type="number" name="hoogte" id="hoogte"><br>

        <label for="opendate">Datum eerste opening:</label><br>
        <input type="date" name="opendate" id="opendate"><br>

        <label for="cijfer">Cijfer voor achtbaan:</label><br>
        <input type="range" value="5.5" min="1" max="10" step="0.1" name="cijfer" id="cijfer"><br><br>

        <input type="submit" value="Verstuur">
    </form>
</body>
</html>