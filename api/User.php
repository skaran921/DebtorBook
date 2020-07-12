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

    //* [getUserDetails] it will give us current user details
    public function getUserDetails($userId){
      $sql="SELECT * from users WHERE USER_ID='$userId'";
      $result = $this->conn->query($sql);
      if($row=$result->fetch_assoc()){
          return $row;
      }else{
        return [];
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

    // **[getTodaysReminderCount] getTodaysReminderCount of current user
    public function getTodaysReminder(){
      $userId = $_SESSION["user_auth_id"];
      $date = date("d-m");
      $sql="SELECT * FROM reminders WHERE USER_ID='$userId' AND REMINDER_STATUS='1'
       AND DATE_FORMAT(str_to_date(REMINDER_DATE, '%d-%m-%Y'),'%d-%m') = '$date';
       ORDER BY 	REMINDER_ID DESC";
      $result = $this->conn->query($sql);
      $rows = $result->fetch_all(MYSQLI_ASSOC);
      $this->conn -> close();
      return $rows;
    }

    // **[getTodaysReminderCount] getTodaysReminderCount of current user
    public function getTodaysReminderCount(){
      $userId = $_SESSION["user_auth_id"];
      $date = date("d-m");
      $sql="SELECT count(*) as total FROM reminders WHERE USER_ID='$userId' AND REMINDER_STATUS='1'
       AND DATE_FORMAT(str_to_date(REMINDER_DATE, '%d-%m-%Y'),'%d-%m') = '$date' ORDER BY REMINDER_ID DESC";
      $result = $this->conn->query($sql);
      $rows = $result->fetch_all(MYSQLI_ASSOC);
      $this->conn -> close();
      return $rows[0]["total"];
    }

    // * updateUserPassword
    public function updateUserPassword($userId,$currentPassword,$newPassword){
      // check user current password are correct or not
      $sql="SELECT count(*) as total FROM users WHERE USER_ID='$userId' AND  USER_PASSWORD='$currentPassword'";
      $result = $this->conn->query($sql);
      if($row = $result->fetch_assoc()){
        if($row["total"]){
              // *update password
              $sql="UPDATE users SET USER_PASSWORD='$newPassword' WHERE USER_ID='$userId'";
              return $this->conn->query($sql);
        }else{
          return -1;
        }
      }
    }
  }
?>