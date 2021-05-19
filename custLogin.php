<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	if(isset($_SESSION['resName']))
		header('location: addMenuItem.php');
	else if (isset($_SESSION['username']))
		header('location: menu.php');
	
	$msg="";
	if(isset($_POST['login']))
	{
		$q = "SELECT * FROM `customers` WHERE `email` = '$_POST[email]' AND `password` = SHA1('$_POST[password]')";
		$r = mysqli_query($dbc, $q);
		$row = mysqli_fetch_assoc($r);
		if(mysqli_num_rows($r) == 1)
		{
			$_SESSION['useremail'] = $row['email'];
			$_SESSION['username'] = $row['name'];
			header('location: menu.php');
		}
		else
			$msg = "WRONG USERNAME OR PASSWORD!";
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
    <title>Customer Login</title>
</head>
<body>
	<div id="header">
		<h2>Foodshala</h2>
	</div>
	<div id="center_maker">
		<br /><br />
		<h1>Customer Login</h1>
		<div id="custLogin">
			<form action="custLogin.php" method="POST">
				<input type="email" class="form-control" name="email" id="resEmail" placeholder="Email*" required />
				<input type="password" class="form-control" name="password" id="resPass" placeholder="Password*" required />
				<div id="error_msg"><?php echo $msg ?></div>
				<input type="submit" name="login" id="register" value="Login" class="btn btn-primary" />
			</form>
			Don't have an account? <a href="custRegister.php">Register here</a>
		</div>
	</div>
</body>
</html>