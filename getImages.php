<?php
$host = "nom du host";
$dbname = "nom de la bdd";
$user = "nom";
$pass = "mot de passe";

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $stmt = $conn->query("SELECT chemin FROM ciel");
    $images = $stmt->fetchAll(PDO::FETCH_COLUMN);
    header("Content-Type: application/json");
    echo json_encode($images);
} catch (Exception $e) {
    echo "Erreur : " . $e->getMessage();
}
?>
