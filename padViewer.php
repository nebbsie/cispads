<?php

	session_start();

?>

<!DOCTYPE html>
<html>
<head>
        <meta charset="utf-8">
	<title>PAD Viever</title>
	<link href="https://fonts.googleapis.com/css?family=Space+Mono" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/pad.css">
	<link href="css/bootstrap.css" rel="stylesheet">
    <link href="css/bootstrap-responsive.css" rel="stylesheet">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.2/jspdf.debug.js"></script>

    <link type="text/javascript" href="javascript/html2canvas.js">
    <link type="text/javascript" href="javascript/jquery-3.1.1.min.js">
    <link type="text/javascript" href="javascript/jspdf.min.js">

</head>
<body>

<div class="center">

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60335399-2', 'auto');
  ga('send', 'pageview');

</script>





<form method="POST" enctype="multipart/form-data" action="php/save.php" id="myForm">
    <input type="hidden" name="img_val" id="img_val" value="" />
</form>


<button onclick="genPDF();" class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center;" type="submit"  class="btn btn-default">Send PAD</button>

<form action="userpage">
<br><br>
		<button class="btn btn-primary btn-lg" style=" font-size: 150%; text-align: center; margin-top: -50px;" type="submit"  class="btn btn-default">Go Back</button>
</form>

<div class="alert alert-warning" role="alert";">Only Click Send PDF once! It will send multiple times if you keep clicking it, <br> This will be fixed very soon!</div>

</div>

<div id="render" style="background-color: white; max-width: 800px; margin: 0 auto; ">
	


<h1>
	Construction Industry Scheme<br>
	Payment and Deduction Statement
</h1>

<br>

<div class="box" style="margin: 0 auto;">

	<div class="left">
		<p style="padding-left: 25px; padding-top: 25px; font-size: 125%;"> <strong>Contractor Details</strong></p>
		<p style="padding-left: 25px";> Contractor's Name </p>

		<div class="textBox"><p class="innerBox">D Nebbs Building Contractors Ltd.</p></div>
		<div class="textBox"></div><br>

		<p style="padding-left: 25px";> Contractor's Address </p>

		<div class="textBox"><p class="innerBox">53 Durham Road</p></div>
		<div class="textBox"><p class="innerBox">GILLINGHAM, Kent</p></div>
		<div class="textBox"><p class="innerBox">ME8 0JN</p></div>
	</div>

	<div class="right">
		<br><br><br><br>
		<p style="padding-left: 25px; padding-right: 25px"> Payment and Deduction Made in tax month ended</p>

		<p style="padding-left: 25px; font-style: italic;"></p>
		<div class="textBox"><p class="innerBox"><?php echo $_SESSION["pad-day"] . " " . $_SESSION["pad-month"] . " " . $_SESSION["pad-year"] ; ?></p></div><br>

		<p style="padding-left: 25px";> Employer's Tax Reference </p>
		<div class="textBox"><p class="innerBox">577 / LZ26446</p></div>

	</div>
	
</div>
<br><br>
<div class="box" style="height: 450px; margin: 0 auto;">

	<div class="left">
		<p style="padding-left: 25px; padding-top: 25px; font-size: 125%;"> <strong>Subcontractor Details</strong></p>
		<p style="padding-left: 25px";> Subcontractor's Full Name </p>

		<div class="textBox"><p class="innerBox"><?php echo $_SESSION["pad-view-name"]; ?></p></div>
		<div class="textBox"></div><br>

		<p style="padding-left: 25px";> Unique Taxpayer Reference (UTR) </p>

		<div class="textBox"><p class="innerBox">
		<?php 
			if($_SESSION['pad-isHigher'] != 1){
			}else{
				echo $_SESSION["pad-view-taxRef"];
			}
		?>
			
		</p></div>

		<br>

		<p style="padding-left: 25px";> Verification Number* </p>
		<div class="textBox"><p class="innerBox"><?php echo $_SESSION["pad-view-verNumber"]?></p></div>

	</div>

	<div class="right">
		<br><br>
		<p style="padding-left: 25px; padding-right: 25px"> Gross Amount Paid (Excl VAT) (A)</p>
		<div class="textBox"><p class="innerBox"> £ <?php echo $_SESSION["pad-gross"]; ?> </p></div><br>

		<p style="padding-left: 25px";> Less Cost Of Materials </p>
		<div class="textBox"><p class="innerBox"> £ <?php echo $_SESSION["pad-materials"]; ?></p></div>

		<br>

		<p style="padding-left: 25px";> Amount Liable To Deduction </p>
		<div class="textBox"><p class="innerBox"> £ <?php echo $_SESSION["pad-liable"]; ?></p></div>

		<br>

		<p style="padding-left: 25px";> Amount Deducted(B) </p>
		<div class="textBox"><p class="innerBox"> £ <?php echo $_SESSION["pad-deducted"]; ?></p></div>

		<br>

		<p style="padding-left: 25px";> Amount Payable(A-B) </p>
		<div class="textBox"><p class="innerBox"> £ <?php echo $_SESSION["pad-payable"]; ?></p></div>

	</div>
	
</div>



<p style="text-align: center;"><strong>Subcontractors – Please keep this document safe</strong></p>


</div>

<div class="center">
<br>
<br>
<br>
<?php include("footer.php"); ?>
 </div>

<script type="text/javascript">
	
	function genPDF(){
		html2canvas(document.getElementById("render"),{
			onrendered: function (canvas){
				var img = canvas.toDataURL("image/jpg");
				document.getElementById("img_val").value = img;
				document.getElementById("myForm").submit();
			}
		} );
	}


</script>
																													

</body>
</html>