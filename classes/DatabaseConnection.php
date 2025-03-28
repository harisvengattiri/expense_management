<?php

class DatabaseConnection {
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        loadEnv($_SERVER['DOCUMENT_ROOT'].'/medisep/.env');
        
        $servername = $_ENV['DB_HOST'];
        $username = $_ENV['DB_USERNAME'];
        $password = $_ENV['DB_PASSWORD'];
        $dbname = $_ENV['DB_DATABASE'];
        
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}