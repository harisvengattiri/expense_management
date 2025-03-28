<?php
class Category extends DatabaseConnection {
    private $conn;

    public function __construct() {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }

    function getCategriesWithLimit($limit) {
        $sql = "SELECT * FROM `category` ORDER BY id DESC LIMIT 0,$limit";
        $result = $this->conn->query($sql);
        $categories = [];
        while ($row = mysqli_fetch_array($result)) {
            $categories[] = $row;
        }
        return $categories;
    }
    
    function addCategory($data) {
        $sql = "INSERT INTO `category` (`name`) VALUES ('{$data["category"]}')";
        $this->conn->query($sql);
        $logQuery = mysqli_real_escape_string($this->conn,$sql);
        logActivity('add','CAT',$this->conn->insert_id,$logQuery);
    }
}