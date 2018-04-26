<?php
$_POST['sort_by']="album";
$_POST['name']="";
$_POST['submittype']='SORT';
$_POST['submit']='fdsf';
session_start();
$_SESSION['playlist'] = array();
unset($_POST['submit']);
include 'index.php';
?>
