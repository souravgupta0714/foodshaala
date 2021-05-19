<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	if(!isset($_SESSION['username']) || isset($_SESSION['resName']))
		header('location: addMenuItem.php');
		
	$msg2="";
	$msg3="";

	$retrieve = "SELECT * FROM `CUSTOMERS` WHERE `EMAIL` = '$_SESSION[useremail]'";
	$res = mysqli_query($dbc, $retrieve);
	$row = mysqli_fetch_assoc($res);
	
	if(isset($_POST['update'])){
		$update = "UPDATE `CUSTOMERS` SET `name` = '$_POST[custName]', `contact` = '$_POST[custContact]', `address` = '$_POST[custAddress]', `preference` = '$_POST[preference]' WHERE `email` = '$_SESSION[useremail]'";
		$req = mysqli_query($dbc, $update);
		
		if($req){
			$_SESSION['username'] = $_POST['custName'];
			$msg2 = "Profile updated!";
		} else{
			$msg2 = "Could not update profile";
		}
	}
	
	if(isset($_POST['updatepass'])){
		$updatepass = "UPDATE `CUSTOMERS` SET `password` = SHA1('$_POST[custPass]') WHERE `email` = '$_SESSION[useremail]'";
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
    <title>Menu</title>
	<script type="text/javascript">
		var pas,c=0,d=0;
		
		function password(){
			pas = document.getElementById("resPass").value;
			if(pas.length < 8){
				document.getElementById("err_pass").innerHTML = "Password must have atleast 8 characters";
				c=0;
			} else{
				document.getElementById("err_pass").innerHTML = "";
				c=1;
			}
			disableBtn();
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
				document.getElementById('updatepass').disabled = false;
			} else{
				document.getElementById('updatepass').disabled = true;
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
	</div>
	<br /><br /><br />
	<div id="center_maker"><h3>Update Profile</h3></div>
	</header>
	<div id="updateform">
		<br /><br />
		<form action="editprofile.php" method="POST">
			<input type="text" class="form-control" name="custName" id="resName" placeholder="Name*" value="<?php if(isset($row))echo $row['name']; ?>" required />
			<input type="number" class="form-control" name="custContact" id="resContact" placeholder="Contact number*" value="<?php if(isset($row))echo $row['contact'];?>"required />
			<input type="text" class="form-control" name="custAddress" id="custAddress" placeholder="Address*" value="<?php if(isset($row))echo $row['address']; ?>" required />
			<select name="preference" id="preference" class="form-control" required>
				<option value="">Preference</option>
				<option value="v">Veg</option>
				<option value="n">Non veg</option>
				<option value="b">Both</option>
			</select>
			<input type="submit" name="update" id="update" value="Update" class="btn btn-primary" />
		</form>
		<div id="success_msg"><?php echo $msg2; ?></div>
	</div>
	<div id="passupdate">
		<form action="editprofile.php" method="POST">
			<input type="password" class="form-control" name="custPass" id="resPass" placeholder="Password*" onkeyup="password()" required />
			<div style="margin-left:20px;" id="err_pass"></div>
			<input type="password" class="form-control" name="custCnfPass" id="resCnfPass" placeholder="Confirm password*" onkeyup="cnfpassword()" required />
			<div style="margin-left:20px;" id="err_cnfpass"></div>
			<input type="submit" name="updatepass" id="updatepass" value="Update password" class="btn btn-primary" />
		</form>
		<div id="success_msg"><?php echo $msg3; ?></div>
	</div>
</body>
</html>