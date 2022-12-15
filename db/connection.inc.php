<?php
$servername = "localhost";
$username = "root";
$password = "260405";
$dbname = "db_to_do";

// Connect to the MySQL database using the PDO object.
$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

//erick