<?php
    require_once('C:\xampp\htdocs\FS Project\fs\sort_by\getid3\getid3.php');
    $getID3 = new getID3;
    $file = '';
    //Creating Index filesize(filename)
    $myfile = fopen('C:\xampp\htdocs\FS Project\fs\track_paths.txt', "r") or die("Unable to open file!");
    $artist_index = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index.txt','w') or die("Unable to open file !");
    $title_index = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\title_index.txt','w') or die("Unable to open file !");
    $play_time_index = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time.txt','w') or die("Unable to open file !");
    while (!feof($myfile)) {
       $file = trim((string)fgets($myfile));
       if(feof($myfile)) break;
       $ThisFileInfo = $getID3->analyze($file);
       getid3_lib::CopyTagsToComments($ThisFileInfo);
       echo 'File name: '.$ThisFileInfo['filenamepath'].'<br>';
       echo 'Artist: '.(!empty($ThisFileInfo['comments_html']['artist']) ? implode('<BR>', $ThisFileInfo['comments_html']['artist']) : '&nbsp;').'<br>';
       echo 'Title: '.(!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title'])  : '&nbsp;').'<br>';
       echo 'Bitrate: '.(!empty($ThisFileInfo['audio']['bitrate']) ? round($ThisFileInfo['audio']['bitrate'] / 1000).' kbps'   : '&nbsp;').'<br>';
       echo 'Play time: '.(!empty($ThisFileInfo['playtime_string']) ? $ThisFileInfo['playtime_string']                          : '&nbsp;').'<br>';
       echo '<br><br>';
       $str_artist = PHP_EOL.(!empty($ThisFileInfo['comments_html']['artist']) ? implode('<BR>', $ThisFileInfo['comments_html']['artist']) : '')." | ".$ThisFileInfo['filenamepath'];
       $str_playtime = PHP_EOL.(!empty($ThisFileInfo['playtime_string']) ? $ThisFileInfo['playtime_string'] : '')." | ".$ThisFileInfo['filenamepath'];
       $str_title = PHP_EOL.(!empty($ThisFileInfo['comments_html']['title']) ? implode('<BR>', $ThisFileInfo['comments_html']['title'])  : '')." | ".$ThisFileInfo['filenamepath'];
       if($str_artist === "" || $str_artist === "\n") continue;
       fwrite($artist_index,$str_artist);
       fwrite($play_time_index,$str_playtime);
       fwrite($title_index,$str_title);

    }
    fclose($myfile);
    fclose($artist_index);
    fclose($title_index);
    fclose($play_time_index);

    //Sorting 

    $artist_index_sort = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index_sort.txt','wb') or die("Unable to open file !");
    $title_index_sort = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\title_index_sort.txt','wb') or die("Unable to open file !");
    $play_time_index_sort = fopen('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index_sort.txt','wb') or die("Unable to open file !");


    $artistname = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\artist_index.txt');
    sort($artistname);
    foreach ($artistname as $names) {
      fwrite($artist_index_sort,$names);
    }

    $titlename = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\title_index.txt');
    sort($titlename);
    foreach ($titlename as $names) {
      fwrite($title_index_sort,$names);
    }

    $playtimename = file('C:\xampp\htdocs\FS Project\fs\sort_by\index_files\play_time_index.txt');
    sort($playtimename);
    foreach ($playtimename as $names) {
      fwrite($play_time_index_sort,$names);
    }

 ?>