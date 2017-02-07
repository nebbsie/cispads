<?php

	session_start();

?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
	<title>PADS</title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<?php
	$result = $_SESSION['result-pads'];
?>

<div class="page-header">
  		<h1 style="padding-left: 20px;">CIS PADS<small>    View All PADs</small></h1>
</div>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60335399-2', 'auto');
  ga('send', 'pageview');

</script>




<div class="center">

<form action="userpage">
		<button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit"  class="btn btn-default">Go Back</button>
</form>

</div>

<div style="background-color: #f7f7f7; " class="table-responsive">
  <table class="table table-hover">
   <tr style="font-size: 155%;">
    <th>Name</th>
    <th>Gross Cost</th>
    <th>Material Cost</th>
    <th>Amount Liable</th>
    <th>Amount Deducted</th>
    <th>Amount Payable</th>
    <th>Action</th>
  </tr>
  <?php
	 	for($x = 0; $x < count($result); $x++){
	 		?>
	 		<tr>
	 			<th><?php echo $result[$x]['name']; ?>	</th>
	 			<th>£ <?php echo $result[$x]['grossCost']; ?></th>
	 			<th>£ <?php echo $result[$x]['materialsCost']; ?></th>
	 			<th>£ <?php echo $result[$x]['amountLiable']; ?></th>
	 			<th>£ <?php echo $result[$x]['amountDeducted']; ?></th>
	 			<th>£ <?php echo $result[$x]['amountPayable']; ?></th>
				<th>
				<form method="POST" action="php/PADManager.php">
					<input name="view-pad-id" value=" <?php echo $result[$x]['id']; ?> " type="hidden">
					<input class="btn btn-primary btn-lg" type="submit" name="delete-pad-single" value="View">
					<input class="btn btn-primary btn-lg btn-danger" type="submit" name="delete-pad-single" value="Delete">
				</form>
					
				</th>
	 		</tr>


	 		<?php
			
		}

	?>

  </table>
</div>


</body>

<div class="center">
<br>
<br>
<br>
<?php include("footer.php"); ?>
 </div>
</html>		