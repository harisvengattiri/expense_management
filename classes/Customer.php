<?php

class Customer {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    function insertCustomer($data) {
        $sql = "INSERT INTO customers (name,person,address,gst,phone,mobile,fax,email,type,slmn) 
                VALUES ('{$data["name"]}','{$data["person"]}','{$data["address"]}','{$data["gst"]}','{$data["phone"]}','{$data["mobile"]}','{$data["fax"]}','{$data["email"]}','{$data["type"]}','{$data["slmn"]}')";
        $this->conn->query($sql);
        $logQuery = mysqli_real_escape_string($this->conn,$sql);
        logActivity('add','CID',$this->conn->insert_id,$logQuery);
    }

    function editCustomer($data) {
        $sql = "UPDATE `customers` SET `name` = '{$data["name"]}', `person` = '{$data["person"]}', `gst` = '{$data["gst"]}', `address` =  '{$data["address"]}',
                `phone` =  '{$data["phone"]}', `fax` =  '{$data["fax"]}', `mobile` =  '{$data["mobile"]}', `email` =  '{$data["email"]}', `type` =  '{$data["type"]}',
                `slmn` =  '{$data["slmn"]}' WHERE  `id` = {$data["id"]}";
        checkAccountExist('customers','id',$data['id']);
        $this->conn->query($sql);
        $logQuery = mysqli_real_escape_string($this->conn,$sql);
        logActivity('edit','CID',$data['id'],$logQuery);
    }

    function deleteCustomer($data) {
        $sql = "DELETE FROM `customers` WHERE `id` = {$data["id"]}";
        checkAccountExist('customers','id',$data['id']);
        $this->conn->query($sql);
        $logQuery = mysqli_real_escape_string($this->conn,$sql);
        logActivity('delete','CID',$data['id'],$logQuery);
    }

    function getCustomerDetails($cid) {
        $sql = "SELECT * FROM `customers` WHERE `id` = $cid";
        checkAccountExist('customers','id',$cid);
        $result = $this->conn->query($sql);
        $row = mysqli_fetch_assoc($result);
        if(!$row) {
            throw new Exception();
        }
        return $row;
    }

    function getContactNameFromId($id) {
        $sql = "SELECT name FROM `customers` WHERE `id` = '$id'";
        checkAccountExist('customers','id',$id);
        $result = $this->conn->query($sql);
        $fetch = mysqli_fetch_array($result);
        $contact_name = $fetch['name'];
        return $contact_name;
    }
}