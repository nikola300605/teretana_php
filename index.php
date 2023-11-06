<?php

    require_once 'config.php';

    //echo isset($_SESSION['admin_id']);

    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $sql = "SELECT admin_id, password FROM admins WHERE username = ?";

        $run = $conn->prepare($sql);
        $run->bind_param("s",$username);
        $run->execute();

        $results = $run->get_result();


        if($results->num_rows == 1){
            $admin = $results->fetch_assoc();
            if(password_verify($password,$admin['password'])){
                $_SESSION['admin_id'] = $admin['admin_id'];

                $conn->close();
                header("location: admin_dashboard.php");
            } else {
                $_SESSION["error"] = "Incorrect password";

                $conn->close();
                header('location: index.php');
                exit();
            };
        } else {
            $_SESSION["error"] = "Incorrect username";

            $conn->close();
            header('location: index.php');
            exit();
        };
    }
    
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login Teretana</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
</head>
<body>

    <?php
      if (isset($_SESSION['error'])) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['error']; 
            unset($_SESSION['error']);
      ?>
      <button type = "button" class= "close" data-dismiss = "alert" aria-label = "Close"><span aria-hidden="true">&times;</span></button>
      </div>
    <?php endif; ?>

    <div class="container">
        <div class="row mt-5">
            <div class="col-md-6">
                <h1 class="mb-5">Admin Login</h1>
                <form action="" method="post">
                    Username: <input class="form-control" type="text" name="username"> <br>
                    Password: <input class="form-control" type="password" name="password"> <br>
                    <input class="btn btn-primary mt-3" type="submit" value="Login">
                </form>
            </div>
        </div>
    </div>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>