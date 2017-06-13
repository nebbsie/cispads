<?php
session_start();
require "php/objects/User.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>CIS USERPAGE</title>
    <meta name=viewport content='width=800'>
    <link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <link href="css/bootstrap.css" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">
</head>
<body>

<?php
$user = unserialize($_SESSION['user']);
?>

<div class="page-header">
    <h1 style="padding-left: 20px;">CIS PADS
        <small>
            <?php

            echo $user->username;
            ?> </small>
    </h1>
</div>

<div class="center">

    <form method="POST" action="php/databaseManager.php">
        <button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit"
                name="user-logout" class="btn btn-default">Log <?php echo $user->username; ?> Out
        </button>
    </form>

    <div class="alert alert-warning" role="alert" ;
    ">This website is still in development!
</div>


<?php
if (isset($_SESSION['sc-edit-fail'])) {
    if ($_SESSION['sc-edit-fail']) {
        ?>
        <div class="alert alert-danger" role="alert">Failed To Edit Sub Contractor Please Try Again!</div>
        <?php
        unset($_SESSION['sc-edit-fail']);
    } else {
        ?>
        <div class="alert alert-success" role="alert">Successfully Updated Sub Contractor!</div>
        <?php
        unset($_SESSION['sc-edit-fail']);
    }
}

if (isset($_SESSION['sc-delete-fail'])) {
    if ($_SESSION['sc-delete-fail']) {
        ?>
        <div class="alert alert-danger" role="alert">Failed To Delete Sub Contractor Please Try Again!</div>
        <?php
        unset($_SESSION['sc-delete-fail']);
    } else {
        ?>
        <div class="alert alert-success" role="alert">Successfully Deleted Sub Contractor!</div>
        <?php
        unset($_SESSION['sc-delete-fail']);
    }
}

if (isset($_SESSION['sc-add-fail'])) {
    if ($_SESSION['sc-add-fail']) {
        ?>
        <div class="alert alert-danger" role="alert">Failed To Add New Sub Contractor Please Try Again!</div>
        <?php
        unset($_SESSION['sc-add-fail']);
    } else {
        ?>
        <div class="alert alert-success" role="alert">Successfully Added New Sub Contractor!</div>
        <?php
        unset($_SESSION['sc-add-fail']);
    }
}

if (isset($_SESSION['sent-email'])) {
    ?>
    <div class="alert alert-success" role="alert">Sent Email to <?php echo $_SESSION['sent-email-to']; ?>!</div>
    <?php
    unset($_SESSION['sent-email']);
}

?>
</div>

<div style="background-color: #f7f7f7; margin: auto; width: 50%; text-align: center; " class="jumbotron">

    <h1>Sub Contractors</h1>
    <form method="POST" action="php/SCManager.php">
        <button class="btn btn-primary btn-lg"
                style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; width: 200px;"
                type="submit" name="view-sub_contractors" class="btn btn-default">View All Contractors
        </button>
        <br>

        <button class="btn btn-primary btn-lg mainButtons"
                style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; margin-bottom: 50px; width: 200px;"
                type="submit" name="add-sub_contractors" class="btn btn-default">Add New Contractor
        </button>
    </form>

</div>

<div style="background-color: #f7f7f7; margin: auto; width: 50%; text-align: center; " class="jumbotron">

    <h1>CIS PADS</h1>


    <form method="POST" action="php/PADManager.php">
        <button class="btn btn-primary btn-lg"
                style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; width: 200px;"
                type="submit" name="view-pad" class="btn btn-default">View All PADs
        </button>
        <br>
    </form>

    <form style="margin-top: -20px;" method="POST" action="php/SCManager.php">
        <button class="btn btn-primary btn-lg"
                style=" height: 60px; font-size: 150%; text-align: center; margin-top: 20px; width: 200px;"
                type="submit" name="create-pad" class="btn btn-default">Create New PAD
        </button>
    </form>

    <br>

</div>

<div class="center">
    <br>
    <br>
    <br>
    <?php include("footer.php"); ?>
</div>


</body>
</html>