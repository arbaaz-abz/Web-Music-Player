<?php
require_once "config.php";
$return = array();
function scanFolders($dir){
    global $exclude_dirs;
    $dirs = array();

    if(!is_readable($dir)){
        return $dirs;
    }
    $dir = 'C:/xampp/htdocs/FS Project/fs/library/My Music/';
    $myfile = fopen("track_paths.txt", "w") or die("Unable to open file!");
    $list = scandir($dir);
    $i=0;
    foreach($list as $value){
        if(!($i==0 || $i==1)) {
            fwrite($myfile, $dir.$value.PHP_EOL);
        }
        $i++;
    }
    fclose($myfile);
    /*
    foreach($list as $row){
        if(is_dir($dir.$row) && !in_array($row, $exclude_dirs)){
            $dirs[$row] = array(
                "name" => $row,
                "children" => scanFolders($dir . $row."/")
            );
        }
    }
    return $dirs;
    //echo "<pre>".print_r($list, true)."</pre>";
    */
}
$dirs = scanFolders($library1);
/*
if($dynamic_dir_scan === true){
    echo json_encode($dirs);
}else{
    if(is_writable($root."public/cache/directories.json")){
        $file_handler = fopen($root."public/cache/directories.json", "w+");
        fwrite($file_handler, json_encode($dirs));
        fclose($file_handler);
    }
}
*/
?>
