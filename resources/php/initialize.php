<?php

// define('DS', "\\\\");
// define('SITE_ROOT', 'C:' . DS . 'Users' . DS . 'Pauls' . DS . 'Desktop' . DS . 'carolinagirls' );
// define('BLOG_IMAGES', SITE_ROOT . DS . 'public' . DS . 'images' . DS . 'blog' );
// define('PARALLAX_IMAGES', SITE_ROOT . DS . 'public' . DS . 'images' . DS . 'parallax' );
// define('SPLASH_IMAGES', SITE_ROOT . DS . 'public' . DS . 'images' . DS . 'splash_slideshow' );
// define('ABOUT_IMAGES', SITE_ROOT . DS . 'public' . DS . 'images' . DS . 'about_slideshow' );
ob_start();




require_once("blogClass.php");
require_once("productsClass.php");
require_once("ordersClass.php");
require_once("databaseClass.php");
require_once("categoriesClass.php");
require_once("functions.php");






//create class to make cart item objects
class CartProduct {
	public $selected_color;
	public $selected_quantity;
	public $selected_size;
	public $ordered_subtotal;
	public $price_each;
	public $id;
	public $title;
}



$item = new CartProduct();




session_start();
?>
