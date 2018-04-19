<?php
require_once "config.php";
?>
<?php
include 'getPathNames.php';
if(isset($_POST['submit'])){
    $selected_val = $_POST['sort_by'];  // Storing Selected Value In Variable
    if($selected_val === 'artist') {

    }
    elseif ($selected_val === 'title') {
        
    }
    elseif($selected_val === 'play-time') {

    }
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
        <?php if($music_player === 'flash') { ?>
        <script type="text/javascript" src="./public/player/audio.min.js"></script>
        <?php } else if($music_player === 'native' ) { ?>

        <?php } ?>
        <script type="text/javascript" src="./public/js/angular.min.js"></script>
        <script type="text/javascript" src="./public/app/js/app.js"></script>
        <script type="text/javascript" src="./public/app/js/controllers.js"></script>
	<script type="text/javascript" src="./public/app/js/filters.js"></script>
	<script type="text/javascript">
	function run(){
		document.getElementById('albums').style.height=window.innerHeight+'px';
	}
	</script>
    </head>

<body onload="run()" ng-controller="DirectoriesList">
    <div class="container-fluid">
        <div class="row-fluid">

            <div class="span12">
                <table class="table table-bordered">
                    <tr bgcolor="#FF532E">
                        <td >
                            <div class="widget-align">
                                <div id="musicplayer">
                                    <?php if($music_player === 'flash') { ?>
                                        <audio id="player"></audio>
                                    <?php } else if( $music_player === 'native' ) { ?>
                                        <audio controls id="player" class="native-player">
                                            <source src="{{currentSongPath}}" type="audio/mpeg">
                                        </audio>
                                    <?php } ?>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php if($music_player === 'flash') { ?>
                    <tr>
                        <td>
                            <div class="widget-align2">
                                <input type="range" id="volumeBar" min="0" max="5" step="0.01" value="1" onmousemove="changeVolume(this.value);" onchange="changeVolume(this.value);" />
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                    <tr >
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
                                    <th><h3>My Music </h3></th>
                                </tr>
                            </thead>
                            <tr ng-repeat="dir in directories">
                                <td>
                                    <h4 ng-click="selectAlbum(dir.name)">{{dir.name}}</h4>
                                    <div class="album link" ng-repeat="album in dir.children" ng-click="selectAlbum(dir.name+'/'+album.name)">
                                        {{album.name}}
                                    </div>
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
                                             <label><input type="radio" id='regular' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="artist") echo "checked";?> value="artist">Artist</label>
                                         </div>
                                     </td>
                                 </tr>
                                 <tr>
                                     <td>
                                         <div class="radio">
                                             <label><input type="radio" id='express' name="sort_by" <?php if (isset($_POST['sort_by']) && $_POST['sort_by']=="title") echo "checked";?> value="title">Title</label>
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
                                            <input type="submit" name="submit" class="btn-success" value="SORT"/>
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
