<?php
include('config.php');


class Database {
  private $mysqli;

  public function __construct() { 
    $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
    
    if($this->mysqli->error) {
      console.log("DB connection error");
    } else {
      console.log("Connected to database");
    }
  }

  /* Returns the mysqli object 
      @params: None
  */
  public function getMysqli() {
    return $this->mysqli;
  }

  /* Performs a query on the database
      @params: string
  */
  public function query($query) {
    if (isset($this->mysqli) && is_string($query)) {
      return $this->mysqli->query($query);
    }
  }

  /* Returns an escaped string 
      @params: string
  */
  public function escape_string($input) {
    if (isset($this->mysqli)) {
      return $this->mysqli->escape_string($input);
    }
  }

  /* Rolls back current transaction 
      @params:
  */
  public function rollback() {
    if (isset($this->mysqli)) {
      return $this->mysqli->rollback();
    }
  }

  /* Commits the current transaction 
      @params: 
  */
  public function commit() {
    if (isset($this->mysqli)) {
      return $this->mysqli->commit();
    }
  }
}

?>