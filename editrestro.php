<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	if(!isset($_SESSION['resName']) || isset($_SESSION['username']))
		header('location: index.php');
		
	$msg2 = "";
	$msg3 = "";
	
	$retrieve = "SELECT * FROM `RESTAURANTS` WHERE `resEmail` = '$_SESSION[email]'";
	$res = mysqli_query($dbc, $retrieve);
	$row = mysqli_fetch_assoc($res);
	
	if(isset($_POST['update'])){
		$update = "UPDATE `RESTAURANTS` SET `resName` = '$_POST[resName]', `resLocation` = '$_POST[resLocation]', `resContact` = '$_POST[resContact]' WHERE `resEmail` = '$_SESSION[email]'";
		$req = mysqli_query($dbc, $update);
		
		if($req){
			$_SESSION['resName'] = $_POST['resName'];
			$msg2 = "Profile updated!";
		} else{
			$msg2 = "Could not update profile";
		}
	}
	
	if(isset($_POST['updatepass'])){
		$updatepass = "UPDATE `RESTAURANTS` SET `resPass` = SHA1('$_POST[resPass]') WHERE `resEmail` = '$_SESSION[email]'";
		$r = mysqli_query($dbc, $updatepass);
		
		if($r){
			$msg3 = "Password updated!";
		} else{
			$msg3 = "Could not update password";
		}
	}
	
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-    +0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//  ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Restaurant Registration</title>
	<script type="text/javascript">
		var c=0,d=0,pas;
		
		function password(){
			pas = document.getElementById("resPass").value;
			if(pas.length < 8){
				document.getElementById("err_pass").innerHTML = "Password must have atleast 8 characters";
				c=0;
			} else{
				document.getElementById("err_pass").innerHTML = "";
				c=1;
			}
		}
		function cnfpassword(){
			var cnfpas = document.getElementById("resCnfPass").value;
			if(cnfpas != pas){
				document.getElementById("err_cnfpass").innerHTML = "Password do not match";
				d=0;
			}else{
				document.getElementById("err_cnfpass").innerHTML = "";
				d=1;
			}
			disableBtn();
		}
		function disableBtn(){
			if(c==1 && d==1){
				document.getElementById("updatepass").disabled = false;
			}else{
				document.getElementById("updatepass").disabled = true;
			}
		}
	</script>
</head>
<body onload="disableBtn()">
	<div id="header">
		<h2>Foodshala</h2>
		<div id="logout"><a href="logout.php">Logout</a></div>
		<div id="editprofile"><a href="menu.php">Menu</a></div>
	</div>
	<br /><br />
	<header id="center_maker">
		<h1>Welcome <?php echo $_SESSION['resName']; ?></h1>
		<h3>Update Profile</h3>
	</header>
	<div id="updateform">
		<br /><br />
		<form action="editrestro.php" method="POST">
			<input type="text" class="form-control" name="resName" id="resName" placeholder="Restaurant name*" value="<?php if(isset($row))echo $row['resName']; ?>" required />
			<input type="text" class="form-control" name="resLocation" id="resLocation" placeholder="Restaurant location*" value="<?php if(isset($row))echo $row['resLocation']; ?>" required />
			<input type="number" class="form-control" name="resContact" id="resContact" placeholder="Restaurant contact number*" value="<?php if(isset($row))echo $row['resContact']; ?>" required />
			<input type="submit" name="update" id="update" value="Update" class="btn btn-primary" />
		</form>
		<div id="success_msg"><?php echo $msg2; ?></div>
    </div>
	<div id="passupdate" style="margin-top:-260px;">
		<form action="editrestro.php" method="POST">
			<input type="password" class="form-control" name="resPass" id="resPass" placeholder="Password*" onkeyup="password()" required />
			<div id="err_pass"></div>
			<input type="password" class="form-control" name="resCnfPass" id="resCnfPass" placeholder="Confirm password*" onkeyup="cnfpassword()" required />
			<div id="err_cnfpass"></div>
			<input type="submit" name="updatepass" id="updatepass" value="Update password" class="btn btn-primary" />
		</form>
		<div id="success_msg"><?php echo $msg3; ?></div>
	</div>
</body>
</html>