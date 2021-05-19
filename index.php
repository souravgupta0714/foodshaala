<?php
	include('dbconnect.php');
	include('style.php');
	
	session_start();
	
	if(isset($_SESSION['resName']))
		header('location: addMenuItem.php');
	else if (isset($_SESSION['username']))
		header('location: menu.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-    +0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//  ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
    <title>Home</title>
</head>
<body>
	<div id="header">
		<h2>Foodshala</h2>
		<div id="login">
			<a href="custlogin.php">Customer login</a>
			<a href="restlogin.php">Restaurant login</a>
		</div>
	</div>
	
	<div id="center_maker">
		<br /><br /><br />
		<?php
			$ret = "SELECT `ADDITEM`.`ID` AS id, `ADDITEM`.`INAME` AS iname, `ADDITEM`.`IPRICE` AS iprice, `ADDITEM`.`ITYPE` AS itype, `ADDITEM`.`OWNER` AS owner, `ADDITEM`.`IPIC` AS ipic, `RESTAURANTS`.`RESNAME` AS resname FROM `ADDITEM` INNER JOIN `RESTAURANTS` ON `ADDITEM`.`OWNER` = `RESTAURANTS`.`resEmail`  ORDER BY RAND()";
			$qu = mysqli_query($dbc, $ret);
			
			$noi = mysqli_num_rows($qu);
			if($noi > 0){
				echo "<div id='info'><a href='custLogin.php' style='text-decoration:none;'>Login</a> to order your food.<br/ ><br/ ><br/ ></div>";
				echo "<table class='table' style='margin-left:100px;'>";
				while($showitem = mysqli_fetch_assoc($qu)){
					echo "<tr><th>".$showitem['resname']."<br /><br />".$showitem['iname']."<br /><br /><i class='fa fa-inr'></i> ".$showitem['iprice']."<br /><br />";
					if($showitem['itype'] == 'v'){
						echo "<div id='itypeVeg'>Veg</div><br />";
					} else {
						echo "<div id='itypeNVeg'>Non veg</div><br />";
					}
					echo "</th><td><img src='images/".$showitem['ipic']."' height='200px' width='300px' alt='Image not available' /></td></tr>";
				}
				echo "</table>";
			} else{
				echo "<div id='info'>OOPS!! Looks like we have nothing for you now. Please visit in sometime.</div>";
			}
		?>
		
    </div>
</body>
</html>