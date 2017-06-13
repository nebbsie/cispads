<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">

<html>
<head>
    <title>CISPADS</title>
    <meta name="description"
          content="Tool to create and distribute contruction and industry scheme payment and deduction statements.">
    <meta name=viewport content='width=700'>
    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
    <link rel="stylesheet" href="css/font-awesome.min.css">
</head>

<body>

<div class="page-header">
    <h1 style="padding-left: 20px;">CIS PADS
        <small> Create, Dispatch and Save PADS</small>
    </h1>
</div>

<div class="center">

    <div class="alert alert-warning" role="alert"
    ">Need an account? Contact admin@cispads.com
</div>
<br>

<form method="post" action="php/databaseManager.php">
    <div class="form-group">
        <input type="text" class="form-control" name="username" placeholder="Username" style="text-align: center; width: 250px; height: 50px; font-size: 150%;>
		  </div>
		  <div class=" form-group"> <br>
        <input type="password" class="form-control" name="password" placeholder="Password"
               style="text-align: center; width: 250px; height: 50px; font-size: 150%;">
    </div>

    <?php
    if (isset($_SESSION['failed'])) {
        ?>
        <div class="alert alert-danger" role="alert">Invalid username/password please try again.</div>
        <?php
    }
    ?>

    <button class="btn btn-primary btn-lg"
            style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; margin-bottom: 50px; width: 200px;"
            type="submit" name="login" class="btn btn-default">Login
    </button>

</form>

<?php include("footer.php"); ?>

</div>

</body>

</html>