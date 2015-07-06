
<html>
<head>
<title>Authorization</title>
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
	<h4>გთხოვთ გადახედოთ მონაცემებს, საჭიროებისამებრ შეცვალოთ და დააჭიროთ ღილაკს " დადასტურება "</h4>
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
		<td><input type="text" id="datepicker" name="LogDate[]" class="form-control" value="<?php echo $row[$i]['LogDate1']; ?>"></td>
		<tr>
		<td><label>Bank</label></td>
		<td><input type="text" name="Bank[]" class="form-control" value="<?php echo $row[$i]['Bank']; ?>"></td>
		</tr>
		<tr>
		<td><label>LOG</label></td>
		<td><input type="text" name="LOG[]" class="form-control" value="<?php echo $row[$i]['LOG']; ?>"></td>
		</tr>
		<tr>
		<td><label>Currency</label></td>
		<td><input type="text" name="Currency[]" class="form-control" value="<?php echo $row[$i]['Currency']; ?>"></td>
		</tr>
		<tr>
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
				$ID = $_POST['userId'][$i];
				$DealerCode = $_POST['DealerCode'][$i];
				$DealerName = $_POST['DealerName'][$i];
				$LogDate = $_POST['LogDate'][$i];
				$Bank = $_POST['Bank'][$i];
				$LOG = $_POST['LOG'][$i];
				$Currency = $_POST['Currency'][$i];
				$Status = 1;
				$AuthStatus = 0;
				$TMP = $_POST['TMP'][$i];
				$ModifiedDate = date("Y/m/d G:i:s");
				$new_TMP = $ID.$DealerCode;


		$query  = "INSERT INTO LOG_DATA (DealerCode,DealerName,LogDate,Bank,LOG,Currency,Status,TMP,ModifiedDate) VALUES ('$DealerCode','$DealerName','$LogDate','$Bank','$LOG','$Currency','$Status','$new_TMP','$ModifiedDate')";

		$query3 = "UPDATE LOG_DATA SET status = 0 WHERE TMP='" . $_POST["TMP"][$i] . "'";

		//$query4 = "UPDATE cicmpy set CreditLine='$LOG'";
		sqlsrv_query($conn,$query3);
		sqlsrv_query($conn,$query);

		// $query4 = "SELECT DealerCode, sum([LOG]) LogLimit, sum(TemporaryCreditLimit) TempLimit FROM LOG_DATA WHERE status = 1 AND DealerCode = $DealerCode GROUP BY DealerCode";	
		// $run4 	= sqlsrv_query($conn,$query4);
		// 	while($row4 = sqlsrv_fetch_array($run4)){
		// 		$debcode   = $row4['DealerCode'];
		// 		$LogLimit  = $row4['LogLimit'];
		// 		$TempLimit = $row4['TempLimit'];


		// 		if($TempLimit>0){
		// 			$query5 = "UPDATE cicmpy SET CreditLine = '$TempLimit' WHERE debnr is not null and debcode = $debcode";
		// 			echo $TempLimit;
		// 		}else{
		// 			$query5 = "UPDATE cicmpy SET CreditLine = '$LogLimit' WHERE debnr is not null and debcode = $debcode";
		// 			echo $LogLimit;
		// 		}
				

		// 	}

		
		$query10 = "UPDATE cicmpy SET CreditLine = Amount FROM cicmpy inner join 
				(SELECT DealerCode,sum(Amount) Amount FROM (SELECT DealerCode, LOG as LogtLimit,TemporaryCreditLimit as TemporaryCreditLimit ,
				case when  TemporaryCreditLimit>0 then TemporaryCreditLimit else Log end Amount
				FROM  LOG_DATA
				WHERE (Status = 1)) x group by DealerCode) x on x.DealerCode=debcode where debnr is not NULL and ltrim(debcode) = '$DealerCode' ";

		$run10 = sqlsrv_query($conn,$query10);


		
		sqlsrv_query($conn,$query5);

		header("Location:main1.php");
		}

		?>


	</div>
</body>
</html>
