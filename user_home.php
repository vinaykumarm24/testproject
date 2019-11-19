<?php
session_start();
include 'conn.php';
if(isset($_SESSION['name'])){
$name = $_SESSION['name'];
$pass = $_SESSION['pass'];
$sql2 = "SELECT * FROM admin_user where name = '$name' and pass='$pass' ";
$query2 = mysqli_query($conn, $sql2);
$data2 = mysqli_fetch_assoc($query2);
 }
 else{
  header('location:form.php');
 }

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>test website-user</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>
  <br>
<div class="container">
  <h2>This is a test website</h2>
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link active" data-toggle="tab" href="#home">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" data-toggle="tab" href="#profile">My Profile</a>
    </li>
     <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
    <!-- <li class="nav-item">
      <a class="nav-link"  href="superadmin.php">Superadmin</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="form.php">Admin/User</a>
    </li> -->
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane active"><br>
      <h3>WELCOME</h3>
        <p>You are user: <?php echo $name; ?></p>
      <?php
          $sql1 = "SELECT * FROM blog order by sno DESC ";
          $query1 = mysqli_query($conn, $sql1);
          while ($data = mysqli_fetch_assoc($query1)) {
            
      ?>
      <img src="image/<?php  echo $data['image']?>" style="height: 350px; width:450px">
      <h4><?php  echo $data['content']?></h4><p>Posted by:- <?php  echo $data['by_post'].', Date: '. $data['date_t']?></p>
      <?php  }?>
    </div>
     <div id="profile" class="container tab-pane fade"><br>
      <h3>Profile</h3>
      <?php

      ?>
      <img src="image/<?php echo $data2['photo'] ?>" style="height: 250px; width:250px">
      <p>name: <?php echo $data2['name'] ?></p>
      <p>Gender: <?php echo $data2['gender'] ?></p>
      <p>Contact: <?php echo $data2['contact'] ?></p>
      <p>Address: <?php echo $data2['address'] ?></p>
     
      <form method="post" action="edit_profile.php" enctype="multipart/form-data" action="">
        <input type='hidden' name='sno' value="<?php $_SESSION['sno']=$data2['sno']?>">
        <input type="submit" name="edit" value="Edit Profile">

      </form>
    </div>
    
  </div>
</div>


</body>
</html>
