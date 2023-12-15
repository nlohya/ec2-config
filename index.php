<h1>Bonjour !</p>

<?php

try {
    $conn = new PDO("mysql:host=" . getenv("DB_HOST") . ";dbname=terrdb", getenv("DB_USER"), getenv("DB_PASS"));
    var_dump($conn);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    var_dump("coucou");
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

var_dump($conn);

$conn->prepare("CREATE TABLE IF NOT EXISTS utilisateurs (nom VARCHAR(50))")->execute();


if (isset($_GET["name"])) {
    $sql = "INSERT INTO utilisateurs (nom) VALUES (?)";
    $conn->prepare($sql)->execute([$_GET["name"]]);
}


$stmt = $conn->query("SELECT (nom) FROM utilisateurs");
while ($row = $stmt->fetch()) {
    echo $row['nom']."<br />\n";
}

?>

<form method="GET">
    <input type="text" placeholder="Nom" name="name" />
    <input type="submit" value="ajouter le monsieur" />
</form>