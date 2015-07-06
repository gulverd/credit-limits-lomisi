<html>
<head>
<title>List Logs</title>
<meta charset="utf-8">
<script language="javascript" src="users.js" type="text/javascript"></script>
<script src="jquery-1.9.1.min.js" type="text/javascript"></script>
<!-- jQuery easing plugin -->
<script src="jquery.easing.min.js" type="text/javascript"></script>
<link href="css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" type="text/css" href="styles.css" />
</head>
<body>
<div class="col-md-12" id="header_wrapper">
	<h4>გთხოვთ მონიშნოთ სასურველი სტრიქონი და დააჭიროთ ღილაკს " შეცვლა "</h4>
</div>
<Div class="col-md-12" id="middle">
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
			<td>TMP</td>
			<td>ModifiedDate</td>
		</tr>

		<?php
			include 'db.php';		 

			if($conn){
				//echo 'connected!';
			}else{
				echo "error!";
			}

			if(isset($_GET['submit'])){
			$dealer = substr($_GET['dealer'],9);

			$query  =  "SELECT ID as userId,DealerCode,DealerName,CONVERT(VARCHAR(50),LogDate) AS LogDate1,Bank,LOG,CONVERT(VARCHAR(50),
		CreditLimitDate) as CreditLimitDate1,CreditLimit,CONVERT(VARCHAR(50),TemporaryCreditLimitDate) as TemporaryCreditLimitDate1,
		TemporaryCreditLimit,Currency,Status,TMP,CONVERT(VARCHAR(50),ModifiedDate) as ModifiedDate1
		from LOG_DATA  WHERE DealerName ='$dealer' AND Status = 1";
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
		<td>'; echo $rows["LOG"]; echo '</td>
		<td>'; echo $rows["TemporaryCreditLimitDate1"]; echo '</td>
		<td>'; echo $rows["TemporaryCreditLimit"]; echo '</td>
		<td>'; echo $rows["Currency"]; echo '</td>
		<td>'; echo $rows["Status"]; echo '</td>
		<td>'; echo $rows["TMP"]; echo '</td>
		<td>'; echo $rows["ModifiedDate1"]; echo '</td>
		</tr>';

		$i++;
		}

		}
		?>	
		</table>
		<div class="col-md-12">
			<input type="button"class="btn btn-primary" name="update" value="შეცვლა" onClick="setUpdateAction();" />
		</div>
		</form>

	
</div>
</body></html>