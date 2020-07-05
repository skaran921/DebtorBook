<?php 
  class User{
     // conn
    private $conn;

    // constructor
    public function __construct($conn){        
        $this->conn = $conn;
    }

    //* [getUserFirstName] it will give us current user first name
    public function getUserFirstName($userId){
      $sql="SELECT USER_FIRST_NAME from users WHERE USER_ID='$userId'";
      $result = $this->conn->query($sql);
      if($row=$result->fetch_assoc()){
          return $row["USER_FIRST_NAME"];
      }
    }

     //* [getUserLastName] it will give us current user last name
     public function getUserLastName($userId){
      $sql="SELECT USER_LAST_NAME from users WHERE USER_ID='$userId'";
      $result = $this->conn->query($sql);
      if($row=$result->fetch_assoc()){
          return $row["USER_LAST_NAME"];
      }
    }

     //* [getUserFullName] it will give us current user full name
     public function getUserFullName($userId){
      $sql="SELECT concat(USER_FIRST_NAME,USER_LAST_NAME) as fullName from users WHERE USER_ID='$userId'";
      $result = $this->conn->query($sql);
      if($row=$result->fetch_assoc()){
          return $row["fullName"];
      }
    }

    //* [getUserNameArray] it will give us current user name as array
    public function getUserNameArray($userId){
      $sql="SELECT USER_FIRST_NAME,USER_LAST_NAME from users WHERE USER_ID='$userId'";
      $result = $this->conn->query($sql);
      return $result->fetch_assoc();
    }
  }
?>