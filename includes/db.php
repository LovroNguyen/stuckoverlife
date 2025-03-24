<?php
    $host = 'localhost';
    $dbname = 'coursework_web1';
    $username = 'root';
    $password = '';
    $charset = 'utf8mb4';


    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

    try {
        $pdo = new PDO($dsn, $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        throw new PDOException($e->getMessage(), (int)$e->getCode());
    }
?>