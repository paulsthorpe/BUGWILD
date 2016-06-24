<?php

define ('DB_HOST','localhost');
define ('DB_USER','forge');
define ('DB_PASS','VU0aCyBDJ1q7yjkDCubN');
define ('DB_NAME','bugwild');


class Database {
    //create public property to store connection
    public $connection;


    //create construct method to initialize functions automatically
    function __construct(){
      $this->open_db_connection();
    }//__contruct method

    public function open_db_connection(){
      //assign database connection to the connection property
      $this->connection = new mysqli(DB_HOST,DB_USER,DB_PASS,DB_NAME);
   }//open_db_connection

    public function query($sql){
      $query_result = $this->connection->query($sql);
      $this->confirm_query($query_result);
      return $query_result;
    }

    public function confirm_query($query_result){
      if(!$query_result){
        die("query failed". $this->connection->error);
      } else {
        return true;
      }
    }

    public function escape_string($string){
      $escaped_string = $this->connection->real_escape_string($string);
      return stripslashes($escaped_string);
    }

    public function insert_id() {
      return $this->connection->insert_id;
    }
}//end database class

$database = new Database();
