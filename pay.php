<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	if(!isset($_SESSION['total'])){
		header('location: menu.php');
	}
	if(!isset($_SESSION['username']) || isset($_SESSION['resName']))
		header('location: addMenuItem.php');
	
	$flag = 0;
	$msg="";
	$ret = "SELECT * FROM `CART` WHERE `BUYER` = '$_SESSION[useremail]'";
	$res = mysqli_query($dbc, $ret);
	$noi = mysqli_num_rows($res);
	
	date_default_timezone_set("Asia/Kolkata");
	$doj = date('d/m/y');
	
	if(isset($_POST['paymentBtn'])){
		while($row = mysqli_fetch_assoc($res)){
			$q = "INSERT INTO `CONFIRMORDER`(`foodid`, `buyer`, `seller`, `date`) VALUES('$row[foodid]', '$_SESSION[useremail]', '$row[seller]', '$doj')";
			$r = mysqli_query($dbc, $q);
			
			if($r){
				$flag += 1;
			}
		}
		if($noi == $flag){
			$msg = "Order placed successfully. Please keep <i class='fa fa-inr'></i> ".$_SESSION['total']." ready";
			$delQ = "DELETE FROM `cart` WHERE `buyer` = '$_SESSION[useremail]'";
			$delR = mysqli_query($dbc, $delQ);
		}
		$flag=0;
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Payment</title>
</head>
<body>
	<div id="header">
		<h2>Foodshala</h2>
		<div id="logout"><a href="logout.php">Logout</a></div>
		<div id="editprofile"><a href="editprofile.php">Edit Profile</a></div>
		<div id="editprofile"><a href="cart.php">My cart <i class="fa fa-shopping-cart" style="font-size:22px"></i></a></div>
		<div id="editprofile"><a href="menu.php">Menu</a></div>
	</div>
	<br /><br /><br />
	<div id="center_maker">
		<header>
			<h3>Payment</h3>
		</header>
		<br /><br />
		<form action="pay.php" method="POST">
			<input type='submit' name='paymentBtn' id='payment' value='Confirm Order' class='btn btn-primary' />
		</form>
		<div id="success_msg" style="margin-left:20px;"><?php echo $msg; ?></div>
	</div>
</body>
</html>