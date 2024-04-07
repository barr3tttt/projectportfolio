<?php
session_start();

if (!isset($_SESSION['loggedin']) || $_SESSION['role'] !== 'administrator') {
    header('Location: logon.php');
    exit();
}

phpinfo();
?>
