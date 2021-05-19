<?php
	include('style.php');
	include('dbconnect.php');
	session_start();
	
	if(isset($_SESSION['resName']))
		header('location: addMenuItem.php');
	else if (isset($_SESSION['username']))
		header('location: menu.php');
		
    $msg="";
	if(isset($_POST['register']))
    {
        $regQuery = "INSERT INTO `RESTAURANTS`(`resName`, `resLocation`, `resContact`, `resEmail`, `resPass`) VALUES('$_POST[resName]', '$_POST[resLocation]', '$_POST[resContact]', '$_POST[resEmail]', SHA1('$_POST[resPass]'))";
        $post = mysqli_query($dbc, $regQuery);

        if($post){
            header('location: restLogin.php');
        } else{
            $msg="Email is already linked with a restaurant. Kindly use another email";
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
</head>
<body onload="disableBtn()">
	<div id="header">
		<h2>Foodshala</h2>
	</div>
    <div id="center_maker">
		<br /><br />
        <h1>Restaurant Registration</h1>
        <div id="restReg">
            <form action="restroRegister.php" method="POST">
                <input type="text" class="form-control" name="resName" id="resName" placeholder="Restaurant name*" onkeyup="validateName()" required />
				<div id="err_name"></div>
                <input type="text" class="form-control" name="resLocation" id="resLocation" placeholder="Restaurant location*" required />
                <input type="number" class="form-control" name="resContact" id="resContact" placeholder="Restaurant contact number*" onkeyup="validateContact()"  required />
				<div id="err_contact"></div>
                <input type="email" class="form-control" name="resEmail" id="resEmail" placeholder="Restaurant email (must be unique)*" required />
                <input type="password" class="form-control" name="resPass" id="resPass" placeholder="Password*" onkeyup="password()" required />
				<div id="err_pass"></div>
                <input type="password" class="form-control" name="resCnfPass" id="resCnfPass" placeholder="Confirm password*" onkeyup="cnfpassword()" required />
				<div id="err_cnfpass"></div>
				<div id="error_msg"><?php echo $msg ?></div>
                <input type="submit" name="register" id="register" value="Register" class="btn btn-primary" />
            </form>
        </div>
    </div>
	<script type="text/javascript">
		var a=0,b=0,c=0,d=0,pas;
		function validateName(){
			var name = document.getElementById("resName").value;
			if(name.length < 3){
				document.getElementById("err_name").innerHTML = "Name must have atleast 3 characters";
				a=0;
			}else{
				document.getElementById("err_name").innerHTML = "";
				a=1;
			}
		}
		function validateContact(){
			var con = document.getElementById("resContact").value;
			if(con.length != 10){
				document.getElementById("err_contact").innerHTML = "Must have 10 digits";
				b=0;
			}else{
				document.getElementById("err_contact").innerHTML = "";
				b=1;
			}
		}
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
			if(a==1 && b==1 && c==1 && d==1){
				document.getElementById("register").disabled = false;
			}else{
				document.getElementById("register").disabled = true;
			}
		}
	</script>
</body>
</html>