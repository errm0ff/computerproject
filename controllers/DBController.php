<?php
class DBController {
    protected $pdo;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'db_joboh';
        $user = 'root';
        $pass = '';

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    // Getter for PDO object so controllers can use it
    public function getConnection() {
        return $this->pdo;
    }
}

