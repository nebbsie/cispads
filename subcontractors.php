<?php

	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<?php
	$result = $_SESSION['result'];
?>

<div class="page-header">
  		<h1 style="padding-left: 20px;">CIS PADS<small>    View All Sub Contractors</small></h1>
</div>




<div class="center">

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60335399-2', 'auto');
  ga('send', 'pageview');

</script>

<form action="userpage">
		<button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit"  class="btn btn-default">Go Back</button>
</form>

</div>

<div style="background-color: #f7f7f7; " class="table-responsive">
  <table class="table table-hover">
   <tr style="font-size: 155%;">
    <th>ID</th>
    <th>Name</th>
    <th>Tax Reference</th> 
    <th>Verification Number</th>
    <th>Tax Treatment</th>
    <th>Email</th>
    <th>Action</th>
  </tr>
  <?php
	 	for($x = 0; $x < count($result); $x++){
	 		?>
	 		<tr>
	 			<th><?php echo $result[$x]['id']; ?>	</th>
	 			<th><?php echo $result[$x]['name']; ?>	</th>
	 			<th><?php echo $result[$x]['taxRef']; ?></th>
				<th><?php echo $result[$x]['verNumber']; ?></th>
				<th><?php echo $result[$x]['taxTreatment']; ?></th>
				<th><?php echo $result[$x]['email']; ?></th>
				<th>
				<form method="POST" action="php/SCManager.php">
					<input name="edit-sc-id" value=" <?php echo $result[$x]['id']; ?> " type="hidden">
					<input class="btn btn-primary btn-lg" type="submit" name="edit-sc" value="Edit">
				</form>
					
				</th>
	 		</tr>


	 		<?php
			
		}

	?>

  </table>
</div>

<div class="center">
<br>
<br>
<br>
<?php include("footer.php"); ?>
 </div>


</body>
</html>