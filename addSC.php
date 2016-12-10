<?php 

	session_start();

?>

<!DOCTYPE html>
<html>
<head>
	<title>Add New Sub Contractor</title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<div class="page-header">
  		<h1 style="padding-left: 20px;">CIS PADS<small>    Add new Sub Contractor</small></h1>
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

		<form action="userpage.php">
				<button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit"  class="btn btn-default">Go Back</button>
		</form>

			<form method="post" action="php/SCManager.php" style="background-color: #f7f7f7;">

			<br>

				<div class="form-group">
				   <label for="exampleInputEmail1">Name</label>
				    <input type="text" class="form-control" name="sc-name" required="true">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputText1">Tax Reference</label>
				    <input type="text" class="form-control" name="sc-taxRef" required="true">
				  </div>

				  <div class="form-group">
				    <label for="exampleInputText1">Verification Number</label>
				    <input type="text" class="form-control" name="sc-verNumber" required="true">
				  </div>

				  <label for="sel1">Select Tax Treatment:</label>
				  <select class="form-control" id="sel1" name="sc-taxTreatment" required="true">
				    <option>Gross</option>
				    <option selected>Standard</option>
				    <option>Higher</option>
				  </select>

				  <div class="form-group">
				    <label for="exampleInputEmail1">Email</label>
				    <input type="email" class="form-control" name="sc-email" required="true">
				  </div>

				  <br>
				  <button class="btn btn-primary" style="font-size: 150%;" type="submit" name="sc-add-submit">Create Sub Contractor</button><br>

				  <br>
				  <br>

			</form>

	</div>

</body>
</html>