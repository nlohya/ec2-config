<?php

try {
    $conn = new PDO("mysql:host=terraform-20231215100811342300000002.cjd61w5im1sh.eu-north-1.rds.amazonaws.com;dbname=terrdb", "db_aws_user", "4lNVZCWo7fD8RKq8ITognZBFSqaxNU4DdytlYP7W");
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $e) {
    print("Error connecting to SQL Server.");
    die(print_r($e));
}

if (isset($_GET["name"])) {
    $sql = "INSERT INTO utilisateurs (nom) VALUES (?)";
    $conn->prepare($sql)->execute([$_GET["name"]]);
}

$conn->exec("CREATE TABLE IF NOT EXISTS utilisateurs (nom VARCHAR(50))");

$stmt = $conn->query("SELECT (nom) FROM utilisateurs");
while ($row = $stmt->fetch()) {
    echo $row['nom']."<br />\n";
}
?>
<form method="GET">
    <input type="text" placeholder="Nom" name="name" />
    <input type="submit" value="ajouter le monsieur" />
</form>