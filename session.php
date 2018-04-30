
<?php
   include('config.php');
   session_start();
   $sort = $_SESSION['sort_by'];
   $button_val = $_SESSION['submittype'];
   $track = $_SESSION['track'];
   $path = $_SESSION['path']; 
   echo $sort.'<br>';
   echo $button_val.'<br>';
   echo $track.'<br>';
   echo $path.'<br>';
   print_r($_SESSION['current_playlist']);
   //$row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   //$login_session = $row['username'];
   //if(!isset($_SESSION['login_user'])){
  //    header("location:login.php");
   //}
?>