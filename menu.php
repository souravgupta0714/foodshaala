<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	if(!isset($_SESSION['username']) || isset($_SESSION['resName']))
		header('location: addMenuItem.php');
		
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
    <title>Menu</title>
</head>
<body>
	<div id="header">
		<h2>Foodshala</h2>
		<div id="login" style="margin:0px 0px 0px 0px;">
			<div id="logout"><a href="logout.php">Logout</a></div>
			<div id="editprofile"><a href="editprofile.php">Edit Profile</a></div>
			<div id="editprofile"><a href="cart.php">My cart <i class="fa fa-shopping-cart" style="font-size:22px"></i></a></div>
			<div id="editprofile"><a href="myorders.php">My Orders</a></div>
		</div>
	</div>
	<br /><br />
	<div id="center_maker">
		<header>
			<h1>Welcome <?php echo $_SESSION['username']; ?></h1>
			<h3>Today's Menu</h3>
		</header>
		<br /><br />
		<?php
			$cat = "SELECT * FROM `CUSTOMERS` WHERE `PREFERENCE` = 'b' AND `EMAIL`='$_SESSION[useremail]'";
			$res = mysqli_query($dbc, $cat);
			$row = mysqli_fetch_assoc($res);
			
			if($row['preference'] == 'b'){
				$ret = "SELECT `ADDITEM`.`ID` AS id, `ADDITEM`.`INAME` AS iname, `ADDITEM`.`IPRICE` AS iprice, `ADDITEM`.`ITYPE` AS itype, `ADDITEM`.`OWNER` AS owner, `CUSTOMERS`.`PREFERENCE` as pref, `ADDITEM`.`IPIC` AS ipic, `RESTAURANTS`.`RESNAME` AS resname FROM `ADDITEM` INNER JOIN `RESTAURANTS` ON `ADDITEM`.`OWNER` = `RESTAURANTS`.`resEmail` INNER JOIN `CUSTOMERS` ON `CUSTOMERS`.`PREFERENCE` <> `ADDITEM`.`ITYPE` where `CUSTOMERS`.`EMAIL`='$_SESSION[useremail]' ORDER BY RAND()";
				$qu = mysqli_query($dbc, $ret);
				
				$noi = mysqli_num_rows($qu);
				if($noi > 0){
					echo "<div id='info'>You are being shown the menu according to your preference. You can change your preference in \"Edit Profile\" section<br/ ><br/ ><br/ ></div>";
					echo "<table class='table' style='margin-left:100px;'>";
					while($showitem = mysqli_fetch_assoc($qu)){
						echo "<tr><th>".$showitem['resname']."<br /><br />".$showitem['iname']."<br /><br /><i class='fa fa-inr'></i> ".$showitem['iprice']."<br /><br />";
						if($showitem['itype'] == 'v'){
							echo "<div id='itypeVeg'>Veg</div><br />";
						} else {
							echo "<div id='itypeNVeg'>Non veg</div><br />";
						}
			?>
						<form action="menu.php" method="POST">
							<input type='submit' name='addtocart' value='Add to cart' class='btn btn-primary' />
							<input type='hidden' name='idstore' value="<?php echo $showitem['id']; ?>"  />
							<input type='hidden' name='ownerstore' value="<?php echo $showitem['owner']; ?>"  />
						</form>
			<?php
						echo "</th><td><img src='images/".$showitem['ipic']."' height='200px' width='300px' alt='Image not available' /></td></tr>";
					}
					echo "</table>";
				} else{
					echo "<div id='info'>OOPS!! Looks like we have nothing for you now. Please visit in sometime.</div>";
				}
			}
			else{
				$ret = "SELECT `ADDITEM`.`ID` AS id, `ADDITEM`.`INAME` AS iname, `ADDITEM`.`IPRICE` AS iprice, `ADDITEM`.`ITYPE` AS itype, `ADDITEM`.`OWNER` AS owner, `CUSTOMERS`.`PREFERENCE` as pref, `ADDITEM`.`IPIC` AS ipic, `RESTAURANTS`.`RESNAME` AS resname FROM `ADDITEM` INNER JOIN `RESTAURANTS` ON `ADDITEM`.`OWNER` = `RESTAURANTS`.`resEmail` INNER JOIN `CUSTOMERS` ON `CUSTOMERS`.`PREFERENCE` = `ADDITEM`.`ITYPE` where `CUSTOMERS`.`EMAIL`='$_SESSION[useremail]' ORDER BY RAND()";
				$qu = mysqli_query($dbc, $ret);
				
				$noi = mysqli_num_rows($qu);
				if($noi > 0){
					echo "<div id='info'>You are being shown the menu according to your preference. You can change your preference in \"Edit Profile\" section<br/ ><br/ ><br/ ></div>";
					echo "<table class='table'>";
					while($showitem = mysqli_fetch_assoc($qu)){
						echo "<tr><th>".$showitem['resname']."<br /><br />".$showitem['iname']."<br /><br /><i class='fa fa-inr'></i> ".$showitem['iprice']."<br /><br />";
						if($showitem['itype'] == 'v'){
							echo "<div id='itypeVeg'>Veg</div><br />";
						} else {
							echo "<div id='itypeNVeg'>Non veg</div><br />";
						}
			?>
						<form action="menu.php" method="POST">
							<input type='submit' name='addtocart' value='Add to cart' class='btn btn-primary' />
							<input type='hidden' name='idstore' value="<?php echo $showitem['id']; ?>"  />
							<input type='hidden' name='ownerstore' value="<?php echo $showitem['owner']; ?>"  />
						</form>
			<?php
						echo "</th><td><img src='images/".$showitem['ipic']."' height='200px' width='300px' alt='Image not available' /></td></tr>";
					}
					echo "</table>";
				}
				else{
					echo "<div id='info'>OOPS!! Looks like we have nothing for you now. Please visit in sometime.</div>";
				}
			}
			
		?>
	</div>
</body>
</html>
<?php
	if(isset($_POST['addtocart'])){
		$q = "INSERT INTO `CART`(`foodid`, `buyer`, `seller`) VALUES('$_POST[idstore]', '$_SESSION[useremail]' ,'$_POST[ownerstore]')";
		$r = mysqli_query($dbc, $q);
		
		if($r){
?>
			<script type="text/javascript">
				alert("Added to cart!");
			</script>
<?php
		} else{
?>
			<script type="text/javascript">
				alert("Cannot add to cart :(");
			</script>
<?php
		}
	}
?>