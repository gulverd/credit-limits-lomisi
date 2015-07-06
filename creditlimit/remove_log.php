<html>
<head>
<title>Select Logs</title>
<meta charset="utf-8">
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="jquery.easing.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<?php
	session_start();

	if(!isset($_SESSION['username'])){
		header('location: index.php');
	}
?>
<div class="col-md-12" id="header_wrapper">
	<h4>მოგესალმებით <span class="span_name"><?php echo $_SESSION['username']; ?></span> !, გთხოვ აირჩიოთ კრედიტორი!</h4>
</div>
<Div class="col-md-12" id="middle">
	<div class="container" id="cont">
		<Div class="col-md-12" id="input_wrapper">
		<form class="form-group" method="get" action="list_user3.php" name="form">
			<select class="form-control" name="dealer">
				<?php

					include 'db.php';
					 

					 if($conn){
					 	//echo 'connected!';
					 }else{
					 	echo "error!";
					 }

					$query = "SELECT DISTINCT DealerCode,DealerName FROM LOG_DATA WHERE status = 1 ORDER BY DealerCode ASC";
					$run   = sqlsrv_query($conn,$query);

					while($row = sqlsrv_fetch_array($run)){
						$dealerName = $row['DealerName'];
						echo '<option>'.$dealerName.'</option>';
					}
				?>
			</select>
		</Div>
		<Div class="col-md-12" id="button_wrapper">
			<input class="btn btn-primary btn-lg" type="submit" value="დადასტურება" name="submit" id="submit_forma">
		</Div>
		</form>
	</div>
</Div>
</body>
</html>