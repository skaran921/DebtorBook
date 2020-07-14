<?php 
class Dashboard{
    // conn
    private $conn;

    // constructor
    public function __construct($conn){        
        $this->conn = $conn;
    }
  
// *******************************Debtors Section*************************

    // **get count of all debtors
    public function getAllDebtorsCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalDebtors FROM debtors WHERE USER_ID='$userId'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalDebtors"];
        }else{
            return 0;
        }
    }

    // **get count of all active debtors
    public function getAllActiveDebtorsCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalDebtors FROM debtors WHERE USER_ID='$userId' AND DEBTOR_STATUS='1'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalDebtors"];
        }else{
            return 0;
        }
    }


    // **get count of all inActive debtors
    public function getAllInActiveDebtorsCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalDebtors FROM debtors WHERE USER_ID='$userId' AND DEBTOR_STATUS='0'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalDebtors"];
        }else{
            return 0;
        }
    }

// *******************************Debtors Section*************************


// *******************************Transaction Section*************************

    // **get count of all transactions
    public function getAllTransactionsCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalTransactions FROM transaction WHERE USER_ID='$userId'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalTransactions"];
        }else{
            return 0;
        }
    }

    // **get count of all active transactions
    public function getAllActiveTransactionsCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalTransactions FROM transaction WHERE USER_ID='$userId' AND TRANSACTION_STATUS='1'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalTransactions"];
        }else{
            return 0;
        }
    }


    // **get count of all inActive transactions
    public function getAllInActiveTransactionsCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalTransactions FROM transaction WHERE USER_ID='$userId' AND TRANSACTION_STATUS='0'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalTransactions"];
        }else{
            return 0;
        }
    }


      // **todays total pay amount
      public function getSumOfTodaysPaidAmount(){
        $userId = $_SESSION["user_auth_id"];
        $date = date("d-m-Y");
        $sql="SELECT sum(PAY_AMOUNT) as totalPaidAmount FROM transaction WHERE USER_ID='$userId' AND TRANSACTION_DATE='$date' AND TRANSACTION_STATUS='1'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalPaidAmount"];
        }else{
            return 0;
        }
    }

        // **todays total RECEIVED amount
      public function getSumOfTodaysReceivedAmount(){
        $userId = $_SESSION["user_auth_id"];
        $date = date("d-m-Y");
        $sql="SELECT sum(RECEIVED_AMOUNT) as totalReceivedAmount FROM transaction WHERE USER_ID='$userId' AND TRANSACTION_DATE='$date' AND TRANSACTION_STATUS='1'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalReceivedAmount"];
        }else{
            return 0;
        }
    }

// *******************************Transaction Section*************************


// *******************************Reminders Section*************************

    // **get count of all Reminders
    public function getAllRemindersCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalReminders FROM reminders WHERE USER_ID='$userId'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalReminders"];
        }else{
            return 0;
        }
    }

    // **get count of all active Reminders
    public function getAllActiveRemindersCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalReminders FROM reminders WHERE USER_ID='$userId' AND 	REMINDER_STATUS='1'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalReminders"];
        }else{
            return 0;
        }
    }


    // **get count of all inActive Reminders
    public function getAllInActiveRemindersCount(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT count(*) as totalReminders FROM reminders WHERE USER_ID='$userId' AND 	REMINDER_STATUS='0'";
        $result = $this->conn->query($sql);
        if($row= $result->fetch_assoc()){
           return $row["totalReminders"];
        }else{
            return 0;
        }
    }

// *******************************Reminders Section*************************
   
} 
?>