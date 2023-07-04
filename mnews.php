<?php
include "header.php";
$uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
$dd = mysqli_query($dbcon,"SELECT * FROM manager WHERE username='$uid'")or die();
$r = mysqli_fetch_assoc($dd);

if($r['role'] != "manager"){
header("location: login.php");
exit ();
}
$q = mysql_query("SELECT * FROM news");
echo "<table  class='table table-bordered table-striped'>
<tr>
<td>Date</td>
<td>Title</td>
<td>Content</td>
<td>Option</td>
</tr>
";
while($r = mysql_fetch_assoc($q)){
echo '
<tr>
<td>'.$r['date'].'</td>
<td>'.$r['title'].'</td>
<td>'.strip_tags(substr($r['content'],0,35)).'</td>
<td></td>
</tr>
';
}
echo '</tabel>'

?>