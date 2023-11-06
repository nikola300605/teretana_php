<?php
    require_once 'config.php';

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $tp_name = $_POST['name'];
        $sessions = $_POST['sessions'];
        $price = $_POST['price'];

        $sql = "INSERT INTO training_plans (name, sessions, price) VALUES (?, ?,?)";
        $run = $conn->prepare($sql);
        $run->bind_param("sis", $tp_name, $sessions, $price);
        $run->execute();

        $_SESSION['success_message'] = "Training plan successfully added";
        header("location: admin_dashboard.php");
        exit();
    }