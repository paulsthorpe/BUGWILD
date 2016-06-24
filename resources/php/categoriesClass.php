<?php
class Categories {
  
    protected static $db_table_products   = "categories";
    protected static $db_table_blog       = "post_categories";
    protected static $db_table_columns    = array('cat_title','cat_id');
    public           $cat_title;
    public           $cat_id;


    public function save_product_category() {
      if(isset($this->cat_id)){
        $this->update_product_category();
      } else {
        $this->create_product_category();
      }
    }

    public function save_blog_category() {
      if(isset($this->cat_id)){
        $this->update_blog_category();
      } else {
        $this->create_blog_category();
      }
    }

    public function create_product_category(){
      global $database;
      $properties = $this->properties();
      $sql = "INSERT INTO " . self::$db_table_products . " (" . implode(",", array_keys($properties)) . ")";
      $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

      if($database->query($sql)) {
        $this->cat_id = $database->insert_id();
      } else {
        return false;
      }
    }//create

    public function create_blog_category(){
      global $database;
      $properties = $this->properties();
      $sql = "INSERT INTO " . self::$db_table_blog . " (" . implode(",", array_keys($properties)) . ")";
      $sql .= "VALUES ('" . implode("','", array_values($properties)) . "')";

      if($database->query($sql)) {
        $this->cat_id = $database->insert_id();
      } else {
        return false;
      }
    }//create

    public function update_product_category(){
      global $database;
      $properties = $this->properties();
      $property_pairs = array();

      foreach($properties as $key => $value) {
        $property_pairs[] = "{$key}= '{$value}'";
      }

      $sql = "UPDATE ". self::$db_table_products . " SET ";
      $sql .= implode(", ", $property_pairs);
      $sql .= "WHERE cat_id= " . $database->escape_string($this->cat_id);

      $database->query($sql);
      return (mysqli_affected_rows($database->connection) == 1) ? true : false;
    }//update

    public function update_blog_category(){
      global $database;
      $properties = $this->properties();
      $property_pairs = array();

      foreach($properties as $key => $value) {
        $property_pairs[] = "{$key}= '{$value}'";
      }

      $sql = "UPDATE ". self::$db_table_blog . " SET ";
      $sql .= implode(", ", $property_pairs);
      $sql .= "WHERE cat_id= " . $database->escape_string($this->cat_id);

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



    public static function find_all_product_categories() {
      global $database;
      $cat_results = self::this_query("SELECT * FROM " . self::$db_table_products);
      return $cat_results;
    }

    public static function find_all_blog_categories() {
      global $database;
      $cat_results = self::this_query("SELECT * FROM " . self::$db_table_blog);
      return $cat_results;
    }

    public static function find_product_cat_by_id($cat_id) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table_products . " WHERE cat_id=" . $cat_id . " LIMIT 1");
      if(!empty($result)){
        $item = array_shift($result);
        return $item;
      } else {
        return false;
      }
    }

    public static function find_blog_cat_by_id($cat_id) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table_blog . " WHERE cat_id=" . $cat_id . " LIMIT 1");
      if(!empty($result)){
        $item = array_shift($result);
        return $item;
      } else {
        return false;
      }
    }

    public static function delete_product_cat($cat_id) {
      global $database;
      $sql = "DELETE FROM " . self::$db_table_products . " WHERE cat_id = " . $cat_id . " LIMIT 1";
      $database->query($sql);
    }//find_all

    public static function delete_blog_cat($cat_id) {
      global $database;
      $sql = "DELETE FROM " . self::$db_table_blog . " WHERE cat_id = " . $cat_id . " LIMIT 1";
      $database->query($sql);
    }//find_all


}
