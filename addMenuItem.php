<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	if(!isset($_SESSION['resName']) || isset($_SESSION['username']))
		header('location: index.php');
		
	$msg = "";

	if(isset($_POST['addItem']))
	{
		$target = "images/".basename($_FILES['itempic']['name']);
		$image = $_FILES['itempic']['name'];
		move_uploaded_file($_FILES['itempic']['tmp_name'], $target);
		
		$q = "INSERT INTO `ADDITEM`(`iname`, `iprice`, `itype`, `ipic`, `owner`) VALUES ('$_POST[item]', '$_POST[price]', '$_POST[type]', '$image', '$_SESSION[email]')";
		$r = mysqli_query($dbc, $q);
		if($r){
			$msg = "Item added successfully";
		} else{
			$msg = "Could not add item. Please try again";
		}
	}
	
	if(isset($_POST['del'])){
		$delQ = "DELETE FROM `additem` WHERE `additem`.`id` = '$_POST[idDel]'";
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
    <title>Add Menu Item</title>
</head>
<body>
	<div id="header">
		<h2>Foodshala</h2>
		<div id="logout"><a href="logout.php">Logout</a></div>
		<div id="editprofile"><a href="editrestro.php">Edit Profile</a></div>
		<div id="editprofile"><a href="vieworders.php">View Orders</a></div>
	</div>
	<br /><br />
	<div id="center_maker">
		<h1><?php echo $_SESSION['resName']; ?></h1>
	</div>
	<div id="menuform">
		<h3 style="margin-left:20px;">Add menu item</h3>
		<hr />
		<form action="addMenuItem.php" method="POST" enctype="multipart/form-data">
			<input type="text" class="form-control" name="item" id="itemname" placeholder="Item name*" required />
			<input type="number" class="form-control" name="price" id="itemprice" placeholder="Item price*" required />
			<select id="itemtype" class="form-control" name="type" required>
				<option value="">Select</option>
				<option value="v">Veg</option>
				<option value="n">Non veg</option>
			</select>
			<input type="file" class="form-control" id="itempic" name="itempic" />
			<input type="submit" name="addItem" id="register" value="Add item" class="btn btn-primary" />
		</form>
		<div id="success_msg" style="margin-left:20px;"><?php echo $msg; ?></div>
	</div>
	<div id="menu">
		<?php
			$ret = "SELECT `ADDITEM`.`ID` AS id, `ADDITEM`.`INAME` AS iname, `ADDITEM`.`IPRICE` AS iprice, `ADDITEM`.`ITYPE` AS itype, `ADDITEM`.`IPIC` AS ipic, `RESTAURANTS`.`RESNAME` AS resname FROM `ADDITEM` INNER JOIN `RESTAURANTS` ON `ADDITEM`.`OWNER` = `RESTAURANTS`.`resEmail` WHERE `ADDITEM`.`OWNER` = '$_SESSION[email]' ORDER BY `ADDITEM`.`ID` DESC";
			$qu = mysqli_query($dbc, $ret);
			
			$noi = mysqli_num_rows($qu);
			if($noi > 0){
			echo "<h3>Available dishes</h3><hr />
				<table class='table'>";
				while($showitem = mysqli_fetch_assoc($qu)){
					echo "<tr><th>".$showitem['iname']."<br /><br /><i class='fa fa-inr'></i> ".$showitem['iprice']."<br /><br />";
					if($showitem['itype'] == 'v'){
						echo "<div id='itypeVeg'>Veg</div><br />";
					} else {
						echo "<div id='itypeNVeg'>Non veg</div><br />";
					}
		?>
					<form action="addMenuItem.php" method="POST">
						<input type='submit' name='del' value='Delete' class='btn-danger' />
						<input type='hidden' name='idDel' value="<?php echo $showitem['id']; ?>"  />
					</form>
		<?php
					echo "</th><td><img src='images/".$showitem['ipic']."' height='300px' width='400px' alt='Image not available' /></td></tr>";
				}
				echo "</table>";
			}
		?>
	</div>
</body>
</html>