<?php
class Products {
    protected static $db_table = "products";
    protected static $db_table_columns = array('product_title','product_image','product_image2','product_image3','product_category_id','product_description','product_price','featured','on_sale','color','color2','color3','color4','color5','color6','size1','size2','size3');
    public           $product_title;
    public           $product_id;
    public           $product_image;
    public           $product_image2;
    public           $product_image3;
    public           $product_category_id;
    public           $product_description;
    public           $product_price;
    public           $featured;
    public           $on_sale;
    public           $color;
    public           $color2;
    public           $color3;
    public           $color4;
    public           $color5;
    public           $color6;
    public           $size1;
    public           $size2;
    public           $size3;

    public function save() {
      if(isset($this->product_id)){
        $this->update();
      } else {
        $this->create();
      }
    }

    public function create(){
      global $database;
      $properties = $this->properties();
      $sql = "INSERT INTO " . self::$db_table . " (" . implode(",", array_keys($properties)) . ")";
      $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

      if($database->query($sql)) {
        $this->product_id = $database->insert_id();
      } else {
        return false;
      }
    }//create

    public function update(){
      global $database;
      $properties = $this->properties();
      $property_pairs = array();

      foreach($properties as $key => $value) {
        $property_pairs[] = "{$key}= '{$value}'";
      }

      $sql = "UPDATE ". self::$db_table . " SET ";
      $sql .= implode(", ", $property_pairs);
      $sql .= "WHERE product_id= " . $database->escape_string($this->product_id);

      $database->query($sql);
      return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }//update



    public static function this_query($sql){
      //create access for database object
      global $database;
      //query database using query method from database object
      $query_result = $database->query($sql);
      //create empty array
      $object_array = array();
      //loop through database rows and assign them to $row array
        while($row = mysqli_fetch_assoc($query_result)){
        //store each $row array into object based on instantiation method
        $object_array[] = self::instantiation($row);
     }
      //return object
      return $object_array;
    }//this_query method

    public static function instantiation($result){
        //create new object, inherits class
        $object = new self();
        //for each query result, as an array
        foreach ($result as $property => $value) {
          //calls has_property method to check if object contains property identical to the array key
          if($object->has_property($property)){
            //if property exists, assigns array value to the object properties
            $object->$property = $value;
          }//if
        }//foreach
        return $object;
    } //instantiation method


    private function has_property($property){
        //get_object_vars searches class or object for existing properties and returns all in an array
        $object_properties = get_object_vars($this);
        //compares passed in array keys with returned object properties, returns true or false boolean
        return array_key_exists($property, $object_properties);
    } //has property method

    public function properties(){
      global $database;
      $properties = array();
      foreach (self::$db_table_columns as $column) {
        if(property_exists($this, $column)){
          $properties[$column] = $this->$column;
        }//if
      }//foreach
      return $properties;
    }//properties method



    public static function find_all_products() {
      global $database;
      $product_results = self::this_query("SELECT * FROM " . self::$db_table);
      return $product_results;
    }

    public static function featured_products() {
      global $database;
      $product_results = self::this_query("SELECT * FROM " . self::$db_table . " WHERE featured= 1 LIMIT 3");
      return $product_results;
    }

    public static function products_on_sale() {
      global $database;
      $product_results = self::this_query("SELECT * FROM " . self::$db_table . " WHERE on_sale= 1");
      return $product_results;
    }

    public static function set_product_attr($attr, $value, $id) {
      global $database;
      $database->query("UPDATE " . self::$db_table . " SET " . $attr . " = " . $value . " WHERE product_id= " . $id . " ");
    }


    public static function find_product_by_id($product_id) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE product_id=" . $product_id . " LIMIT 1");
      if(!empty($result)){
        $item = array_shift($result);
        return $item;
      } else {
        return false;
      }
    }

    public static function find_products_by_category_id($category_id) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE product_category_id=" . $category_id );//. " LIMIT 1
      return $result;
    }

    public static function delete_product($product_id) {
      global $database;
      $sql = "DELETE FROM " . self::$db_table . " WHERE product_id = " . $product_id . " LIMIT 1";
      $database->query($sql);
    }//find_all

    public static function format_price($product_price) {
        if(strlen($product_price) < 4){
          $characters = strlen($product_price);
          $product_price = substr_replace($product_price, '0', $characters);
          return $product_price;
        } else {
          return $product_price;
        }
    }
}
