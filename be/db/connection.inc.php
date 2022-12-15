<?php
$servername = "localhost";
$username = "root";
$password = "260405";
$dbname = "db_to_do";

$pdo = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
