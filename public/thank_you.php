<?php 
include '/includes/header.php';


$order = new Orders();
//if(isset($_GET['tx'])){
$items = $_SESSION['cart']['order']['items'];
$order->order_day 		  = date('d');
$order->order_month 	  = date('m');
$order->order_year		  = date('Y');
$order->order_amount 		  = $_SESSION['cart']['order']['order_amount'];
$order->pending_shipped       = 0;
$order->items                 = $items;
$order->special_instructions  = $_SESSION['cart']['order']['special_instructions'];
// $order->trans_id              = $_GET['tx'];
// $order->paypal_total          = $_GET['amt'];
// $order->paypal_status 		  = $_GET['st'];
$order->save();
//}
?>
<h1>Thanks for Ordering with Bugwild Fly Co.</h1>
<p>Your Payment has been processed through Paypal, your flies will be shipped once they are tied <br>
</p>
<h2>Order Summary: <br> </h2>
<?php 
$item_list = $_SESSION['cart']['order']['items'];
echo "<br></br>";
echo "Order recieved on : ".date('M')." ".date('d')." ".date('Y')."<br>";
echo "<br></br>";
echo "Your Order: $ ".$_SESSION['cart']['order']['order_amount']."<br>";
echo "<br></br>";
echo "Your Special Instructions Were: "."<br></br>".$_SESSION['cart']['order']['special_instructions']."<br>";

unset($_SESSION['cart']);
