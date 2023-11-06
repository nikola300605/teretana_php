<?php
    require_once 'config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $plan_id = $_POST['plan_id'];

        $sql = "DELETE FROM training_plans WHERE plan_id = ?";
        $run = $conn->prepare($sql);
        $run->bind_param("i", $plan_id);
        if($run->execute()){
            $_SESSION['success_message'] = 'Training plan deleted successfully';
            $sql = "UPDATE members SET training_plan_id = NULL WHERE training_plan_id = ?";
            $run = $conn->prepare($sql);
            $run->bind_param("i", $plan_id);
            $run->execute();
        } else $_SESSION['success_message'] = 'Training plan not deleted';

        header('Location: admin_dashboard.php');
        exit();

    }