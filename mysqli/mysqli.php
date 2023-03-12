<?php
$servername = "localhost:3306";
$username = "root";
$password = "";
$DBName = "farmnote";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }
// echo "Connected successfully";

// Create database
$sql = "CREATE DATABASE IF NOT EXISTS $DBName";
mysqli_query($conn, $sql);
// if (mysqli_query($conn, $sql)) {
//     echo "Database created successfully";
// } else {
//     echo "Error creating database: " . mysqli_error($conn);
// }

//select database
$db = mysqli_select_db($conn, $DBName);

// sql to create table
$sql = "CREATE TABLE IF NOT EXISTS bull (
bullId INT PRIMARY KEY AUTO_INCREMENT,
bullPastureId INT,
bullFarmId INT,
bullName TEXT,
bullDescription TEXT,
bullUpdateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
ON UPDATE CURRENT_TIMESTAMP,
bullCadastreDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
ON UPDATE CURRENT_TIMESTAMP,
bullWeightKg DOUBLE,
bullWeightArroba DOUBLE,
bullGrowthRate DOUBLE
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS pasture (
pastureId INT PRIMARY KEY AUTO_INCREMENT,
pastureFarmId INT,
pastureName TEXT,
pastureDescription TEXT,
pastureStatus ENUM('livre','ocupado','recuperacao'),
bullUpdateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
ON UPDATE CURRENT_TIMESTAMP,
pastureCadastreDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
ON UPDATE CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS farm (
farmId INT PRIMARY KEY AUTO_INCREMENT,
farmName TEXT,
farmDescription TEXT,
farmCadastreDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
ON UPDATE CURRENT_TIMESTAMP,
farmUpdateDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
ON UPDATE CURRENT_TIMESTAMP
)";
mysqli_query($conn, $sql);

$sql = "CREATE TABLE IF NOT EXISTS farm (
imageId INT PRIMARY KEY AUTO_INCREMENT,
imageObjectId INT,
imageObjectOfImage ENUM('bull','pasture','farm'),
imagePath TEXT
)";
mysqli_query($conn, $sql);

// if (mysqli_query($conn, $sql)) {
//     echo "<br>Table bull created successfully";
// } else {
//     echo "<br>Error creating table: " . mysqli_error($conn);
// }

mysqli_close($conn);
?>