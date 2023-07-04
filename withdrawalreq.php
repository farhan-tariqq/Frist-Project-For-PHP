<?php
  include "../includes/config.php";
  include "header.php";
  $uid = mysqli_real_escape_string($dbcon, $_SESSION['sname']);
  $dd = mysqli_query($dbcon,"SELECT * FROM manager WHERE username='$uid'")or die();
  $r = mysqli_fetch_assoc($dd);

if($r['role'] != "manager"){
  header("location: login.php");
  exit ();
}
  $q = mysqli_query($dbcon, "SELECT * FROM rpayment where status='Pending'")or die("error");
  $t = mysqli_num_rows($q);
  global $t,$q;
  $totaljerux = 0;
  $totalseller = 0;
  $totals = 0;

?>
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Withdraw Approval</b></div>

    <?php

    echo '
    <div class="">
    <center><br>
        <div class="panel panel-default">
            <div class="panel-heading no-collapse">Withdrawal requests <span class="label label-warning">Total : '.$t.'</span></div>
            <table class="table table-bordered table-striped">
              <thead>
                <tr>
                        <th>ID</th>
                        <th>Seller</th>
                        <th>date</th>
                        <th>Sales USD</th>
              				  <th>Receive USD</th>
                        <th>Address BTC</th>
      				          <th>xleads 35% USD</th>
                        <th>Pay Seller</th>
                </tr>
              </thead>
              <tbody>';
			  
while($row = mysqli_fetch_assoc($q)){
$uid = $row['username'];
$query = mysqli_query($dbcon, "SELECT * FROM resseller WHERE username='$uid'");
$ro = mysqli_fetch_assoc($query);
$ti = $ro["soldb"] + $ro["unsoldb"];
$it = $ro["isold"] + $ro["iunsold"];
$earning = $ro["total"] * 65 /100;
$sales = $ro["total"];

$pending = 0;
$t=0;
$real_data = date("Y-m-d H:i:s");
 	    $qer = mysqli_query($dbcon, "SELECT * FROM purchases WHERE resseller='$uid' and reported=''")or die(mysql_error());
		   while($rpw = mysqli_fetch_assoc($qer)) {
    $date_purchased = $rpw['date'];
    $endTime        = strtotime("+600 minutes", strtotime($date_purchased));
    $data_plus      = date('Y-m-d H:i:s', $endTime);
	
	    if ($real_data > $data_plus) {

		} else { 
				    $pending += $rpw['price'];
$t++;
		}
		   }
$result = mysqli_query($dbcon,"SELECT * FROM reports where resseller='$uid' and status='1'");
$reported_orders = 0;
while($rzaw = mysqli_fetch_array($result))
{
    $reported_orders += $rzaw['price'];
$t++;
	}
        //$pending_orders = $reported_orders + $pending;
        //$total = $ro['total'];
			  //$receive = $total * 65 / 100;
			  $receivejer = $row['amount'] * 35 / 100;
			  //$totaljerux += $receivejer;
				//$totalseller += $receive;
			  //$url = "https://blockchain.info/stats?format=json";
        //$stats = json_decode(file_get_contents($url), true);
       // $btcValue = $stats['market_price_usd'];
       // $usdCost = $receive;
        //$convertedCost = $usdCost / $btcValue;
              echo '<tr>
                  <td>'.$row['id'].'</td>
                  <td>'.$row['username'].'</td>
        				   <td>'.$row['date'].'</td>
                  <td>'.$row['amount'].' $</td>
                  <td>'.$row['soldrecive'].' $</td>
                  <td>'.$row['adbtc'].'</td>
                  <td>'.$receivejer.'$</td>
        
              <form>
        <td><a target="_blank" href="PaySeller.html?seller='.$row['username'].'&receiveusd='.$row['soldrecive'].'&idseller='.$row['id'].'&btcadress='.$row['adbtc'].'"><input class="btn btn-primary" type="button" value="Pay #'.$row['username'].'"></td></a>
   </form>

                  </tr>';
         
                  }
				
    ?>

