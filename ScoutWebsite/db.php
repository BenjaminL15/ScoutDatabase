<?php
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = "Piano210903!"; // Your database password
$dbname = "scouts"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 



