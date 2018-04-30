<?php 
    header("Content-Type: audio/mp3");
    echo file_get_contents("C:\\xampp\\htdocs\\FS Project\\fs\\library\\My Music\\" . $_GET["name"]); 
?>