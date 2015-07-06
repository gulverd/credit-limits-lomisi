<?php 
	include 'db.php';
	session_start();

?>
<html>
<head>
<title>Welcome</title>
<meta charset="utf-8">
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script src="jquery.easing.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>


<div class="col-md-12" id="header_wrapper">
	<h4>გთხოვთ გაიაროთ ავტორიზაცია</h4>
</div>
<div class="col-md-12" id="middle">
	<div class="container" id="cont">
		<form action="index.php" method="post">
		  <div class="form-group">
		    <label for="exampleInputEmail1">Username</label>
		    <input type="text" name="username" class="form-control" id="exampleInputEmail1" placeholder="Enter Username">
		  </div>
		  <div class="form-group">
		    <label for="exampleInputPassword1">Password</label>
		    <input type="password" name="password2" class="form-control" id="exampleInputPassword1" placeholder="Password">
		  </div>
		  <button type="submit" name="submit" class="btn btn-default">Submit</button>
		</form>
	</div>
</div>
</body>
</html>
<?php

	if(isset($_POST['submit'])){

		$user_name = $_POST['username'];
		$user_pass = $_POST['password2'];

		$check_user = "SELECT * FROM LOG_USERS WHERE username = '$user_name' AND password1 = '$user_pass'";

		$run = sqlsrv_query($conn,$check_user);


		while ($row = sqlsrv_fetch_array($run)){
			if($_POST['username'] == 'sales' && $_POST['password2'] = '1324'){
				echo "<script>
				window.open('main.php','_self')
				</script>";	
			}elseif ($_POST['username'] == 'cash' && $_POST['password2'] = '1324'){
				echo "<script>
				window.open('main1.php','_self')
				</script>";	
			}elseif($_POST['username'] == 'finance' && $_POST['password2'] = '1324'){
				echo "<script>
				window.open('main2.php','_self')
				</script>";	
			}else{
				echo 'Username or Password is incorrect!';
			}
			
			$_SESSION['username'] = $user_name;
		}
	}
?>