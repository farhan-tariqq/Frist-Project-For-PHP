<?php
include "./header.php";
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$q = mysqli_query($dbcon,"SELECT * FROM manager WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($q);

if($r['role'] != "manager")
{
  header("location: login.php");
  exit ();
}
?>