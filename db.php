<?php
// Database connection parameters
$host = 'localhost';
$username = 'root';
$password = '';

// Establishing a connection to the MySQL server
try {
    $pdo = new PDO("mysql:host=$host", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Creating the "patient" database
try {
    $pdo->exec("CREATE DATABASE IF NOT EXISTS patient");
    echo "Database created successfully!<br>";
} catch (PDOException $e) {
    die("Error creating database: " . $e->getMessage());
}

// Switching to the "patient" database
try {
    $pdo->exec("USE patient");
    echo "Using database: patient<br>";
} catch (PDOException $e) {
    die("Error switching to database: " . $e->getMessage());
}

// Creating the "patients" table
try {
    $pdo->exec("
        CREATE TABLE IF NOT EXISTS patients (
            id INT AUTO_INCREMENT PRIMARY KEY,
            full_name VARCHAR(255) NOT NULL,
            email VARCHAR(255) NOT NULL,
            username VARCHAR(255) NOT NULL,
            password VARCHAR(255) NOT NULL
        )
    ");
    echo "Table 'patients' created successfully!<br>";
} catch (PDOException $e) {
    die("Error creating table: " . $e->getMessage());
}
?>
