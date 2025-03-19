<?php
session_start();
require_once("database.php");

// Totally Handling Switch Here
$controller = $_REQUEST['controller'];
switch ($controller) {
    case 'authentication':
        handleAuth();
        break;
    case 'vehicles':
        handleVehicles();
        break;
}

// Authentication Section here
function handleAuth() {
    $authHandler = new AuthHandler();
    
    if (isset($_REQUEST['auth_login'])) {
        $authHandler->login($_REQUEST['username'], $_REQUEST['password']);
    }
    if (isset($_REQUEST['auth_logout'])) {
        $authHandler->logout();
    }
}

// Vehicles Section here
function handleVehicles() {
    if (isset($_REQUEST['submit_add_vehicle'])) {
        try {
            addVehicle($_REQUEST);
            header('Location: '.BASEURL.'/vehicles?status=success');
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'/vehicles?status=failed');
            exit();
        }
    }
    if (isset($_REQUEST['submit_edit_vehicle'])) {
        try {
            editVehicle($_REQUEST);
            header('Location: '.BASEURL.'/vehicles?status=success');
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'/vehicles?status=failed');
            exit();
        }
    }
    if (isset($_REQUEST['submit_delete_vehicle'])) {
        try {
            deleteVehicle($_REQUEST);
            header('Location: '.BASEURL.'/vehicles?status=success');
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'/vehicles?status=failed');
            exit();
        }
    }
}
