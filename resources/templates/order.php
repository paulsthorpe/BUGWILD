<?php 
//if order is specifed in GET request, display that products information
if(isset($_GET['order_number'])){
	$order = Orders::find_order_by_no($_GET['order_number']);
}
?>
    <br></br>
    <br></br>
    <?php 
    echo "<h1>ORDER NUMBER : ". $order->order_no ."</h1>"; 
    if($order->pending_shipped == 0){
      echo "<h2 style=\"color:red;\">PENDING SHIPMENT</h2> ";
    } elseif ($order->pending_shipped == 1){
      echo "<h2 style=\"color:green;\">SHIPPED</h2> ";
    }
    ?>
    <br></br>
    <br></br>
    <table class="table table-striped">
      <thead>
        <tr class="table-header">        
           <th>Product</th>
           <th>Price Each</th>
           <th>Color</th>
           <th>Size</th>
           <th>Quantity</th>
        </tr>
      </thead>
      <tbody>
      <?php echo $order->items; ?>
      </tbody>
      	<tr class="table-header">        
	       <th>Order Date</th>
	       <th>Order Amount</th>
	       <th>Amt Recieved From Paypal</th>
	       <th>PaylPal Trans ID</th>
	       <th>PayPal Status</th>
        </tr>
        <tr>
<?php
$order_details = <<<DETAILS
        	<td>$order->order_month / $order->order_day / $order->order_year</td>
        	<td>$order->order_amount</td>
        	<td>$order->paypal_total</td>
        	<td>$order->trans_id</td>
        	<td>$order->paypal_status</td>
DETAILS;
echo $order_details;
?>
        </tr>
      </table>
      <h3>Special Instructions</h3>
      <pre><?php echo $order->special_instructions; ?></pre>