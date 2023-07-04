<?php
include "header.php";
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$dd = mysqli_query($dbcon,"SELECT * FROM manager WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($dd);

if($r['role'] != "manager"){
header("location: login.php");
exit ();
}
?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"> <b>News Manager</b></div>
 <div class="col-md-5">
<b><font color="#000">Seller News ></font></b><br>

<form method="post">
      Content :
<textarea name="new" class="form-control" required></textarea>
<br>
<input type="submit" class='btn btn-danger' value="Add >>" />
<input type="hidden" name="sub" value="news"/>
</form>
</center>
<?php

if(isset($_POST['sub']) and $_POST['sub'] == "news"){
  $news = mysqli_real_escape_string($dbcon, $_POST['new']);
  $date = date("Y/m/d h:i:s");
  $q = mysqli_query($dbcon, "INSERT INTO newseller
  (title,content,date)
  VALUES
  ('NEWS Seller','$news','$date')
  ")or die("error contact sql");
  if($q){
    echo "<br><center><b><font color='Green'>News Added </font></b></center>";
  }else{
   echo "<br><center><b><font color='red'>News not Added </font></b></center>";
  }
}
