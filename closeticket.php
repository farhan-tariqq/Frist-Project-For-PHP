<?php
 ob_start();
 date_default_timezone_set('GMT');
session_start();
include "../includes/config.php";

$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$dd = mysqli_query($dbcon,"SELECT * FROM manager WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($dd);

if($r['role'] != "manager"){
header("location: login.php");
exit ();
}
$id = $_GET['id'];
$myid = mysqli_real_escape_string($dbcon, $id);


$get = mysqli_query($dbcon, "SELECT * FROM ticket WHERE id='$myid'");
$row = mysqli_fetch_assoc($get);

$date = date("d/m/Y h:i:s a");
$d = $row['date'];
// Check connection
$date = date("d/m/Y h:i:s a");
  $msg     = '';
$qq = mysqli_query($dbcon, "UPDATE ticket SET memo = CONCAT(memo,'$msg'),status = ('0'),seen='1',lastreply='Admin',lastup='$date' WHERE id='$myid'")or die("mysql error");
  header("location: viewt.php?id=$myid"); 


?>