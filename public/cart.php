<?php include "../resources/php/initialize.php" ?>
<?php 
// session_destroy();
if(isset($_POST['add-to-cart'])){
	//get original product information
	$product = Products::find_product_by_id($_POST['product_id']);
	//pull relevant info from original and get values from add item page
	$item->selected_color = $_POST['color'];
	$item->selected_quantity = $_POST['quantity'];
	$item->selected_size = $_POST['size'];
	$item->price_each = $product->product_price;
	$item->id = $product->product_id;
	$item->title = $product->product_title;

	//create a session variable if not already initialized
	if(!$_SESSION['cart']['products']){
		$_SESSION['cart']['products'] = [];
		
	}
	//if array already exists with current key,change value to ensure unique index
	if(array_key_exists($item->id, $_SESSION['cart']['products'])){
		$item->id = $item->id * rand(1,6);
		//assign object to array 
		$_SESSION['cart']['products'][$item->id] = $item;
		
	} else {
		//else assign object to new array
		$_SESSION['cart']['products'][$item->id] = $item;
		
	}
}//add-to-cart isset


//if add variable is availabe in $_GET increment quantity of selected item
if(isset($_GET['add'])){
	$index = $_GET['add'];
	$_SESSION['cart']['products'][$index]->selected_quantity ++ ;
}
//if remove variable is availabe in $_GET decrement quantity of selected item
if(isset($_GET['remove'])){
	$index = $_GET['remove'];
	$_SESSION['cart']['products'][$index]->selected_quantity -- ;
}
//if delete variable is availabe in $_GET remove selected item completely from $_SESSION
if(isset($_GET['delete'])){
	$index = $_GET['delete'];
	unset($_SESSION['cart']['products'][$index]);
}

//redirect back to checkout
header('location: checkout.php');
































// function cart() {
//     //for each session extract product id and quantity
//     $total = 0;
//     $_SESSION['cart-total'] = '' ;
//     foreach ($_SESSION as $product => $quantity){
//         //check $_SESSION qty is more than 0
//         if($quantity > 0) {
//             //check for session variable containing products and qtys
//             if(substr($product, 0, 8 ) == "product_"){
//                 //create variable to remove "product_" from session variable and isolate product_id
//                 $length = strlen($product - 8);
//                 //isolate product id
//                 $p_id = substr($product, 8, $length);
//                 $query = query("SELECT * FROM products WHERE product_id = $p_id ");
//                 while($row = mysqli_fetch_assoc($query)) {
//                 extract($row);
//                 $itemSub = $product_price*$quantity;
//                 $cart_item = <<<CART_ITEM
//                 <tr>
//                 <td>$product_title</td>
//                 <td>$product_price</td>
//                 <td>$quantity</td>
//                 <td>$itemSub</td>
//                 <td><a href="cart.php?add=$product_id"><i class="fa fa-plus-square"></i></a><a href="cart.php?remove=$product_id"><i class="fa fa-minus-square"></i></a><a href="cart.php?delete=$product_id"><i class="fa fa-trash"></i></a></td>
//                 </tr>
// CART_ITEM;

//                 echo $cart_item;
//                 $_SESSION['cart-total'] += $itemSub ;
//             }//while loop

//         }//if statement substr
//     }//if statement qty
//     }//foreach
// }//cartfunction

    
// if(isset($_GET["add"])){
//     $pr_id = $_GET["add"];
//     echo $pr_id;
//     $_SESSION['product_'. $pr_id] += 1;
//     header("checkout.php");
    
// }    
    
// if(isset($_GET['remove'])){
//     $_SESSION['product_' . $_GET['remove']] -- ;
//     echo $_SESSION['product_'. $_GET['remove']];
//    header("checkout.php");
    
// }

// if(isset($_GET['delete'])){
    
//     $_SESSION['product_' . $_GET['delete']] = 0;
//     header("checkout.php");
// }
    


// ?>