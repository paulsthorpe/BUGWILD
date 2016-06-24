<?php include '/includes/header.php' ?>
<?php 
  if(!$_SESSION['cart']['order']){
    $_SESSION['cart']['order'] = [];
  }

  if(isset($_POST['submit'])){
  //save special intructions for later use and storage in database
    $instructions = $database->escape_string($_POST['order_instructions']);
    $_SESSION['cart']['order']['special_instructions']=$instructions;
  }

?>
<body>
  <div class="container">
    <div class="row">
      <h1>Order Details</h1>
      <form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">
        <input type="hidden" name="cmd" value="_cart">
        <input type="hidden" name="business" value="paulsthorpe-facilitator@yahoo.com">
        <table class="table table-striped">
          <thead>
            <tr class="table-header">        
               <th>Product</th>
               <th>Price Each</th>
               <th>Color</th>
               <th>Quantity</th>
               <th>Sub-total</th>
            </tr>
          </thead>
          <tbody>
          <?php 
            $subtotal = 0;
            $item_total = 0;
            $item_name = 1;
            $item_number = 1;
            $item_amount = 1;
            $item_quantity = 1;
            foreach ($_SESSION['cart']['products'] as $index => $object) {
              $object->ordered_subtotal = $object->price_each * $object->selected_quantity;
              $cart_item = <<<CART_ITEM
              <tr>
                <td>$object->title</td>
                <td>$object->price_each</td>
                <td>$object->selected_color</td>
                <td>$object->selected_size</td>
                <td>$object->selected_quantity</td>
                <td>$object->ordered_subtotal</td>
              </tr>
                <input type="hidden" name="item_name_{$item_number}" value="$object->title Color: $object->selected_color Size: $object->selected_size">
                <input type="hidden" name="amount_{$item_amount}" value="$object->price_each">
                <input type="hidden" name="quantity_{$item_quantity}" value="$object->selected_quantity">
CART_ITEM;
              echo $cart_item;
              $subtotal += $object->ordered_subtotal;
              $item_total += $object->selected_quantity;
              $item_name ++;
              $item_number ++;
              $item_amount ++;
              $item_quantity ++;
          }//end foreach
          ?>
          </tbody>
        </table>
          <?php 
          $shipping = <<<SHIPPING
          <input type="hidden" name="item_name_$item_number" value="Shipping">
          <input type="hidden" name="amount_$item_amount" value="7.00">
SHIPPING;
          echo $shipping;
          ?>
    </div>
<!--  ***********CART TOTALS*************-->
      <div class="row">
        <div class="col-lg-4">
          <h2>Cart Totals</h2>
          <table class="table table-bordered" cellspacing="0">
            <tr class="cart-items">
              <th>Items:</th>
              <td><span class="amount"><?php echo $item_total ?></span></td>
            </tr>
            <tr class="order-total">
              <th>Items Total Price</th>
              <td><strong><span class="amount">$<?php echo $subtotal ?></span></strong> </td>
            </tr>
            <tr class="shipping">
              <th>Shipping and Handling</th>
              <td>$7.00 Flat Rate Insured</td>
            </tr>
            <tr class="order-total">
              <th>Order Total</th>
              <td><strong><span class="amount">$<?php echo ($subtotal + 7) ?></span></strong> </td>
            </tr>
          </table>
        </div><!-- CART TOTALS-->
        <br></br><br></br>
        <div class="col-lg-8">

        <?php 

        $message = $_SESSION['cart']['order']['special_instructions'] ==='' ? "<h2>You Have Not Included Special Instructions <br> Go <a href='checkout.php' >Here</a> if you wish to add some.</h2>" : $_SESSION['cart']['order']['special_instructions'];

        echo "<pre><h1>Special Instructions</h1>". $message ."</pre>"; 

        ?>

        </div>
      </div>  <!-- row -->

        <input type="image" name="upload" src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif" alt="PayPal - The safer, easier way to pay online">
      </form>
  </div><!--Main Content-->

</body>
<?php 

$itemList = '';

foreach ($_SESSION['cart']['products'] as $index => $object) {

    $object->ordered_subtotal = $object->price_each * $object->selected_quantity;

    $cart_item = <<<CART_ITEM
    <tr>
      <td>$object->title</td>
      <td>$object->price_each</td>
      <td>$object->selected_color</td>
      <td>$object->selected_quantity</td>
      <td>$object->ordered_subtotal</td>
    </tr>
CART_ITEM;

    $itemList .= $cart_item . '<br>';
  }

  $_SESSION['cart']['order']['order_amount'] = $subtotal;

  $_SESSION['cart']['order']['items'] = $itemList;

?>

<?php include '/includes/footer.php' ?>
