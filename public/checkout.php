<?php include '/includes/header.php' ?>
<body>
  <div class="container">
    <div class="row">
      <h1>Checkout</h1>
        <table class="table table-striped">
          <thead>
            <tr class="table-header">        
               <th>Product</th>
               <th>Price Each</th>
               <th>Color</th>
               <th>Size</th>
               <th>Quantity</th>
               <th>Sub-total</th>
            </tr>
          </thead>
          <tbody>
          <?php
          // session_destroy();
            //create variables to count each items total quantity and count and store a subtotal and total item count value 
            $subtotal = 0;
            $item_total = 0;
            //foreach item object stored in this $SESSION, display properties and create quantity modifier buttons
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
                <td>
                  <a href="cart.php?add=$object->id"><i class="fa fa-plus-square"></i></a>
                  <a href="cart.php?remove=$object->id"><i class="fa fa-minus-square"></i></a>
                  <a href="cart.php?delete=$object->id"><i class="fa fa-trash"></i></a>
                </td>
              </tr>
CART_ITEM;
              echo $cart_item;
              //add each total and item count to tracker variables
              $subtotal += $object->ordered_subtotal;
              $item_total += $object->selected_quantity;
          }//end foreach
          ?>
      </tbody>
      </table>
        </table>
        <br></br>
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
        </tbody>
        </table>
      </div><!-- CART TOTALS-->
      <div class="col-lg-2"></div>
      <div class="col-lg-6">
      <form action="review.php" method="post">
      <div class="form-group">
        <label for="order_instructions">Special Instructions</label>
                            
          <textarea class="form-control" name="order_instructions" rows="8" placeholder="If any special instructions need to be given for your order, please include them here. This is especially important for any deer hair flies. If I have any questions beyond the scope of this message, or if anything remains unclear, I will contact you by email to ensure the order is to your desired specifications." style="text-align: left;"></textarea>
          <br></br>
          <input type="submit" name="submit" value="Save Special Instructions and Review Order" class="btn btn-primary">
      </form>
      </div>
      </div>
    </div>  <!-- row -->
    </div><!--Main Content-->
  </div>
</body>
<?php include '/includes/footer.php' ?>

