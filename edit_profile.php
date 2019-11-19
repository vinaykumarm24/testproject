<?php
session_start();
include 'conn.php';
if (isset($_SESSION['sno'])) {
	$sno = $_SESSION['sno'];
	$sql = "SELECT * FROM admin_user where sno = '$sno'";
	$query = mysqli_query($conn, $sql);
	$data = mysqli_fetch_assoc($query);
	
 }
 
else{
  header('location:form.php');
 }

	if(isset($_POST['img_save'])){
		$photo= basename( $_FILES['uploaded_file']['name']);
		if(!empty($photo)){
			$filesize =  $_FILES['uploaded_file']['size'];
  			$filetype =  $_FILES['uploaded_file']['name'];
  			$filetype = explode(".",$filetype);
  			$filetype = $filetype[1]; 
  			if($filesize<250000){
   			 if($filetype == 'jpeg' || $filetype == 'jpg' || $filetype == 'png'){
     			 $path = "image/" . basename( $_FILES['uploaded_file']['name']); 
     			 move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path);
     			 $photo= basename( $_FILES['uploaded_file']['name']);
				 $sql1 = "UPDATE admin_user SET photo ='$photo' where sno='$sno'";
				 $query1 = mysqli_query($conn,$sql1);
				 if($query){
				 	echo "<span style=color:green>profile picture updated succesfully</span>";
				 }
				 else{
				 	echo "<span style=color:red>something went wrong try again</span>";
				 }

				}
				else{
					echo "filetype is wrong";
				}
			}
			else{
					echo "filesize too large";
				}
			}
			else{
					echo "no file selected";
				}
		
		
	}
	if (isset($_POST['name'])) {
		$name = $_POST['edit_name'];
		$sql = "UPDATE admin_user SET name ='$name' where sno='$sno'";
		$query = mysqli_query($conn,$sql);
		if($query){
			echo "<span style=color:green>profile name updated succesfully</span>";
			}
		else{
			echo "<span style=color:red>something went wrong try again</span>";
			}
	}
	if (isset($_POST['contact'])) {
		$contact = $_POST['edit_contact'];
		$sql = "UPDATE admin_user SET contact ='$contact' where sno='$sno'";
		$query = mysqli_query($conn,$sql);
		if($query){
			echo "<span style=color:green>profile contact updated succesfully</span>";
			}
		else{
			echo "<span style=color:red>something went wrong try again</span>";
			}
	}
	if (isset($_POST['address'])) {
		$address = $_POST['edit_address'];
		$sql = "UPDATE admin_user SET address ='$address' where sno='$sno'";
		$query = mysqli_query($conn,$sql);
		if($query){
			echo "<span style=color:green>profile address updated succesfully</span>";
			}
		else{
			echo "<span style=color:red>something went wrong try again</span>";
			}
	}
	if (isset($_POST['gender'])) {
		$gender = $_POST['edit_gender'];
		$sql = "UPDATE admin_user SET gender ='$gender' where sno='$sno'";
		$query = mysqli_query($conn,$sql);
		if($query){
			echo "<span style=color:green>profile gender updated succesfully</span>";
			}
		else{
			echo "<span style=color:red>something went wrong try again</span>";
			}
	}




?>
<!DOCTYPE html>
<html>
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
  		<?php if($data['level']=='superadmin'){echo '<a class="nav-link" href="superadmin.php">Home</a>';}
  				elseif ($data['level']=='Teacher') {
  					echo '<a class="nav-link" href="admin_home.php">Home</a>';
  				}
  				else{
  					echo '<a class="nav-link" href="user_home.php">Home</a>';
  				}

  		 ?>
      
    </li>
   
    <li class="nav-item">
      <a class="nav-link" href="logout.php">Logout</a>
    </li>
   
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">
    
 	<div id="profile" class="container tab-pane active"><br>
      <h3>Edit Profile</h3>
      
      <form method="post" action="" enctype="multipart/form-data" >
      <img src="image/<?php echo $data['photo'] ?>" style="height: 250px; width:250px"><br><input type="file" name="uploaded_file" ><input type="submit" name="img_save" value="save"><br><br>
      <p>name: <?php echo $data['name'] ?> &nbsp;&nbsp; <input type="text" name="edit_name" placeholder="Edit name">&nbsp;<input type="submit" name="name" value="save"></p>
      <p>Gender: <?php echo $data['gender'] ?>&nbsp;&nbsp; <input type="radio" name="edit_gender" value="male">Male<input type="radio" name="edit_gender" value="female">Female<input type="radio" name="edit_gender" value="other">Other&nbsp;<input type="submit" name="gender" value="save"></p>
      <p>Contact: <?php echo $data['contact'] ?>&nbsp;&nbsp; <input type="tel" pattern="[0-9]{10}" name="edit_contact" placeholder="Edit Contact">enter 10 digit mobile no&nbsp;<input type="submit" name="contact" value="save"></p>
      <p>Address: <?php echo $data['address'] ?>&nbsp;&nbsp; <textarea name="edit_address"  placeholder="Edit Address"></textarea>&nbsp;<input type="submit" name="address" value="save"></p>
     

      </form>
    </div>
</body>
</html>