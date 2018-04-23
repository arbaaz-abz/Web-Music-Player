<?php
require_once "config.php";
include 'getPathNames.php';
?>

<!DOCTYPE html>
<html lang="en" ng-app>
<head>
	<meta charset="utf-8">

	<script type="text/javascript">
		var playlistsongs =  [];
	</script>

	<link rel="stylesheet" href="./public/css/app.css">
	<link rel="stylesheet" href="./public/css/bootstrap.css">
	<script type="text/javascript" src="./public/app.php?view=jsobject"></script>
	<script type="text/javascript" src="./public/app/js/appPlayer.js"></script>
	<script type="text/javascript" src="./public/player/audio.min.js"></script>
	<script type="text/javascript" src="./public/js/angular.min.js"></script>
	<script type="text/javascript" src="./public/app/js/app.js"></script>
	<script type="text/javascript" src="./public/app/js/controllers.js"></script>
	<script type="text/javascript" src="./public/app/js/filters.js"></script>
</script>
</head>
<body>
	<div class="container-fluid">
		<div class="row-fluid">
			<div class="span12">
				<table class="table table-bordered">
					<tr bgcolor="#FF532E">
						<td >
							<div class="widget-align">
								<div id="musicplayer"><center>
									<audio controls id="player" class="native-player">
										<source src="{{currentSongPath}}" type="audio/mpeg">
										</audio></center>
									</div>
								</div>
							</td>
						</tr>
						<td >
							<div class="wrapper">
								<div class="btn " ng-click="addAllSongs(directorysongs)" >Add All</div>
								<div class="btn" ng-click="deleteAllSongs()">Clear playlist</div>
							</div>
						</td>
					</tr>
					<tr>
						<th><h3>Songs</h3></th>
					</tr>
					<tr ng-repeat="song in directorysongs">
						<td ng-click="addSong(song)" class="link">
							{{song.name}}
						</td>
					</tr>
				</table>

				<div class = "row-fluid">
					<div class="span4" id="albums">
						<table class="table table-bordered">
							<thead>
								<tr bgcolor="#FF532E">
									<th><h3>Sorted by <?php echo $selected_val?> </h3></th>
								</tr>
							</thead>
							<tr>
								<td>
									<form action="index.php" method="post">
										<select name="type" id="type">
											<?php

											if(isset($_POST['submittype'])){
										    $selected_val = $_POST['sort_by'];  // Storing Selected Value In Variable
										    if($selected_val === 'Artist') {
										    	$names = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index_sort.txt');
										    	foreach ($names as $name) { 
										    		$artist = explode("|", $name);
										    		$name = $artist[0]." - ".$artist[1];
										    		echo $name;
										    		?>
										    		<option value="<?= $name ?>"> <?= $name ?> </option>
										    		<?php 
										    	}

										    }
										    elseif ($selected_val === 'Album') {
										    	$names = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\album_index_sort.txt');
										    	foreach ($names as $name) { 
										    		$album = explode("|", $name);
										    		$name = $album[0]." - ".$album[1];

										    		?>
										    		<option value="<?= $name ?>"> <?= $name ?> </option>
										    		<?php 
										    	}

										    }
										    elseif($selected_val === 'Play-time') {
										    	$playtimename = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index_sort.txt');

										    	foreach ($names as $name) { 
										    		$album = explode("|", $name);
										    		$name = $album[0]." - ".$album[1];
										    		?>
										    		<option value="<?= $name ?>"> <?= $name ?> </option>
										    		<?php 
										    }
										}
									}
									?>
									</form>
								</td>
							</tr>
						</table>
					</div>

					<div class="span4" >
						<table class="table table-bordered">
							<thead>
								<tr bgcolor="#FF532E">
									<th><h3>Playlist</h3></th>
								</tr>
							</thead>
							<tr >
								<td >
									<div class = "wrapper">
										<div class="btn" ng-click="addAllSongs(directorysongs)" >Save Playlist</div>
										<div class="btn" ng-click="deleteAllSongs()">Rename Playlist</div>
									</div>
								</td>
							</tr>
							<tr ng-repeat="song in playlistsongs">
								<td class="link">
									<div class="song current" ng-show="$index==currentSongIndex">{{song.name}}</div>
									<div class="song" ng-show="$index!=currentSongIndex">
										<span ng-click="playSong($index)">{{song.name}}</span>
										<span ng-click="deleteSong($index)" class="delete icon-trash"></span>
									</div>
								</td>
							</tr>
						</table>
					</div>
					<div class="span4" >
						<table class="table table-bordered">
							<thead>
								<tr bgcolor="#FF532E">
									<th><h3>Sort By</h3></th>
								</tr>
							</thead>
							<tbody>
								<form action="index.php" method="post">
									<tr>
										<td>
											<div class="radio">
												<label><input type="radio" id='regular' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="artist") echo "checked";?> value="Artist">Artist</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="radio">
												<label><input type="radio" id='express' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="album") echo "checked";?> value="Album">Album</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="radio">
												<label><input type="radio" id='express' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="Play-time") echo "checked";?> value="Play-time">Play-Time</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="wrapper">
												<input type="submit" name="submittype" class="btn-success" value="SORT"/>
											</div>
										</td>
									</tr>
								</form>
								<tr >

								</tr>
							</tbody>


						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
	<script type="text/javascript">
		var currentSongIndex = 0;

		if(config.musicPlayer == 'flash') {
			appPlayer.player = audiojs.newInstance(document.getElementById("player"));
		} else if( config.musicPlayer == 'native'){
			appPlayer.player = appPlayer.nativePlayer();
		}

		function changeVolume(n) {
			var player = document.getElementById("player");
			player.volume = n;
		}
	</script>

</body>
</html>
