<?php
$host = "localhost";
$user = "root";     // sesuaikan dengan username database Anda
$pass = "";         // sesuaikan dengan password database Anda
$dbname = "todolist_db";

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Koneksi ke database gagal: " . $e->getMessage());
}
?>