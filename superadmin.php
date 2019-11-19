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
  <title>test website superadmin</title>
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
      <a class="nav-link" data-toggle="tab" href="#home">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link  active"  data-toggle="tab" href="#new_users">Users Status</a>
    </li>
     <li class="nav-item">
      <a class="nav-link"  data-toggle="tab" href="#profile">My Profile</a>
    </li>
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
   
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    <div id="home" class="container tab-pane fade"><br>
      <h3>HOME</h3>
        <p>You are Superadmin: <?php echo $name; ?></p>
      <?php
          $sql1 = "SELECT * FROM blog order by sno DESC ";
          $query1 = mysqli_query($conn, $sql1);
          while ($data = mysqli_fetch_assoc($query1)) {
            
      ?>
      <img src="image/<?php  echo $data['image']?>" style="height: 350px; width:450px">
      <h4><?php  echo $data['content']?></h4><p>Posted by:- <?php  echo $data['by_post'].', Date: '. $data['date_t']?></p>
      <?php  }?>
    </div>
      <div id="new_users" class="container tab-pane active"><br>
      <h3>New User</h3>
      <table border="1" width="100%">
        <tr>
          <th>Name</th>
          <th>Gender</th>
          <th>Contact no</th>
          <th>Address</th>
          <th>Teacher/Student</th>
          <th>Registration date</th>
          <th>status</th>
          <th>Response</th>
        </tr>
        <?php 
          if(isset($_POST['action'])){
            $action = $_POST['action'];
            $id = $_POST['id'];
            $update = "UPDATE admin_user SET response = '$action' where sno = '$id' ";
            $query2 = mysqli_query($conn,$update);

          }
          $sql = "SELECT * FROM admin_user where level!='superadmin' order by sno DESC ";
          $query = mysqli_query($conn, $sql);
          while ($result = mysqli_fetch_assoc($query)) {
            
        ?>
        <tr>
          <td><?php  echo $result['name']?> </td>
          <td><?php  echo $result['gender']?></td>
          <td><?php  echo $result['contact']?></td>
          <td><?php  echo $result['address']?></td>
          <td><?php  echo $result['level']?></td>
          <td><?php  echo $result['time_date']?></td>
          <td><?php  echo $result['response']?></td>
          <td><?php  if($result['response']=='active'){echo "inactive";} 
                    else{echo "<form method='post'><input type='hidden' name='id' value='".$result['sno']."'><input type='submit' name='action' value='active'></form>";}?></td>

        </tr>
         <?php }        ?>
      </table>

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
