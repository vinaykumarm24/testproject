<?php
session_start();
include('conn.php');

if(isset($_POST['login'])){
  $uname = $_POST['uname'];
  $pass = $_POST['pass'];
  $sql1 = "SELECT * from admin_user where name='$uname' and pass= '$pass'";
  $query1 = mysqli_query($conn,$sql1);
  $row = mysqli_num_rows($query1);
  if($row>0){
    $result = mysqli_fetch_assoc($query1);
    $level = $result['level'];
    $response = $result['response'];
    if($level == 'Teacher'){
      if($response == 'active'){
        $_SESSION['name'] = $result['name'];
        $_SESSION['pass'] = $result['pass'];
      header('location: admin_home.php');
      }
      else{
        echo "<span style='color:orange;'>sorry your account is currently under process! wait for superadmin's response</span>";
      }

    }
    if($level == 'superadmin'){
      $_SESSION['name'] = $result['name'];
      $_SESSION['pass'] = $result['pass'];
      header('location:superadmin.php');
    }
    if($level == 'Student'){
      if($response == 'active'){
        $_SESSION['name'] = $result['name'];
        $_SESSION['pass'] = $result['pass'];
      header('location:user_home.php');
      }
      else{
        echo "<span style='color:red;'>sorry your account is currently under process! wait for superadmin's response</span>";
      }


    }
  }
  else{
    echo "<span style='color:red;'>username or password is incorrect</span>";
  }
  

}
if(isset($_POST['signup'])){
  $name = $_POST['name'];
  $gender = $_POST['gender'];
  $contact = $_POST['contact'];
  $address = $_POST['address'];
  $level = $_POST['select'];
  $pass = $_POST['pass'];
  $filesize =  $_FILES['uploaded_file']['size'];
  $filetype =  $_FILES['uploaded_file']['name'];
  $filetype = explode(".",$filetype);
  $filetype = $filetype[1]; 


  
  if($filesize<250000){
    if($filetype == 'jpeg' || $filetype == 'jpg' || $filetype == 'png'){
      $path = "image/" . basename( $_FILES['uploaded_file']['name']); 
      move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path);
      $photo= basename( $_FILES['uploaded_file']['name']);

       $sql = "INSERT INTO admin_user(sno,name,gender,contact,address,photo,level,pass,time_date,response) VALUES(NULL, '$name','$gender', '$contact', '$address', '$photo', '$level', '$pass', NOW(),'inactive')";
      $query = mysqli_query($conn,$sql);
      if($query){
        echo "<span style='color:red'>you are currently in under process , you can not login untill aprovel by superadmin. if you are not selected in next 7 days , your registration will be rejected</span>";

  }
   else{
    echo "something went wrong please try again";
  }
    }
    else{
      echo "image filetype is wrong";
    }


  }
  else{
    echo "image size is larger then 250kb";
  }
  

 
 

}


?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Login or Signup</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
  <script>
  	function loginform(){
  		document.getElementById('form1').style.display='block';
  		document.getElementById('form2').style.display='none';
  	}
  	function signupform(){
  		document.getElementById('form1').style.display='none';
  		document.getElementById('form2').style.display='block';
  	}
  </script>
</head>
<body>
  <br>
<div class="container">
  <h2>This is a test website</h2>
  <br>
  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li class="nav-item">
      <a class="nav-link" href="homepage.php">Home</a>
    </li>
    <li class="nav-item">
      <a class="nav-link active" href="form.php">Superadmin/Admin/User Login</a>
    </li>
  </ul>

  <!-- Tab panes -->
<div class="tab-content">
    <div id="superadmin" class="container tab-pane active"><br>
    <div id="form1">
      <h3>Login-Form</h3>
      <form method="post" action="" class="login-form">
        Username: <input type="text" name="uname" required><br><br>
        Password: <input type="password" name="pass" required><br><br>
        <input type="submit" name="login" value="Login">
      </form>
      <p>Create a new account click here <input type="submit" onclick="signupform()" value="Signup"></p>
    </div>
<!-- signup form -->
	<div id="form2" style="display: none">
	  <h3>Signup-Form</h3>
      <form method="post" action=""  enctype="multipart/form-data" class="login-form">
        Name: <input type="text" name="name" required><br><br>
        Gender: <input type="radio" name="gender" value="male">Male 
                <input type="radio" name="gender" value="female" required>Female 
                <input type="radio" name="gender" value="other" required>other<br><br>
        Contact: <input type="tel" pattern="[0-9]{10}" name="contact" required> enter 10 digit mobile no<br><br>
        Address:  <textarea name="address" required></textarea><br><br>
        Photo: <input type="file" name="uploaded_file" required><br><br>
        Teacher/Student: <select name="select" required>
        	<option disabled>choose option</option>
          <option>Student</option>
        	<option>Teacher</option>
        	
        </select><br><br>
        Password: <input type="password" name="pass" required><br><br>
        <input type="submit" name="signup" value="Signup">
      </form>
      <p>Already have an account click here <input type="submit" onclick="loginform()" value="Login"></p>
    </div>
      
    </div>
  </div>
</div>


</body>
</html>
