<?php
    require_once('C:\xampp\htdocs\FS Project\fs\sort_by\getid3\getid3.php');
    $getID3 = new getID3;
    $file = '';
    //Creating Index filesize(filename)
    $myfile = fopen('C:\xampp\htdocs\FS Project\fs\track_paths.txt', "r") or die("Unable to open file!");
    $artist_index = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index.txt','w') or die("Unable to open file !");
    $album_index = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\album_index.txt','w') or die("Unable to open file !");
    $play_time_index = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index.txt','w') or die("Unable to open file !");
    while (!feof($myfile)) {
       $file = trim((string)fgets($myfile));
       if(feof($myfile)) break;
       $ThisFileInfo = $getID3->analyze($file);
       getid3_lib::CopyTagsToComments($ThisFileInfo);

       //print_r($ThisFileInfo);
       
       echo 'File name: '.$ThisFileInfo['filenamepath'].'<br>';
       echo 'Artist: '.(!empty($ThisFileInfo['comments_html']['artist']) ? implode('<BR>', $ThisFileInfo['comments_html']['artist']) : '&nbsp;').'<br>';
       echo 'Title: '.(!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title'])  : '&nbsp;').'<br>';
       echo 'Album: '.(!empty($ThisFileInfo['comments_html']['album']) ? implode('<BR>', $ThisFileInfo['comments_html']['album'])  : '&nbsp;').'<br>';
       echo 'Bitrate: '.(!empty($ThisFileInfo['audio']['bitrate']) ? round($ThisFileInfo['audio']['bitrate'] / 1000).' kbps'   : '&nbsp;').'<br>';
       echo 'Play time: '.(!empty($ThisFileInfo['playtime_string']) ? $ThisFileInfo['playtime_string']                          : '&nbsp;').'<br>';
       echo '<br><br>';


       $str_artist = PHP_EOL.(!empty($ThisFileInfo['comments_html']['artist']) ? implode('<BR>', $ThisFileInfo['comments_html']['artist']) : '')."|".(!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title'])  : '&nbsp;')."|".$ThisFileInfo['filenamepath'];
       $str_playtime = PHP_EOL.(!empty($ThisFileInfo['playtime_string']) ? $ThisFileInfo['playtime_string'] : '')."|".(!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title'])  : '&nbsp;')."|".$ThisFileInfo['filenamepath'];
       $str_album = PHP_EOL.(!empty($ThisFileInfo['comments_html']['album']) ? implode('<BR>', $ThisFileInfo['comments_html']['album'])  : '')."|".(!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title'])  : '&nbsp;')."|".$ThisFileInfo['filenamepath'];

       if($str_artist === "" || $str_artist === "\n") continue;


       fwrite($artist_index,$str_artist);
       fwrite($play_time_index,$str_playtime);
       fwrite($album_index,$str_album);

    }
    fclose($myfile);
    fclose($artist_index);
    fclose($album_index);
    fclose($play_time_index);

    //Sorting 

    $artist_index_sort = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index_sort.txt','wb') or die("Unable to open file !");
    $album_index_sort = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\album_index_sort.txt','wb') or die("Unable to open file !");
    $play_time_index_sort = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index_sort.txt','wb') or die("Unable to open file !");


    $artistname = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index.txt');
    sort($artistname);
    foreach ($artistname as $names) {
      fwrite($artist_index_sort,$names);
    }

    $albumname = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\album_index.txt');
    sort($albumname);
    foreach ($albumname as $names) {
      fwrite($album_index_sort,$names);
    }

    $playtimename = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index.txt');
    sort($playtimename);
    foreach ($playtimename as $names) {
      fwrite($play_time_index_sort,$names);
    }

 ?>