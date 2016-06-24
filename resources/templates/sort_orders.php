<?php 

if(isset($_POST['month']) && isset($_POST['year'])){
    //create variable to store the selected month and year values
    $filtered_month = $_POST['month'];
    $filtered_year = $_POST['year'];
    //find all orders in this specified timeframe
    $this_filter = Orders::find_orders_by_exact_time($filtered_month, $filtered_year);
    $total = 0;
    foreach ($this_filter as $order) {
        //count total amounts to display in financial overview
        $total += $order->order_amount;
    }

    //create objects for each order found in this current month
    $this_month = Orders::find_orders_by_month($_POST['month']);

    //create variable to store those objects total amount values
    $monthly_total = 0;
    //for each result, add each objects total_amount property and add it to the monthly_total variable
    foreach ($this_month as $order) {
        $monthly_total += $order->order_amount;
    }


} else {
    //if no value was set, do not display anything and prompt user to try again
    die("filter not set, try again!");
}
?>
<br></br>
<br></br>
<div class="container-fluid">
    <!-- Page Heading -->
    <div class="row">
        <div class="col-lg-6">
            <form action="admin.php?source=sort_orders" method="POST">
                <h1 class="page-header">Orders</h1>
                <h3>Filter Orders By:</h3>
                <label for="Month">Month</label>
                <select name="month" id="">
                    <option value= "01">January</options>
                    <option value= "02">February</options>
                    <option value= "03">March</options>
                    <option value= "04">April</options>
                    <option value= "05">May</options>
                    <option value= "06">June</options>
                    <option value= "07">July</options>
                    <option value= "08">August</options>
                    <option value= "09">September</options>
                    <option value= "10">October</options>
                    <option value= "11">November</options>
                    <option value= "12">December</options>
                </select>
                <label for="Year">Year</label>
                <select name="year" id="">
                    <option value= "2016">2016</options>
                    <option value= "2017">2017</options>
                    <option value= "2018">2018</options>
                </select>
                <input type="submit" name="filter_orders" value="Filter Orders">
        </div>
        <div class="col-lg-6">
                <h1>Financials: Quick Look</h1>
                <label for="MonthlyTotal">Monthly Total:</label>
                <input type="text" name="monthly_total" value="<?php echo "$ " .$monthly_total; ?>">
                <br></br>
                <label for="YearlyTotal">Yearly Total:</label>
                <input type="text" name="yearly_total" value="<?php echo "$ " .$yearly_total; ?>">
            </form>
        </div>
    </div>
    <!-- /.row -->
    <!-- SECOND ROW WITH TABLES-->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-money fa-fw"></i> Transactions Panel</h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th>Order #</th>
                                    <th>Order Date</th>
                                    <th>Order Contents</th>
                                    <th>Order Amount</th>
                                    <th>Paypal Amount Recieved</th>
                                    <th>Paylpal Trans ID</th>
                                    <th>Paypal Status</th>
                                    <th>Pending/Shipped</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                                foreach($this_filter as $order){
                                    //use status_options function to create and apply appropriate stats options for the select
                                    $status_select = status_options($order->pending_shipped);
                                    $order_table = <<<TABLE
                                <tr>
                                    <td>$order->order_no</td>
                                    <td>$order->order_month / $order->order_day / $order->order_year</td>
                                    <td><a href="admin.php?source=order&order_number=$order->order_no">More Here</a></td>
                                    <td>$order->order_amount</td>
                                    <td>$order->paypal_total</td>
                                    <td>$order->trans_id</td>
                                    <td>$order->paypal_status</td>
                                    <td>
                                        <form action="admin.php?order_number=$order->order_no" method="post">
                                            <select name="status">
                                              $status_select
                                            </select>
                                            <input type="submit" name="changeStatus" class="btn btn-primary btn-sm" value="Set Status">
                                        </form>
                                    </td>
                                </tr>
TABLE;
                                echo $order_table;
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /.container-fluid -->
<?php 
//if change_status button is clicked, apply appropriate status to the order assciated with button
  if(isset($_POST['changeStatus'])){
    Orders::set_order_status('pending_shipped', $_POST['status'], $_GET['order_number']);
    header('Location: admin.php');
  }
?>