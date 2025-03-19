<?php

class DatabaseConnection {
    private $conn;

    public function __construct() {
        $this->connect();
    }

    private function connect() {
        loadEnv4DB($_SERVER['DOCUMENT_ROOT'].'/medisep/.env');
        
        $servername = getenv('DB_HOST');
        $username = getenv('DB_USERNAME');
        $password = getenv('DB_PASSWORD');
        $dbname = getenv('DB_DATABASE');
        
        $this->conn = mysqli_connect($servername, $username, $password, $dbname);
        
        if (!$this->conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}