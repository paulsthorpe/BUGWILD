<?php
class Post {
    protected static $db_table = "blog";
    protected static $db_table_columns = array('post_title','post_image','post_date','post_content','post_category_id','post_tags','content_image1','content_image2','content_image3');
    public           $post_title;
    public           $post_id;
    public           $post_image;
    public           $post_date;
    public           $post_content;
    public           $post_category_id;
    public           $post_tags;
    public           $content_image1;
    public           $content_image2;
    public           $content_image3;

    public function save() {
      if(isset($this->post_id)){
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
        $this->post_id = $database->insert_id();
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
      $sql .= "WHERE post_id= " . $database->escape_string($this->post_id);

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



    public static function find_all_posts() {
      global $database;
      $post_results = self::this_query("SELECT * FROM " . self::$db_table . " ORDER BY post_id DESC");
      return $post_results;
    }

    public static function recent_post() {
      global $database;
      $post_results = self::this_query("SELECT * FROM " . self::$db_table . " ORDER BY post_id DESC LIMIT 3");
      return $post_results;
    }

    public static function find_post_by_id($post_id) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE post_id=" . $post_id . " LIMIT 1");
      if(!empty($result)){
        $item = array_shift($result);
        return $item;
      } else {
        return false;
      }
    }

    public static function find_posts_by_category_id($category_id) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE post_category_id=" . $category_id);
      return $result;
    }

    public static function delete_post($post_id) {
      global $database;
      $sql = "DELETE FROM " . self::$db_table . " WHERE post_id = " . $post_id . " LIMIT 1";
      $database->query($sql);
    }//find_all

    public static function relate_category($post_category_id) {
      global $database;
      $query = $database->query("SELECT * FROM post_categories WHERE cat_id = ". $post_category_id);
      while($row = mysqli_fetch_assoc($query)){
        extract($row);
        return $cat_title;
      }
    }

}
