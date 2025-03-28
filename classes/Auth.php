<?php

class Auth extends DatabaseConnection {

    function checkUserExistence($user, $pass) {
        $username = mysqli_real_escape_string($this->getConnection(), $user);
        $password = mysqli_real_escape_string($this->getConnection(), $pass);
        $pwd = md5($password);
    
        $sql = "select * from users where username='$username' and pwd='$pwd'";
        $result = mysqli_query($this->getConnection(), $sql);
        $row = mysqli_fetch_assoc($result);
        if(!$row) {
            throw new Exception('User with this username and password does not exist');
        }
    }
    
    function getUserInfo($user, $password) {
        $username = mysqli_real_escape_string($this->getConnection(), $user);
        $password = mysqli_real_escape_string($this->getConnection(), $password);
        $pwd = md5($password);
    
        $sql = "select * from users where username='$username' and pwd='$pwd'";
        $result = mysqli_query($this->getConnection(), $sql);
        $row = mysqli_fetch_assoc($result);
        if(!$row) {
            throw new Exception('Unable to fetch user details');
        }
        return $row;
    }
    
    function setUserSession($userDetails) {
        session_start();
        $_SESSION["userid"] = $userDetails['id'];
        $_SESSION["username"] = $userDetails['username'];
        $_SESSION["role"] = $userDetails['role'];
        $_SESSION["time"] = time();
    }
    
    function trackLoginAttempt($username, $ip_location, $status) {
        $ip = $_SERVER['REMOTE_ADDR'];
        $now = date("d/m/Y h:i:s a");
    
        $sql = "INSERT INTO login_log (ip, time, location, username, status) 
                values ('$ip', '$now', '$ip_location', '$username', '$status')";
        $this->getConnection()->query($sql);
    }

    function successLog($userDetails) {
        $iplocation = getIPDetails();
        $this->setUserSession($userDetails);
        $this->trackLoginAttempt($userDetails['username'], $iplocation, 'success');
    }

    function failedLog($user) {
        $iplocation = getIPDetails();
        $this->trackLoginAttempt($user, $iplocation, 'failed');
        session_destroy();
    }

    public function login($user, $password) {
        $this->checkUserExistence($user, $password);
        $userDetails = $this->getUserInfo($user, $password);
        $this->successLog($userDetails);
    }

    public function logout() {
        session_start(); 
        session_destroy();
    }
}
