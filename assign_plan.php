<?php
    require_once 'config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $member_id = $_POST['member'];
        $plan_id = $_POST['plan'];

        $sql = "UPDATE members SET training_plan_id = ? WHERE member_id = ?";
        $run = $conn->prepare($sql);
        $run->bind_param("ii", $plan_id,$member_id);
        $run->execute();

        $_SESSION['success_message'] = 'Plan assigned';

        header('Location: admin_dashboard.php');
        exit();
    }