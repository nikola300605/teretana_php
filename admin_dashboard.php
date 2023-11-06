<?php
    require_once 'config.php';  

    if(!isset($_SESSION['admin_id'])){
        header('location: index.php');
        exit();
    } 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="CSS/dashboard_style.css">
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />
    
    <title>Document</title>
</head>
<body>

  <?php
      if (isset($_SESSION['success_message'])) : ?>
      <div class="alert alert-success alert-dismissible fade show" role="alert">
      <?php echo $_SESSION['success_message']; 
            unset($_SESSION['success_message']);
      ?>
      <button type = "button" class= "close" data-dismiss = "alert" aria-label = "Close"><span aria-hidden="true">&times;</span></button>
      </div>
    <?php endif; ?>
    
<div class = "container">
  <div class="row mb-5" id = "heading">
    <div class="col-md-12">
      <h1 class="text-center">Admin Dashboard</h1>
      <form action="sign_out.php" method="post" class="mb-10">
        <button class="btn btn-success btn-sm">Sign Out</button>
      </form>
  </div>
    
  </div>
  
  <div class = "row">
    <div class = "col-md-12">
      <h2>Member List </h2>
      <a href="export.php?what=members" class="btn btn-success btn-sm mb-3">Export</a>  
      <table class = "table table-striped">
                <thead>
                  <tr>
                    <th>First name</th>
                    <th>Last name</th>
                    <th>Email</th>
                    <th>Phone number</th>
                    <th>Trainer</th>
                    <th>Photo</th>
                    <th>Training Plan</th>
                    <th>Access Card</th>
                    <th>Created at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php 
                  $sql = "SELECT members.*, CONCAT(trainers.first_name, ' ', trainers.last_name) AS trainer_name, training_plans.name AS tp_name FROM members
                   LEFT JOIN training_plans ON members.training_plan_id = training_plans.plan_id
                   LEFT JOIN trainers ON members.trainer_id = trainers.trainer_id
                   ";
                  $run = $conn->query($sql);

                  $results = $run->fetch_all(MYSQLI_ASSOC);
                  $members = $results;
                  foreach ($results as $result) : ?>
                      <tr>
                        <td> <?php echo $result['first_name'];?> </td>
                        <td> <?php echo $result['last_name'];?></td>
                        <td> <?php echo $result['email'];?></td>
                        <td> <?php echo $result['phone_number'];?></td>
                        <td> <?php echo $result['trainer_name'] == null ? "No trainer" : $result['trainer_name'];?></td>
                        <td> <img style="width 60px; height: 60px;" src="<?php echo $result['photo_path'];?>" alt="slika"></td>
                        <td> <?php echo $result['tp_name'] == null ? "No training plan" : $result['tp_name']?>
                        </td>
                        <td><a target = "_blank" href="<?php echo $result['access_card_pdf_path'];?>">Access Card</a></td>
                        <td> <?php echo date("F, jS Y",strtotime($result['created_at']));?></td>
                        <td>
                          
                        <form action="delete_members.php" method="post">
                          <input type="hidden" name="member_id" value="<?php echo $result['member_id'];?>">
                        <button>DELETE</button>
                        </form>
                      
                        </td>
                      </tr>
                  <?php endforeach; ?>
                </tbody>
        </table>
    </div>
  </div>
  <hr>
    <div class="row">             
      <div class = "col-md-12">
        <h2>Trainer List </h2>
        <a href="export.php?what=trainers" class="btn btn-success btn-sm mb-3">Export</a>
        <table class = "table table-striped">
                  <thead>
                    <tr>
                      <th>First name</th>
                      <th>Last name</th>
                      <th>Email</th>
                      <th>Phone number</th>
                      <th>Created at</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php 
                    $sql = "SELECT * FROM trainers";
                    $run = $conn->query($sql);

                    $results = $run->fetch_all(MYSQLI_ASSOC);
                    $trainers = $results;
                    foreach ($results as $result) : ?>
                        <tr>
                          <td> <?php echo $result['first_name'];?> </td>
                          <td> <?php echo $result['last_name'];?></td>
                          <td> <?php echo $result['email'];?></td>
                          <td> <?php echo $result['phone_number'];?></td>
                          <td> <?php echo date("F, jS Y",strtotime($result['created_at']));?></td>
                          <td>
                            
                          <form action="delete_trainers.php" method="post">
                            <input type="hidden" name="trainer_id" value="<?php echo $result['trainer_id'];?>">
                          <button>DELETE</button>
                          </form>
                        
                          </td>
                        </tr>
                    <?php endforeach; ?>
                  </tbody>
          </table>
        </div>
      </div>
    <hr>
    <div class="row">
      <div class="col-md-12">
        <h2>Plans List</h2>
        <a href="export.php?what=plans" class="btn btn-success btn-sm mb-3">Export</a>
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Plan Name</th>
              <th>Sessions</th>
              <th>Price</th>
              <th>Created At</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php 
              $sql = "SELECT * FROM training_plans";
              $run = $conn->query($sql);
              $results = $run->fetch_all(MYSQLI_ASSOC);
              $training_plans = $results;

              foreach($results as $result) : ?>
              <tr>
                <td><?php echo $result['name']?></td>
                <td><?php echo $result['sessions']?></td>
                <td><?php echo $result['price']?></td>
                <td><?php echo date("F, jS Y",strtotime($result['created_at']))?></td>
                <td>
                  <form action="delete_plans.php" method="POST">
                    <input type="hidden" name="plan_id" value="<?php echo $result['plan_id'];?>">
                    <button>DELETE</button>
                  </form>
                </td>
              </tr>

            <?php endforeach ?>    
            
          </tbody>
        </table>
      </div>
    </div>
    <hr>
    
    <div class = "row mb-5">
        <div class = "col-md-6">
          <h2>Register Member</h2>
          <form action = "register_member.php" method = "POST" enctype="multipart/form-data">
            First Name: <input class = "form-control" type = "text" name = "first_name"><br>
            Last Name: <input class = "form-control" type = "text" name = "last_name"><br>
            Email: <input class = "form-control" type = "email" name = "email"><br>
            Phone Number: <input class = "form-control" type = "text" name = "phone"><br>
            Training Plan:
            <select class = "form-control" name = "training_plan_id">
              <option value="" disabled selected>Training plan</option>
              <?php
                $sql = "SELECT * FROM training_plans";
                $run = $conn->query($sql);
                $results = $run->fetch_all(MYSQLI_ASSOC);
                
                foreach($results as $result){
                  echo "<option value = '". $result['plan_id'] ."'> ". $result['name'] ." </option>";
                }
               ?>
            </select><br>
            <input type="hidden" name="photo_path" id = "photoPathInput">
            <div id="dropzone-upload" class="dropzone"></div>

            <input class="btn btn-primary mt-3" type="submit" value="Register Member">
          </form>
        </div>

        <div class="col-md-6">
          <h2>Register Trainer</h2>
          <form action="register_trainer.php" method="post">
            First Name: <input class = "form-control" type = "text" name = "first_name"><br>
            Last Name: <input class = "form-control" type = "text" name = "last_name"><br>
            Email: <input class = "form-control" type = "email" name = "email"><br>
            Phone Number: <input class = "form-control" type = "text" name = "phone"><br>
            <input class="btn btn-primary mt-3" type="submit" value="Register Trainer">
          </form>
        </div>
      </div>
    
    <div class="row mb-5">
      <div class="col-md-12">
        <h2>Create a plan</h2>
        <form action="create_plan.php" method="post">
            Name: <input class = "form-control" type = "text" name = "name"><br>
            Sessions: <input class = "form-control" type = "number" name = "sessions"><br>
            Price: <input class = "form-control" type = "text" name = "price"><br>
            <input class="btn btn-primary mt-3" type="submit" value="Create Plan">
        </form>
      </div>
    </div>  

    <div class="row mb-5">
        <div class="col-md-6">
          <h2>Assign Trainer</h2>
          <form action="assign_trainer.php" method="POST">
            <label for="">Select Member</label>
            <select name="member" class="form-control">
              <?php 
              foreach($members AS $member){
                echo "<option value = '". $member['member_id'] ."'> ". $member['first_name'] . " " . $member['last_name'] ." </option>";
              }
              ?>
            </select>
            <br>
            <label for="">Select Trainer</label>
            <select name="trainer" class="form-control">
              <?php 
              foreach($trainers as $trainer){
                echo "<option value = '". $trainer['trainer_id'] ."'> ". $trainer['first_name'] . " " . $trainer['last_name'] ." </option>";
              }
              ?>
            </select>

            <button type="submit" class="btn btn-primary mt-3">Assign</button>
          </form>
        </div>
        <div class="col-md-6">
          <h2>Assign/Change Plan</h2>
          <form action="assign_plan.php" method="post">
            <label for=""> Select Member</label>
            <select name="member" class="form-control">
              <?php 
              foreach($members AS $member){
                echo "<option value = '". $member['member_id'] ."'> ". $member['first_name'] . " " . $member['last_name'] ." </option>";
              }
              ?>
            </select>
            <br>
            <label for="">Select Plan</label>
            <select name="plan" class="form-control">
              <?php 
              foreach($training_plans AS $plan){
                echo "<option value = '". $plan['plan_id'] ."'> ". $plan['name'] ." </option>";
              }
              ?>
            </select>
            
            <button type="submit" class="btn btn-primary mt-3">Assign</button>
          </form>
        </div>
    </div>
</div>
<?php
  $conn->close();
?>

<script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<script>
   Dropzone.options.dropzoneUpload = {
        url: "upload_photo.php",
        paramName: "photo",
        maxFilesize: 20,
        acceptedFiles: "image/*",
        init: function () {
          this.on("success", function (file, response) {
            const jsonResponse = JSON.parse(response);
            if (jsonResponse.success) {
              document.getElementById('photoPathInput').value = jsonResponse.photo_path;
            } else{
              console.error(jsonResponse.error);
            }
          });
        }
      }
</script>
</body>
</html>