<?php
    require_once 'config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        session_unset();
        header('Location: index.php');
    }