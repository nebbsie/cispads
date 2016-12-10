<?php
	session_start();
	session_destroy();
?>

<!DOCTYPE html>
<html>
<head>
	<title>CIS PADS LOGIN</title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
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
  		<h1 style="padding-left: 20px;">CIS PADS<small>    Create, Dispatch and Save PADS</small></h1>
</div>

	<div class="center" >

	<div class="alert alert-warning" role="alert";">Need an account? Contact aaron@nebbs.com</div>
<br>
		<form method="post" action="php/databaseManager.php">
		  <div class="form-group" >
		    
		    <input type="text" class="form-control" name="username" placeholder="Username" style="text-align: center; width: 250px; height: 50px; font-size: 150%;>
		  </div>
		  <div class="form-group">
		    <br>
		    <input type="password" class="form-control" name="password" placeholder="Password" style="text-align: center; width: 250px; height: 50px; font-size: 150%;">
		  </div>
		  
		  <?php
				if($_SESSION['failed'] == "true"){
					?> <div class="alert alert-danger" role="alert">Invalid username/password please try again.</div> 
					
					<?php
				}
		   ?>
		  
		  <button class="btn btn-primary btn-lg" style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; margin-bottom: 50px; width: 200px;" type="submit" name="login" class="btn btn-default">Login</button>
		</form>

	</div>
</body>
</html>