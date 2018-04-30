<?php
	$result="";
	session_start();
	if(isset($_POST['save'])) {
		$filename = "playlists/".$_POST['filename'].".txt";
		$handle = fopen($filename, 'wb') or die('Cannot open file:  '.$filename);
		for($i = 0; $i < count($_SESSION['playlist']); $i++) {
			$songName = $_SESSION['playlist'][$i]."|".$_SESSION['playlist-path'][$i];
			fwrite($handle,$songName);
		}
		fclose($handle);
		header("location: set_global_var.php");
	}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Contact V10</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->
	<link rel="icon" type="image/png" href="Save/images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/vendor/animate/animate.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="Save/css/util.css">
	<link rel="stylesheet" type="text/css" href="Save/css/main.css">
<!--===============================================================================================-->
</head>
<body>


	<div class="container-contact100">

		<div class="wrap-contact100">
			<form class="contact100-form validate-form" action="save_playlist.php" method="post">
				<span class="contact100-form-title">
					Save My Playlist
				</span>
				<?php echo $result; ?>
				<div class="wrap-input100 validate-input" data-validate="Please enter your name">
					<input class="input100" type="text" name="filename" placeholder="Choose a name">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input50">
					
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" name="save">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Save !
						</span>
					</button>
				</div>
				<a href="set_global_var.php">Home</a>
			</form>
		</div>
	</div>



	<div id="dropDownSelect1"></div>

<!--===============================================================================================-->
	<script src="Save/vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="Save/vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="Save/vendor/bootstrap/js/popper.js"></script>
	<script src="Save/vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="Save/vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="Save/vendor/daterangepicker/moment.min.js"></script>
	<script src="Save/vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="Save/vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="Save/js/main.js"></script>

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-23581568-13');
</script>

</body>
</html>
