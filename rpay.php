<?php
require_once '../includes/block_io.php';
//$apiKey = "0239-0c33-4dac-35f3";
//$version = 2; // API version
//$pin = "22333444";
//$block_io = new BlockIo($apiKey, $pin, $version);
$key = $_GET["idseller"];
$sellername = $_GET["seller"];
$receiveusd = $_GET["receiveusd"];
//$receivebtc = $_GET["receivebtc"];
$btcadd = $_GET["btcadress"];

//$pending = $_GET["pending"];
//$removedfrombalance = $sales - $total;
//$url='https://bitpay.com/api/rates';
//$json=json_decode( file_get_contents( $url ) );
//$dollar=$btc=0;


include "header.php";

echo '
<div class="alert alert-danger fade in radius-bordered alert-shadowed"><b>Send payment <span class="glyphicon glyphicon-send"></span></b></div>
  <div class="col-md-5">
 <hr>
<form method="post">
<tr>
<td width="30%">Seller name :</td>
<td width="70%"><input type="text" class="form-control" size="60px" name="username" value="'.$sellername.'" disabled/></td>
</tr>
<tr>
<td width="30%">Amount in USD $ :</td>
<td width="70%"><input type="text" class="form-control" size="60px" name="amount" value="'.$receiveusd.'" disabled/></td>
</tr>
<tr>


<tr>
<td width="30%">BTC address :</td>
<td width="70%"><input type="text" class="form-control" size="60px" name="adbtc" value="'.$btcadd.'" disabled/></td>
</tr><br>
<tr><td colspan="2"><center><input type="submit" class="btn btn-primary" value="Send"/></center></td></tr>
<input type="hidden" name="start" value="work" />
</form>

</center>';
	 
if(isset($_POST['start']) and $_POST['start'] == "work"){
$query = mysqli_query($dbcon, "UPDATE rpayment SET status= 'Paid' WHERE id='$key'"); 
$query = mysqli_query($dbcon, "UPDATE resseller SET withdrawal= '' WHERE withdrawal='requested' and username='$sellername'"); 
   }
?>