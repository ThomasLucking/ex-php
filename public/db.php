<?php

function databaseconnection()
    {
        try {
            $pdo = new PDO("sqlite:" . __DIR__ . "/database.db");
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            $pdo->exec("CREATE TABLE IF NOT EXISTS todos (
            id INTEGER PRIMARY KEY AUTOINCREMENT,
            title TEXT NOT NULL,
            due_date TEXT NOT NULL
            )");

            return $pdo;

        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

?>