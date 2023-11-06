<?php
    require_once 'config.php';
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $trainer_id = $_POST['trainer_id'];

        $sql = "DELETE FROM trainers WHERE trainer_id = ?";
        $run = $conn->prepare($sql);
        $run->bind_param("i", $trainer_id);
        if($run->execute()){
            $_SESSION['success_message'] = "Trener obrisan";
            $sql = "UPDATE members SET trainer_id = NULL WHERE trainer_id = ?";
            $run = $conn->prepare($sql);
            $run->bind_param("i", $trainer_id);
            $run->execute();
        }
        else $_SESSION['success_message'] = "Trener nije obrisan";
        
        header('location: admin_dashboard.php');
        exit();
    }
?>