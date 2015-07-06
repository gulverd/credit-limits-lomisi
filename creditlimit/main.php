<html>
<head>
<title>Select Logs</title>
<meta charset="utf-8">
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<script language="javascript" src="users.js" type="text/javascript"></script>
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
		<form class="form-group" method="get" action="list_user.php" name="form">
			<select class="form-control" name="dealer">
				<?php

					include 'db.php';
					 

					 if($conn){
					 	//echo 'connected!';
					 }else{
					 	echo "error!";
					 }

					$query1 = "SELECT DISTINCT DealerCode, DealerName FROM LOG_DATA WHERE status = 1";
					$run1   = sqlsrv_query($conn,$query1);

					while($row1 = sqlsrv_fetch_array($run1)){
						$dealerName = $row1['DealerCode']." ".$row1['DealerName'];
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
<?php
	$query21 = "SELECT COUNT(*) as counti from LOG_DATA_0 where AuthStatus = 0";
	$run21   =  sqlsrv_query($conn,$query21);

		while ($row21 = sqlsrv_fetch_array($run21)) {
		$count = $row21['counti'];
		if($count>0){
			echo '<div class="container"><div class="col-md-12"><h4>';
			echo 'თქვენს მიერ გაკეთებული request-ების რაოდენობაა:'. ' '. $count;
			echo '</h4></div></div>';
	// 		echo '

	// 			<div class"col-md-12">
	// 				<div class="col-md-12">
	// 				თქვენს მიერ გაკეთებული request-ები:
	// 				</div>
	// 				<table class="table table-striped">
	// 				<tr>
	// 					<td>DealerCode</td>
	// 					<td>DealerName</td>
	// 					<td>LogDate</td>
	// 					<td>Log</td>
	// 					<td>Bank</td>
	// 					<td>TempDate</td>
	// 					<td>TempLimit</td>
	// 					<td>Currency</td>
	// 					<td>ModifiedDate</td>
	// 				</tr>';

	// 		$query20 = "SELECT DealerCode,DealerName,CONVERT(VARCHAR(50),LogDate) as LogDate1, LOGs, Bank, CONVERT(VARCHAR(50),TemporaryCreditLimitDate) as TemporaryCreditLimitDate1,TemporaryCreditLimit,Currency, CONVERT(VARCHAR(50),ModifiedDate) as ModifiedDate1 FROM LOG_DATA_0 WHERE Authstatus = 0";
	// 		$run20   = sqlsrv_query($conn,$query20);

	// 		while($row20 = sqlsrv_fetch_array($run20)){
	// 			$Dcode 		 	= $row20['DealerCode'];
	// 			$Dname       	= $row20['DealerName'];
	// 			$LogDate 		= $row20['LogDate1'];
	// 			$LOG   			= $row20['LOGs'];
	// 			$Bank			= $row20['Bank'];
	// 			$TempDate 		= $row20['TemporaryCreditLimitDate1'];
	// 			$TempLimit 		= $row20['TemporaryCreditLimit'];
	// 			$Currency       = $row20['Currency'];
	// 			$ModifiedDate   = $row20['ModifiedDate1'];
	// 			echo '<tr>';
	// 			echo '<td>'.$Dcode. '</td>';
	// 			echo '<td>'.$Dname. '</td>';
	// 			echo '<td>'.$LogDate. '</td>';
	// 			echo '<td>'.$LOG. '</td>';
	// 			echo '<td>'.$Bank. '</td>';
	// 			echo '<td>'.$TempDate. '</td>';
	// 			echo '<td>'.$TempLimit. '</td>';
	// 			echo '<td>'.$Currency. '</td>';
	// 			echo '<td>'.$ModifiedDate. '</td>';
	// 			echo '</tr>';
	// 		}
	// 	echo '		
	// 	</table>
	// </div>	';
	echo '<Div class="col-md-12" id="middle">
		<form name="frmUser" method="post" action="">
	
			<table class="table table-striped">
			<tr class="listheader">
				<td></td>
				<td>DealerCode</td>
				<td>DealerName</td>
				<td>LogDate</td>
				<td>Bank</td>
				<td>LOG</td>
				<td>TemporaryCreditLimitDate</td>
				<td>TemporaryCreditLimit</td>
				<td>Currency</td>
				<td>Status</td>
				<td>AuthStatus</td>
				<td>TMP</td>
				<td>ModifiedDate</td>
			</tr>';
			 

			$query = "SELECT  ID as userId, DealerCode, DealerName, CONVERT(VARCHAR(50),LogDate) AS LogDate1, Bank, LOGs,CreditLimit,
			 CONVERT(VARCHAR(50),TemporaryCreditLimitDate) as TemporaryCreditLimitDate1,
			  TemporaryCreditLimit, Currency, Statuss, AuthStatus,TMP,CONVERT(VARCHAR(50),ModifiedDate) as ModifiedDate1
			FROM LOG_DATA_0 WHERE AuthStatus = 0";

			$result = sqlsrv_query($conn,$query);
			$i=0;
			while($rows = sqlsrv_fetch_array($result)) {
			if($i%2==0)
			$classname="evenRow";
			else
			$classname="oddRow";


			
			echo '<tr class="'; if(isset($classname)) echo $classname; echo '">
			<td><input type="radio" name="users[]" value="'; echo $rows["userId"]; echo'" ></td>
			<td>'; echo $rows["DealerCode"]; echo '</td>
			<td>'; echo $rows["DealerName"]; echo '</td>
			<td>'; echo $rows["LogDate1"]; echo '</td>
			<td>'; echo $rows["Bank"]; echo '</td>
			<td>'; echo $rows["LOGs"]; echo '</td>
			<td>'; echo $rows["TemporaryCreditLimitDate1"]; echo '</td>
			<td>'; echo $rows["TemporaryCreditLimit"]; echo '</td>
			<td>'; echo $rows["Currency"]; echo '</td>
			<td>'; echo $rows["Statuss"]; echo '</td>
			<td>'; echo $rows["AuthStatus"]; echo '</td>
			<td>'; echo $rows["TMP"]; echo '</td>
			<td>'; echo $rows["ModifiedDate1"]; echo '</td>
			</tr>';

		$i++;
		}

echo'
		</table>
		<div class="col-md-12">
			<input type="button"class="btn btn-primary" name="update" value="გაუქმება" onClick="setUpdateAction7();" />
		</div>
		</form>

	
</div>';
		}else{
			echo '<div class="container"><div class="col-md-12"><h4>';
			echo 'თქვენს მიერ გაკეთებული request-ების რაოდენობაა:'. ' '. $count;
			echo '</h4></div></div>';
		}
	}

?>


</Div>
</body>
</html>