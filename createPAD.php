<?php

	session_start();

    $result = $_SESSION['result'];


?>
<!DOCTYPE html>
<html>
<head>
	<title>Create New PAD</title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<div class="page-header">
  		<h1 style="padding-left: 20px;">CIS PADS<small>    Create New PAD</small></h1>
</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60335399-2', 'auto');
  ga('send', 'pageview');

</script>

    <?php
$today = getdate();

$day = $today[mday];
$month = $today[mon];
$year = $today[year];

if($day == 5){

}else{

	$day = 5;
	
	$month = $month + 1;
	
	if($month == 13){
		$month = 1;
		$year = $year + 1;
	}

	$day = sprintf("%02d", $day);
	$month = sprintf("%02d", $month);
}

?>


<div class="center">


<!-- TODO: 

	-Make it so the date is automatically selected and should be the
	5th of the next month.

	 
-->

		<form action="userpage.php"> <button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit"  class="btn btn-default">Go Back</button> </form>

			<form method="post" action="php/PADManager.php" style="background-color: #f7f7f7;"><br>

			  <label for="1">Select Tax Treatment:</label>
			  <select class="form-control" id="1" name="sc-id-pad" required="true">
			  <?php
	
					$amount = count($_SESSION['result']);

				  	for($x = 0; $x <count($result); $x++){

				  		$idNumber = $result[$x]['id'];
	 					$name = $result[$x]['name'];

				  		?>
				  			 <option value="<?php echo $idNumber; ?>"> <?php echo $name; ?> </option>
				  		<?php
				  	}
							  
			  ?>

				   
			  </select>
			  <br>
				  

			  <label for="2">Select Date:</label>
			  <input class="form-control" id="2" type="date" name="date-pad" required="true" value="<?php echo $year; ?>-<?php echo $month; ?>-<?php echo $day; ?>">

			  <label for="3">Gross Amount Paid: </label>
			  <input type="text" class="form-control" name="gross-amount-pad" id="3" required="true">

			  <label for="4">Material Costs: </label>
			  <input type="text" class="form-control" name="material-cost-pad" id="4" required="true">


			  <br><br>

			  <input class="btn btn-primary btn-lg" type="reset" name=""><br><br>

			  <input class="btn btn-primary btn-lg" type="submit" name="create-pad" value="Create Pad (Review Before Sending)">

			  <br><br>
			 </form>

	</div>

</body>
</html>