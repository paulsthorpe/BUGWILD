<?php
class Orders {
    protected static $db_table = "orders";
    protected static $db_table_columns = array('order_no','order_day','order_month','order_year','order_amount','pending_shipped','items', 'special_instructions','trans_id','paypal_total','paypal_status');
    public           $order_no;
    public           $order_day;
    public           $order_month;
    public           $order_year;
    public           $order_amount;
    public           $pending_shipped;
    public           $items;
    public           $special_instructions;
    public           $trans_id;
    public           $paypal_total;
    public           $paypal_status;

    public function save() {
      if(isset($this->order_no)){
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
        $this->order_no = $database->insert_id();
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
      $sql .= "WHERE order_no= " . $database->escape_string($this->order_no);

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



    public static function find_all_orderss() {
      global $database;
      $orders_results = self::this_query("SELECT * FROM " . self::$db_table);
      return $orders_results;
    }

    public static function recent_orders() {
      global $database;
      $orders_results = self::this_query("SELECT * FROM " . self::$db_table . " ORDER BY order_no DESC LIMIT 100");
      return $orders_results;
    }

    public static function find_order_by_no($order_no) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE order_no=" . $order_no . " LIMIT 1");
      if(!empty($result)){
        $item = array_shift($result);
        return $item;
      } else {
        return false;
      }
    }

    public static function find_orders_by_month($month) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE order_month = " . $month );
      return $result;
    }

    public static function find_orders_by_year($year) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE order_year = " . $year );
      return $result;
    }

    public static function find_orders_by_exact_time($month, $year) {
      global $database;
      $result = self::this_query("SELECT * FROM " . self::$db_table . " WHERE order_month = " . $month . " AND order_year = " . $year );
      return $result;
    }

    public static function set_order_status($attr, $value, $id) {
      global $database;
      $database->query("UPDATE " . self::$db_table . " SET " . $attr . " = " . $value . " WHERE order_no= " . $id . " ");
    }

    public static function delete_orders($order_no) {
      global $database;
      $sql = "DELETE FROM " . self::$db_table . " WHERE order_no = " . $order_no . " LIMIT 1";
      $database->query($sql);
    }//find_all

}
