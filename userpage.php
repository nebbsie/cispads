<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>CIS USERPAGE</title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60335399-2', 'auto');
  ga('send', 'pageview');

</script>

	<div class="page-header">
  		<h1 style="padding-left: 20px;">CIS PADS<small>  <?php echo $_SESSION['username']; ?></small></h1>
	</div>

<div class="center">

	<form method="POST" action="php/databaseManager.php">
		<button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit" name="user-logout" class="btn btn-default">Log <?php echo $_SESSION['username']; ?> Out</button>
	</form>

	<div class="alert alert-warning" role="alert";">This website is still in development!</div>

	<?php
				if($_SESSION['sc-edit-fail'] == "true"){
					?> <div class="alert alert-danger" role="alert">Failed To Edit Sub Contractor Please Try Again!</div> 
					<?php
					$_SESSION['sc-edit-fail'] = "";
				} else if($_SESSION['sc-edit-fail'] == "false"){
					?>
						<div class="alert alert-success" role="alert">Succesfully Updated Sub Contractror!</div>
					<?php
					$_SESSION['sc-edit-fail'] = "";
				}

				if($_SESSION['sc-delete-fail'] == "true"){
					?> <div class="alert alert-danger" role="alert">Failed To Delete Sub Contractor Please Try Again!</div> 
					<?php
					$_SESSION['sc-delete-fail'] = "";
				} else if($_SESSION['sc-delete-fail'] == "false"){
					?>
						<div class="alert alert-success" role="alert">Succesfully Deleted Sub Contractror!</div>
					<?php
					$_SESSION['sc-delete-fail'] = "";
				}
				
				if($_SESSION['sent-email'] == "true"){
					?> <div class="alert alert-success" role="alert">Sent Email to <?php echo $_SESSION['sent-email-to']; ?>!</div> 
					<?php
					$_SESSION['sent-email'] = "";
				}

				if($_SESSION['sc-add-fail'] == "true"){
					?> <div class="alert alert-danger" role="alert">Failed To Add New Sub Contractor Please Try Again!</div> 
					<?php
					$_SESSION['sc-add-fail'] = "";
				} else if($_SESSION['sc-add-fail'] == "false"){
					?>
						<div class="alert alert-success" role="alert">Succesfully Added New Sub Contractror!</div>
					<?php
					$_SESSION['sc-add-fail'] = "";
				}

		   ?>
</div>


		


<div style="background-color: #f7f7f7; margin: auto; width: 50%; text-align: center; " class="jumbotron">

  <h1>Sub Contractors</h1>
 	<form method="POST" action="php/SCManager.php" >
		<button class="btn btn-primary btn-lg"  style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; width: 200px;" type="submit" name="view-sub_contractors" class="btn btn-default">View All Contractors</button><br>

		<button class="btn btn-primary btn-lg mainButtons" style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; margin-bottom: 50px; width: 200px;" type="submit" name="add-sub_contractors" class="btn btn-default">Add New Contractor</button>
	</form>

</div>

<div style="background-color: #f7f7f7; margin: auto; width: 50%; text-align: center; " class="jumbotron">

  <h1>CIS PADS</h1>
 	

	<form  method="POST" action="php/PADManager.php" >
		<button class="btn btn-primary btn-lg"  style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; width: 200px;" type="submit" name="view-pad" class="btn btn-default">View All PADs</button><br>
	</form>

	<form style="margin-top: -20px;" method="POST" action="php/SCManager.php" >
		<button class="btn btn-primary btn-lg"  style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; width: 200px;" type="submit" name="create-pad" class="btn btn-default">Create New PAD</button>
	</form>

	<br>

</div>




</body>
</html>