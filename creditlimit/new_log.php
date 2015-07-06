<html>
<head>
<title>New Log</title>
<meta charset="utf-8">
<script language="javascript" src="users.js" type="text/javascript"></script>
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

    <link rel="stylesheet" href="css/bootstrap.css"/>

    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/formValidation.js"></script>
    <script type="text/javascript" src="js/framework/bootstrap.js"></script>

</head>
<body>
<div class="col-md-12" id="header_wrapper">
	<h4>გთხოვთ სწორად შეავსოთ ველები და დააჭიროთ ღილაკს " დადასტურება "</h4>
</div>
<?php
	include 'db.php';
?>
<div class="col-md-12" id="middle">
	<div class="container">
		<form class="form-horizontal" id="defaultForm" name="form" method="POST" data-toggle="validator" role="form">
			<table class="table">
				<tr>
					<td><label class="col-sm-3 control-label">DealerCode and Name:</label></td>
					<td>
					<div class="col-sm-5">
						<select name="DealerCode" class="form-control">
							<?php 
								$query = " SELECT ltrim(debcode) as Code, textfield1 as Name FROM cicmpy WHERE debnr is not null AND ltrim(debcode) like '2%' ORDER BY debcode ASC";
								$run   = sqlsrv_query($conn,$query);

								while($row = sqlsrv_fetch_array($run)){
									$Code  = $row[0];
									$Name  = $row[1];
									$txt   = $Code." ".$Name;
									echo '<option class="form-control" id="DealerCode" required>'.$txt.'</option>';
								}
							?>
						</select>
					</div>
					</td>
				</tr>
				<tr>
					<td><label class="col-sm-3 control-label">Log Date:</label></td>
					<td><div class="col-sm-5"><input type="text" id="datepicker" name="LogDate" id="LogDate" placeholder="გთხოვთ შეიყვანოთ Log-ის თარიღი მაგ: 2015-01-25" class="form-control"></div></td>
				</tr>
				<tr>
					<td><label class="col-sm-3 control-label">LOG</label></td>
					<td><div class="col-sm-5"><input type="text" name="Log"  placeholder="გთხოვთ შეიყვანოთ Log-ის თანხა" class="form-control" required></div></td>
				</tr>
				<tr>
					<td><label class="col-sm-3 control-label">Bank</label></td>
					<td><div class="col-sm-5"><input type="text" name="Bank" id="Bank" placeholder="გთხოვთ შეიყვანოთ ბანკის დასახელება" class="form-control" required></div></td>
				</tr>
				<tr>
					<td><label class="col-sm-3 control-label">Currency:</label></td>
					<td><div class="col-sm-5 has-feedback"><input type="text" name="Currency" id="Currency" placeholder="გთხოვთ შეიყვანოთ ვალუტის დასახელება" class="form-control" required></div></td>
				</tr>
			</table>
			       
			<div class="col-md-12">
				<input type="submit" name="submit" value="დადასტურება" class="btn btn-primary">
			</div>
		</form>	
	</div>
</div>


</body>
</html>

<?php 
	date_default_timezone_set("Asia/Tbilisi");

	if(isset($_POST['submit'])){
		$DealerCode 	= substr($_POST['DealerCode'], 0,9);
		$DealerName 	= substr($_POST['DealerCode'], 9);
		$LogDate 		= $_POST['LogDate'];
		$Log 			= $_POST['Log'];
		$Bank			= $_POST['Bank'];
		$Currency 		= $_POST['Currency'];
		$Status			= 1;
		$TMP			= '';
		$ModifiedDate = date("Y/m/d G:i:s");



		$query2 = "INSERT INTO LOG_DATA (DealerCode,DealerName,LogDate,LOG,Bank,Currency,Status,TMP,ModifiedDate) VALUES ('$DealerCode','$DealerName','$LogDate','$Log','$Bank','$Currency','$Status','$TMP','$ModifiedDate')";
		$run2   = sqlsrv_query($conn,$query2);

		$query10 = "UPDATE cicmpy SET CreditLine = Amount FROM cicmpy inner join 
				(SELECT DealerCode,sum(Amount) Amount FROM (SELECT DealerCode, LOG as LogtLimit,TemporaryCreditLimit as TemporaryCreditLimit ,
				case when  TemporaryCreditLimit>0 then TemporaryCreditLimit else Log end Amount
				FROM  LOG_DATA
				WHERE (Status = 1)) x group by DealerCode) x on x.DealerCode=debcode where debnr is not NULL and ltrim(debcode) = '$DealerCode' ";

		$run10 = sqlsrv_query($conn,$query10);


		// $query4 = "SELECT DealerCode,sum(Amount) as Amount FROM 
		// (SELECT DealerCode,  ([LOG]) LogtLimit, (TemporaryCreditLimit) TemporaryCreditLimit,
		// 	case when  TemporaryCreditLimit>0 then TemporaryCreditLimit else Log end Amount
		// 	FROM  LOG_DATA
		// 	WHERE Status = 1 AND DealerCode = $DealerCode GROUP BY DealerCode";

		// $run4 	= sqlsrv_query($conn,$query4);
		// 	while($row4 = sqlsrv_fetch_array($run4)){
		// 		$debcode   = $row4['DealerCode'];
		// 		$LogLimit  = $row4['LogLimit'];
		// 		$TempLimit = $row4['TempLimit'];

		// 		if($TempLimit>0){
		// 			$query5 = "UPDATE cicmpy SET CreditLine = '$TempLimit' WHERE debnr is not null and debcode = $debcode";
		// 			$query5 = 
		// 			sqlsrv_query($conn,$query5);
		// 			echo $TempLimit;
		// 		}else{
		// 			$query5 = "UPDATE cicmpy SET CreditLine = '$LogLimit' WHERE debnr is not null and debcode = $debcode";
		// 			sqlsrv_query($conn,$query5);
		// 			echo $LogLimit;
		// 		}

		// 	} 			
		
		//$run3   = sqlsrv_query($conn,$query3);
		
		echo "<script> window.alert('Inserted!');
		 			   window.location.assign('main1.php')
		 	  </script>";

	}
?>
<script type="text/javascript">
$(document).ready(function() {

    $('#defaultForm').formValidation({
        message: 'This value is not valid',
        icon: {
            valid: 'glyphicon glyphicon-ok',
            invalid: 'glyphicon glyphicon-remove',
            validating: 'glyphicon glyphicon-refresh'
        },
        fields: {
            Log: {
                row: '.col-sm-5',   
                validators: {
                    notEmpty: {
                        message: 'გთხოვთ შეიყვანოთ Log-ის თანხა'
                    }
                }
            },
            Bank: {
                row: '.col-sm-5',
                validators: {
                    notEmpty: {
                        message: 'გთხოვთ შეიყვანოთ Bank-ის დასახელება'
                    }
                }
            },
            Currency: {
                row: '.col-sm-5',
                validators: {
                    notEmpty: {
                        message: 'გთხოვთ შეიყვანოთ ვალუტის დასახელება'
                    }
                }
            },  
            DealerCode: {
                row: '.col-sm-5',
                validators: {
                    notEmpty: {
                        message: 'გთხოვთ შეიყვანოთ ვალუტის დასახელება'
                    }
                }
            }
        }
    });
});
</script>