<?php
class Expense extends DatabaseConnection {
    private $conn;

    public function __construct() {
        $db = new DatabaseConnection();
        $this->conn = $db->getConnection();
    }
 
    function getExpensesWithInPeriod($period) {
        $sql = "SELECT * FROM `expense` $period ORDER BY id DESC";
        $result = $this->conn->query($sql);
        $expenses = [];
        while ($row = mysqli_fetch_array($result)) {
            $expenses[] = $row;
        }
        return $expenses;
    }

    function getExpensesWithLimit($limit) {
        $sql = "SELECT * FROM `expense` ORDER BY id DESC LIMIT 0,$limit";
        $result = $this->conn->query($sql);
        $expenses = [];
        while ($row = mysqli_fetch_array($result)) {
            $expenses[] = $row;
        }
        return $expenses;
    }
    
    function getExpenseDetails($id) {
        $sql = "SELECT * FROM `expense` WHERE `id` = $id";
        checkAccountExist('expense','id',$id);
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        if(!$row) {
            throw new Exception();
        }
        return $row;
    }
    
    function addExpense($data) {
        $sql = "INSERT INTO `expense` (`particular`,`date`,`amount`) VALUES ('{$data["particular"]}','{$data["date"]}','{$data["amount"]}')";
        $this->conn->query($sql);
        $logQuery = mysqli_real_escape_string($this->conn,$sql);
        logActivity('add','EXP',$this->conn->insert_id,$logQuery);
    }
    
    function editExpense($data) {
        $expense = $data['expense'];
    
        $sql = "UPDATE `expense` SET `particular`='{$data["particular"]}',`date`='{$data["date"]}',`amount`='{$data["amount"]}' WHERE `id` = $expense";
        checkAccountExist('expense','id',$expense);
        $this->conn->query($sql);
        $logQuery = mysqli_real_escape_string($this->conn,$sql);
        logActivity('edit','EXP',$expense,$logQuery);
    }
    
    function deleteExpense($data) {
        $expense = $data["id"];
    
        $sql = "DELETE FROM `expense` WHERE `id` = $expense";
        checkAccountExist('expense','id',$expense);
        $this->conn->query($sql);
        $logQuery = mysqli_real_escape_string($this->conn,$sql);
        logActivity('delete','EXP',$expense,$logQuery);
    }
}