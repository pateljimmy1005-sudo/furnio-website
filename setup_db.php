<?php
$host = '127.0.0.1';
$user = 'root';
$pass = '';

$mysqli = new mysqli($host, $user, $pass);
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error . "\n");
}

// 1. Create furniture_db database if not exists
$mysqli->query("CREATE DATABASE IF NOT EXISTS `furniture_db` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci");

// Drop and clone all tables from furnio to furniture_db
$res = $mysqli->query("SHOW TABLES FROM `furnio`");
while ($row = $res->fetch_row()) {
    $table = $row[0];
    $mysqli->query("DROP TABLE IF EXISTS `furniture_db`.`$table`");
    $mysqli->query("CREATE TABLE `furniture_db`.`$table` LIKE `furnio`.`$table`");
    $mysqli->query("INSERT INTO `furniture_db`.`$table` SELECT * FROM `furnio`.`$table`");
}

echo "Both databases ('furnio' and 'furniture_db') are now identical and synced!\n";
$mysqli->close();
