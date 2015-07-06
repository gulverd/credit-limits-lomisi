<?php 
	include 'db.php';
?>
<html>
<head>
<title>SELECT MODULE</title>
<meta charset="utf-8">
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
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
	<h4>მოგესალმებით <span class="span_name"><?php echo $_SESSION['username']; ?></span> !, გთხოვ აირჩიოთ სასურველი მოდული!</h4>
</div>
<Div class="col-md-12" id="middle">
		<div class="container" id="cont">
			<a href="new_log.php"><button type="button" class="btn btn-primary btn-lg btn-block">ახალი LOG-ის შეყვანა</button></a>
			<a href="remove_log.php"><button type="button" class="btn btn-default btn-lg btn-block" id="remove">არსებულ დებიტორზე LOG-ის გაუქმება</button></a>
		</div>
</Div>
</body>
</html>