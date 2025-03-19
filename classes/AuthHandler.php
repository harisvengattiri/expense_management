<?php

class AuthHandler {
    private $auth;
    private $iplocation;
    private $user;
    private $password;

    public function __construct() {
        $this->auth = new Auth();
        $this->iplocation = '1.0.0.0';
    }

    public function login($user, $password) {
        $this->user =  $user;
        $this->password = $password;

        try {
            $this->auth->checkUserExistence($this->user, $this->password);
            $userDetails = $this->auth->getUserInfo($this->user, $this->password);
            $this->auth->setUserSession($userDetails);
            $this->auth->trackLoginAttempt($this->user, $this->iplocation, 'success');
            header('Location:'.BASEURL.'/?folded=false');
        } catch (Exception $e) {
            $this->auth->trackLoginAttempt($this->user, $this->iplocation, 'failed');
            session_destroy();
            header('Location:'.BASEURL.'/login/?status=failed');
        }
    }

    public function logout() {
        session_start(); 
        session_destroy();
        header('Location:'.BASEURL.'/login?status=logout');
    }
}
