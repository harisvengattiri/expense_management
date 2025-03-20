<?php
session_start();
require_once("database.php");

// Totally Handling Switch Here
$controller = $_REQUEST['controller'];
switch ($controller) {
    case 'authentication':
        handleAuth();
        break;
    case 'expense':
        handleExpense();
        break;
}

// Authentication Section here
function handleAuth() {
    $authHandler = new Auth();
    if (isset($_REQUEST['auth_login'])) {
        try {
            $authHandler->login($_REQUEST['username'], $_REQUEST['password']);
            header('Location:'.BASEURL.'/?folded=false');
            exit();
        } catch (Exception $e) {
            header('Location:'.BASEURL.'/login/?status=failed');
            exit();
        }
    }
    if (isset($_REQUEST['auth_logout'])) {
        try {
            $authHandler->logout();
            header('Location:'.BASEURL.'/login?status=logout');
            exit();
        } catch (Exception $e) {
            header('Location:'.BASEURL.'/login?status=failed');
            exit();
        }
    }
}

// Expenses Section here
function handleExpense() {
    $expenseHandler = new Expense();
    if (isset($_REQUEST['add_expense'])) {
        try {
            $expenseHandler->addExpense($_REQUEST);
            header('Location: '.BASEURL.'/expense?status=success');
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'/expense?status=failed');
            exit();
        }
    }
    if (isset($_REQUEST['edit_expense'])) {
        try {
            $expenseHandler->editExpense($_REQUEST);
            header('Location: '.BASEURL.'/expense?status=success');
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'/expense?status=failed');
            exit();
        }
    }
    if (isset($_REQUEST['delete_expense'])) {
        try {
            $expenseHandler->deleteExpense($_REQUEST);
            header('Location: '.BASEURL.'/expense?status=success');
            exit();
        } catch (Exception $e) {
            header('Location: '.BASEURL.'/expense?status=failed');
            exit();
        }
    }
}
