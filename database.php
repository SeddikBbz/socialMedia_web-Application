<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "projectssd";

// Crée la connexion à la base de données
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifie la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
