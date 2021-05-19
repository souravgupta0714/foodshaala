<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	if(!isset($_SESSION['resName']) || isset($_SESSION['username']))
		header('location: index.php');
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
    <title>Orders</title>
</head>
<body>
	<div id="header">
		<h2>Foodshala</h2>
		<div id="logout"><a href="logout.php">Logout</a></div>
		<div id="editprofile"><a href="addmenuitem.php">Add menu item</a></div>
	</div>
	<div id="center_maker">
		<br /><br />
		<header>
			<h1>Welcome <?php echo $_SESSION['resName']; ?></h1>
			<h3>Your order history</h3>
		</header>
		<br /><br />
		<?php
			$view = "SELECT `ADDITEM`.`INAME` AS iname, `ADDITEM`.`IPRICE` AS iprice, `CONFIRMORDER`.`DATE` AS date, `CUSTOMERS`.`name` as name FROM `ADDITEM` INNER JOIN `CONFIRMORDER` ON `ADDITEM`.`ID` = `CONFIRMORDER`.`FOODID` INNER JOIN `CUSTOMERS` ON `CUSTOMERS`.`email` = `CONFIRMORDER`.`BUYER` WHERE `CONFIRMORDER`.`SELLER` = '$_SESSION[email]'";
			$q = mysqli_query($dbc, $view);
			
			$count = mysqli_num_rows($q);
			if($count > 0){
				echo "<table class='table'>
						<tr>
							<th>Item name</th>
							<th>Price( in <i class='fa fa-inr'></i> )</th>
							<th>Customer</th>
							<th>Date</th>
						 </tr>
				";
				while($row = mysqli_fetch_assoc($q)){
					echo "<tr>
							<td>".$row['iname']."</td>
							<td>".$row['iprice']."</td>
							<td>".$row['name']."</td>
							<td>".$row['date']."</td>
						 </tr>";
				}
				echo "</table>";
			} else{
				echo "<div id='info'>You do not have any order history yet.</div>";
			}
		?>
	</div>
</body>
</html>