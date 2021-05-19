<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	$msg="";
	$total=0;
	if(!isset($_SESSION['username']) || isset($_SESSION['resName']))
		header('location: addMenuItem.php');
		
	if(isset($_POST['del'])){
		$delQ = "DELETE FROM `cart` WHERE `id` = '$_POST[idDel]'";
		$delR = mysqli_query($dbc, $delQ);
		if($delR){
			$msg = "Item deleted successfully";
		} else{
			$msg = "Could not delete the item";
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
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Cart</title>
</head>
<body>
	<div id="header">
		<h2>Foodshala</h2>
		<div id="logout"><a href="logout.php">Logout</a></div>
		<div id="editprofile"><a href="editprofile.php">Edit Profile</a></div>
		<div id="editprofile"><a href="menu.php">Menu</a></div>
	</div>
	<div id="center_maker">
		<br /><br />
		<header>
			<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
			<h3>Cart <i class="fa fa-shopping-cart" style="font-size:30px;color:red"></i></h3>
		</header>
		<br /><br />
		<div id="success_msg" style="margin-left:20px;"><?php echo $msg; ?></div><br />
		<?php
			$ret = "SELECT `CART`.`ID` AS id, `CART`.`FOODID` AS foodid, `CART`.`SELLER` AS seller, `ADDITEM`.`INAME` AS iname, `ADDITEM`.`iprice` AS iprice, `ADDITEM`.`ITYPE` AS itype, `ADDITEM`.`IPIC` AS ipic, `RESTAURANTS`.`resName` AS resName FROM `CART` INNER JOIN `RESTAURANTS` ON `cart`.`seller` = `RESTAURANTS`.`resEmail` INNER JOIN `ADDITEM` ON `CART`.`FOODID` = `ADDITEM`.`ID` WHERE `CART`.`BUYER` = '$_SESSION[useremail]'";
			$qu = mysqli_query($dbc, $ret);
			
			$noi = mysqli_num_rows($qu);
				if($noi > 0){
					echo "<table class='table' style='margin-left:100px;'>";
					while($showitem = mysqli_fetch_assoc($qu)){
						echo "<tr><th>".$showitem['iname']."<br /><br /><i class='fa fa-inr'></i> ".$showitem['iprice']."<br /><br />".$showitem['resName']."<br /><br />";
						if($showitem['itype'] == 'v'){
							echo "<div id='itypeVeg'>Veg</div><br />";
						} else {
							echo "<div id='itypeNVeg'>Non veg</div><br />";
						}
			?>
						<form action="cart.php" method="POST">
							<input type='submit' name='del' value="Remove from cart" class='btn btn-danger' />
							<input type='hidden' name='idDel' value="<?php echo $showitem['id']; ?>"  />
							<input type='hidden' name='sellerstore' value="<?php echo $showitem['seller']; ?>"  />
						</form>
						
			<?php
						echo "</th><td><img src='images/".$showitem['ipic']."' height='200px' width='300px' alt='Image not available' /></td></tr>";
						$total += (int)$showitem['iprice'];
					}
					$_SESSION['total'] = $total;
					echo "</table>
					
						<a href='pay.php' style='margin-bottom:50px;' class='btn btn-primary'>Your Total bill is  <b><i class='fa fa-inr'></i> ".$total."</a>";
				} else{
					echo "<div id='info'>OOPS!! Looks like you have not added anything in your cart.</div>";
				}
		?>
		
	</div>
</body>
</html>