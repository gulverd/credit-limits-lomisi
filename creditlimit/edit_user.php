
<html>
<head>
<title>edit users</title>
<meta charset="utf-8">
<script language="javascript" src="users.js" type="text/javascript"></script>
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="jquery.easing.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles.css" />

  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script>
  $(function() {
    $( "#datepicker" ).datepicker({

    	dateFormat: "yy-mm-dd",	
    	gotoCurrent: true
    });
  });
  </script>
 





</head>
<body>
<div class="col-md-12" id="header_wrapper">
	<h4>გთხოვთ მონიშნოთ სასურველი სტრიქონი და დააჭიროთ ღილაკს " დადასტურება "</h4>
</div>
<Div class="col-md-12" id="middle">
	<div class="container">
		<form class="form-horizonta" name="frmUser" method="post" action="">
		<div class="col-md-12">
		<?php
		
		include 'db.php';

		
		$rowCount = count($_POST["users"]);
		//echo $rowCount;
		for($i=0;$i<$rowCount;$i++) {
		$result = sqlsrv_query($conn,"SELECT ID as userId,DealerCode,DealerName,CONVERT(VARCHAR(50),LogDate) AS LogDate1,Bank,LOG,CONVERT(VARCHAR(50),
		CreditLimitDate) as CreditLimitDate1,CreditLimit,CONVERT(VARCHAR(50),TemporaryCreditLimitDate) as TemporaryCreditLimitDate1,
		TemporaryCreditLimit,Currency,Status,TMP,CONVERT(VARCHAR(50),ModifiedDate) as ModifiedDate1 from LOG_DATA  WHERE ID='" . $_POST["users"][$i] . "'");
		$row[$i]= sqlsrv_fetch_array($result);
		//print_r($row[$i]);
		?>
		<tr>
		<td>
		<table class="table">
		<tr>
		<td><label>DealerCode</label></td>
		<td><input type="hidden" name="userId[]" class="form-control" value="<?php echo $row[$i]['userId']; ?>"><input type="text" name="DealerCode[]" class="form-control" value="<?php echo $row[$i]['DealerCode']; ?>" readonly></td>
		</tr>
		<tr>
		<td><label>DealerName</label></td>
		<td><input type="text" name="DealerName[]" class="form-control" value="<?php echo $row[$i]['DealerName']; ?>" readonly></td>
		</tr>
		<tr>
		<td><label>LogDate</label></td>
		<td><input type="text" name="LogDate[]" class="form-control" value="<?php echo $row[$i]['LogDate1']; ?>" readonly></td>
		<tr>
		<td><label>Bank</label></td>
		<td><input type="text" name="Bank[]" class="form-control" value="<?php echo $row[$i]['Bank']; ?>" readonly></td>
		</tr>
		<tr>
		<td><label>LOG</label></td>
		<td><input type="text" name="LOG[]" class="form-control" value="<?php echo $row[$i]['LOG']; ?>" readonly></td>
		</tr>
		<tr>
		<td><label>TemporaryCreditLimitDate</label></td>
		<td><input type="text" id="datepicker" name="TemporaryCreditLimitDate[]" class="form-control" value="<?php echo $row[$i]['TemporaryCreditLimitDate1']; ?>" placeholder="გთხოვთ ამოირჩიოთ თარიღი ან ჩა"></td>
		</tr>
		<tr>
		<td><label>TemporaryCreditLimit</label></td>
		<td><input type="text" name="TemporaryCreditLimit[]" class="form-control" value="<?php echo $row[$i]['TemporaryCreditLimit']; ?>" placeholder="შეიყვნაეთ კრედიტ ლიმიტის თანხა"></td>
		</tr>
		<tr>
		<td><label>Currency</label></td>
		<td><input type="text" name="Currency[]" class="form-control" value="<?php echo $row[$i]['Currency']; ?>" readonly></td>
		</tr>
		<td><label>TMP</label></td>
		<td><input type="text" name="TMP[]" class="form-control" value="<?php echo $row[$i]['TMP']; ?>" readonly></td>
		</tr>
		</table>
		</td>
		</tr>
		<?php
		}
		?>
		<tr>
		<td colspan="2"><input type="submit" name="submit" value="დადასტურება" class="btn btn-primary"></td>
		</tr>
		</div>
		</form>
		<?php
			date_default_timezone_set("Asia/Tbilisi");
			if(isset($_POST["submit"])) {
				$DealerCode = $_POST['DealerCode'][$i];
				$DealerName = $_POST['DealerName'][$i];
				$LogDate = $_POST['LogDate'][$i];
				$Bank = $_POST['Bank'][$i];
				$LOG = $_POST['LOG'][$i];
				$CreditLimitDate = $_POST['TemporaryCreditLimitDate'][$i];
				$CreditLimit = $_POST['TemporaryCreditLimit'][$i];
				$TemporaryCreditLimitDate = $_POST['TemporaryCreditLimitDate'][$i];
				$TemporaryCreditLimit = $_POST['TemporaryCreditLimit'][$i];
				$Currency = $_POST['Currency'][$i];
				$Status = 1;
				$AuthStatus = 0;
				$TMP = $_POST['TMP'][$i];
				$ModifiedDate = date("Y/m/d G:i:s");


		$query = "INSERT INTO LOG_DATA_0 (DealerCode,DealerName,LogDate,Bank,LOGs,CreditLimitDate,CreditLimit,TemporaryCreditLimitDate,TemporaryCreditLimit,Currency,Statuss,AuthStatus,TMP,ModifiedDate) VALUES ('$DealerCode','$DealerName','$LogDate','$Bank','$LOG','$CreditLimitDate','$CreditLimit','$TemporaryCreditLimitDate','$TemporaryCreditLimit','$Currency','$Status','$AuthStatus','$TMP','$ModifiedDate')";
		sqlsrv_query($conn,$query); 
		
		header("Location:main.php");
		}
		?>

	</div>
</body>
</html>

