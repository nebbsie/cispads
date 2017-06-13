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
    <h1 style="padding-left: 20px;">CIS PADS
        <small> Create New PAD</small>
    </h1>
</div>


<?php
$today = getdate();

$mday = "mday";
$mon = "mon";
$year = "year";

$day = $today[$mday];
$month = $today[$mon];
$year = $today[$year];

if ($day == 5) {

} else {

    $day = 5;

    $month = $month + 1;

    if ($month == 13) {
        $month = 1;
        $year = $year + 1;
    }

    $day = sprintf("%02d", $day);
    $month = sprintf("%02d", $month);
}

?>


<div class="center">

    <form action="userpage.php">
        <button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit"
                class="btn btn-default">Go Back
        </button>
    </form>

    <form method="post" action="php/PADManager.php" style="background-color: #f7f7f7;"><br>

        <label for="1">Select Contractor:</label>
        <select class="form-control" id="1" name="sc-id-pad" required="true">
            <?php

            $amount = count($_SESSION['result']);

            for ($x = 0; $x < count($result); $x++) {

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
        <input class="form-control" id="2" type="date" name="date-pad" required="true"
               value="<?php echo $year; ?>-<?php echo $month; ?>-<?php echo $day; ?>">

        <label for="3">Gross Amount Paid: </label>
        <input type="text" class="form-control" name="gross-amount-pad" id="3" required="true">

        <label for="4">Material Costs: </label>
        <input type="text" class="form-control" name="material-cost-pad" id="4" required="true">


        <br><br>

        <input class="btn btn-primary btn-lg" type="reset" name=""><br><br>

        <input class="btn btn-primary btn-lg" type="submit" name="create-pad"
               value="Create Pad (Review Before Sending)">

        <br><br>
    </form>

</div>

</body>
<div class="center">
    <br>
    <br>
    <br>
    <?php include("footer.php"); ?>
</div>
</html>