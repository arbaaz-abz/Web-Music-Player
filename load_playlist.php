<?php
	session_start();
	$result="";
	if(isset($_POST['open'])) {
		//Check If the File Exists or not 
		$test = $_POST['filename'].".txt";
		$dir = 'C:/xampp/htdocs/FS Project/fs/playlists/';
		$temp = scandir($dir);
		$playlist_files = array();
		for($i = 0; $i < count($temp); $i++) {
			if($i==0 || $i==1) continue;
			array_push($playlist_files,$temp[$i]);
		}
		for($i = 0; $i < count($playlist_files); $i++) {
			if($playlist_files[$i] === $test ) {
				$_SESSION['current_playlist'] = $_POST['filename'];
				$_SESSION['current_playlist_path'] = "playlists/".$_POST['filename'].".txt";
				
				header("location: index.php");
			}							
		} 
		$result='<div class="alert alert-danger"><strong>No such Playlist Exists , Try Again !</strong></div>';
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
			<form class="contact100-form validate-form" action="load_playlist.php" method="post">
				<span class="contact100-form-title">
				MY PLAYLISTS
				</span>
					<?php echo $result; ?>
					<?php

						//DISPLAY all the playlists in the directory

						$dir = 'C:/xampp/htdocs/FS Project/fs/playlists/';
						$temp = scandir($dir);
						if(is_null($temp[2])) {
							?>
							<span class="wrap-input50 contact100-form-tracks">
							<?php
								echo "NO PLAYLISTS CREATED YET !";
							?>
							</span>
							<?php
						}
						else {
							$playlist_files = array();
							for($i = 0; $i < count($temp); $i++) {
								if($i==0 || $i==1) continue;
								array_push($playlist_files,$temp[$i]);
							}
							for($i = 0; $i < count($playlist_files); $i++) {
								?>
								<span class="wrap-input50 contact100-form-tracks">
								<?php
									echo $playlist_files[$i];
								?>
								</span>
								<?php 
								
							}
						}
					?>
				<br><br>
				<div class="wrap-input100 validate-input" data-validate="Which Playlist">
					<input class="input100" type="text" name="filename" placeholder="Which Playlist ?">
					<span class="focus-input100"></span>
				</div>

				<div class="wrap-input50">
					
				</div>

				<div class="container-contact100-form-btn">
					<button class="contact100-form-btn" name="open">
						<span>
							<i class="fa fa-paper-plane-o m-r-6" aria-hidden="true"></i>
							Open !
						</span>
					</button>
				</div>
				<a href="index.php">Home</a>
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
