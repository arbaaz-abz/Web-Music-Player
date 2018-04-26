<?php
require_once "config.php";
include 'getPathNames.php';
$title = "";
session_start(); 
if(isset($_POST['type'])) {
	$title_extract = explode(" - ", $_POST['type']);
    //Add current track to session playlist array
    if(!isset($_SESSION['playlist'])) {
    	$_SESSION['playlist'] = array();
    	array_push($_SESSION['playlist'],$title_extract[1]);
    } 
    else {
    	array_push($_SESSION['playlist'],$title_extract[1]);
    	//Make the session playlist array unique     
	    $playlist_array = array_unique($_SESSION['playlist']);
	    $_SESSION['playlist'] = array_unique($playlist_array);
	}
	//Get session variables
    $_SESSION['title'] = $_POST['type'];  
    $title = $_SESSION['title'];               		
    $selected_val = $_SESSION['sort_by']; 
	$_POST['submittype'] = $_SESSION['submittype'];
	$_POST['sort_by'] = $selected_val;
	$path = "";

	//Find path of current track & add it to a session variable
	if ($selected_val === 'artist') {
		$myfile = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index_sort.txt');
		$i=0;
		foreach ($myfile as $line) { 
			$artist = explode("|", $line);
			if($i === 0) {
				$i++;
				continue;
			}
			$line = $artist[1];
			if($line===$title_extract[1]) {
				$path = $artist[2];
				break;
			}    
		}
		$_SESSION['path'] = $path;
	}
	elseif ($selected_val === 'album') {
		$myfile = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\album_index_sort.txt');
		$i=0;
		foreach ($myfile as $line) { 
			$artist = explode("|", $line);
			if($i === 0) {
				$i++;
				continue;
			}
			$line = $artist[1];
			if($line===$title_extract[1]) {
				$path = $artist[2];
				break;
			}  
		}
		$_SESSION['path'] = $path;
	}
	if ($selected_val === 'play-time') {
		$myfile = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index_sort.txt');
		$i=0;
		foreach ($myfile as $line) { 
			$artist = explode("|", $line);
			if($i === 0) {
				$i++;
				continue;
			}
			$line = $artist[1];
			if($line===$title_extract[1]) {
				$path = $artist[2];
				break;
			}  
		}
		$_SESSION['path'] = $path;
	}									
	$_SESSION['track'] = $_POST['type'];
}
if(isset($_POST['clear-playlist'])) {
	unset($_SESSION['playlist']);
	$selected_val = $_SESSION['sort_by']; 
	$_POST['submittype'] = $_SESSION['submittype'];
	$_POST['sort_by'] = $selected_val;
	$path = "";
}
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
                            <div id="musicplayer">
                                    <?php if($music_player === 'flash') { ?>
                                        <audio id="player"></audio>
                                    <?php } else if( $music_player === 'native' ) { ?>
                                        <audio controls id="player" class="native-player">
                                            <source src="{{currentSongPath}}" type="audio/mpeg">
                                        </audio>
                                    <?php } ?>
                            </div>
                        </td>
                    </tr>
                    <?php if($music_player === 'flash') { ?>
                    <tr>
                        <td>
                            <div class="widget-align	2">
                                <input type="range" id="volumeBar" min="0" max="5" step="0.01" value="1" onmousemove="changeVolume(this.value);" onchange="changeVolume(this.value);" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr>
						<td >
							<div class="wrapper">
								<form action="index.php" method="post">
									<button type="submit" name="clear-playlist" class="btn" formaction="index.php">Clear Playlist</button>
								</form>								
							</div>
						</td>
					</tr>
					<tr bgcolor="#FF532E">
						<th><h3>Songs</h3></th>
					</tr>
					<tr ng-repeat="song in directorysongs">
						<td ng-click="addSong(song)" class="link">
							{{song.name}}
						</td>
					</tr>
					<tr>
						<td>

							<?php 
								//Display Songs from the local Playlist array
								if(!empty($_SESSION['playlist'])) {
									for($i = 0; $i < count($_SESSION['playlist']); $i++) {
									    echo $_SESSION['playlist'][$i].'<br>';
									}
								}
							?>
						</td>
					</tr>
				</table>

				<div class = "row-fluid">
					<div class="span4" id="albums">
						<table class="table table-bordered">
							<thead>
								<tr bgcolor="#FF532E">
									<th><h3>My Music</h3></th>

								</tr>
							</thead>
									<form action="index.php" method="post">
										<tr>
										<td>
										<select name="type" id="type">
											<?php
											//$_SESSION['track'] = $_POST['type'];
											if(isset($_POST['submittype'])) {

												//Display The Songs based on SORT criteria

												if(isset($_POST['sort_by'])) {
											    	$selected_val = $_POST['sort_by'];
											    	//session_start();
											    	$_SESSION['sort_by'] = $selected_val;
											    	$_SESSION['submittype'] = $_POST['submittype'];
											    }  // Storing Selected Value In Variable

											    if($selected_val === 'artist') {
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
											    elseif ($selected_val === 'album') {
											    	$names = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\album_index_sort.txt');
											    	foreach ($names as $name) { 
											    		$album = explode("|", $name);
											    		$name = $album[0]." - ".$album[1];

											    		?>
											    		<option value="<?= $name ?>"> <?= $name ?> </option>
											    		<?php 
											    	}

											    }
											    elseif($selected_val === 'play-time') {
											    	$names = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index_sort.txt');
											    	foreach ($names as $name) { 
											    		$play = explode("|", $name);
											    		$name = $play[0]." - ".$play[1];
											    		?>
											    		<option value="<?= $name ?>"> <?= $name ?> </option>
											    		<?php 
											    	}
												}
											}
											else {
												?>
												
												<?php
											}
											?>
										    </td>
											</tr>
											<tr>
												<td>
													<div class="wrapper">
														<input type="submit" name="submit" class="btn-success" value="PLAY SONG"/>
													</div>
												</td>
											</tr>
									</form>
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
												<label><input type="radio" id='regular' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="artist") echo "checked";?> value="artist">Artist</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="radio">
												<label><input type="radio" id='express' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="album") echo "checked";?> value="album">Album</label>
											</div>
										</td>
									</tr>
									<tr>
										<td>
											<div class="radio">
												<label><input type="radio" id='express' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="play-time") echo "checked";?> value="play-time">Play-Time</label>
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

