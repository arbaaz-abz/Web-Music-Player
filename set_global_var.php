<?php
$_POST['sort_by']="album";
$_POST['name']="";
$_POST['submittype']='SORT';
$_POST['submit']='fdsf';

session_start();
$_SESSION['playlist'] = array();
$_SESSION['playlist-path'] = array();
$_SESSION['path'] = "";
$songpath1 = "";
unset($_POST['submit']);
include 'index.php';
?>
