<?php
    require_once 'config.php';
    $username = 'admin';
    $password = 'admin123';

    echo $password ."<br>";

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
    echo $hashed_password ."<br>";

    $sql = "UPDATE admins SET password = ? WHERE username = ?";
    $run = $conn->prepare($sql);
    $run->bind_param('ss', $hashed_password, $username);
    $run->execute();
    
?>