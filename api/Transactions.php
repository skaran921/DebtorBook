<?php 
 class Transactions{
      // conn
    private $conn;

    // constructor
    public function __construct($conn){        
        $this->conn = $conn;
    }


    // *getActiveDebtorsForSelectBox
    public function getActiveDebtorsForSelectBox(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT DEBTOR_ID,DEBTOR_NAME FROM debtors WHERE USER_ID='$userId' AND DEBTOR_STATUS='1' ORDER BY DEBTOR_NAME";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }

    // *paymentTransaction
    public function paymentTransaction($transactionDate,$debtorId,$payAmount,$remark){
        $userId = $_SESSION["user_auth_id"];
        $transactionType="P";
        $sql="INSERT INTO transaction (TRANSACTION_DATE,DEBTOR_ID,USER_ID,PAY_AMOUNT,TRANSACTION_REMARK,TRANSACTION_TYPE)VALUES('$transactionDate','$debtorId','$userId','$payAmount','$remark','$transactionType')";
        return $this->conn->query($sql);        
    }


    // *receivedTransaction
    public function receivedTransaction($transactionDate,$debtorId,$receivedAmount,$remark){
        $userId = $_SESSION["user_auth_id"];
        $transactionType="R";
        $sql="INSERT INTO transaction (TRANSACTION_DATE,DEBTOR_ID,USER_ID,RECEIVED_AMOUNT,TRANSACTION_REMARK,TRANSACTION_TYPE)VALUES('$transactionDate','$debtorId','$userId','$receivedAmount','$remark','$transactionType')";
        return $this->conn->query($sql);        
    }

    // *inActiveTransaction
    public function inActiveTransaction($transactionId){
        $sql = "UPDATE transaction SET TRANSACTION_STATUS='0' WHERE TRANSACTION_ID='$transactionId'";
        return $this->conn->query($sql);
    }


    // *activateTransaction
    public function activateTransaction($transactionId,$debtorId){
        $sql="SELECT count(*) as isActiveTransaction FROM debtors WHERE DEBTOR_ID ='$debtorId' AND DEBTOR_STATUS='1'";
        $result = $this->conn->query($sql);
        if($row=$result->fetch_assoc()){
            if($row["isActiveTransaction"]){
                $sql = "UPDATE transaction SET TRANSACTION_STATUS='1' WHERE TRANSACTION_ID='$transactionId'";
                return $this->conn->query($sql);
            }else{
                return -1;
            }
        }else{
            return false;
        }
        
    }

    // *getTodayTransaction
    public function getTodayTransaction(){
        $userId = $_SESSION["user_auth_id"];
        $todayDate = date("d-m-Y");
        $sql = "SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId AND t.TRANSACTION_DATE='$todayDate' AND t.TRANSACTION_STATUS='1' ORDER BY TRANSACTION_ID ASC"; 
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *getAllInActiveTransactions
    public function getAllInActiveTransactions(){
        $userId = $_SESSION["user_auth_id"];
        $todayDate = date("d-m-Y");
        $sql = "SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE,t.DEBTOR_ID, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId AND t.TRANSACTION_STATUS='0' ORDER BY TRANSACTION_ID ASC"; 
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *getTransactionById
    public function getTransactionById($transactionId){       
        $sql = "SELECT * FROM transaction WHERE TRANSACTION_ID='$transactionId'"; 
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *updateTransaction
    public function updateTransaction($transactionId,$transactionDate,$debtorId,$amount,$remark,$transactionType){
        $selectResultQuery ="SELECT COUNT(*) as totalRowCount FROM transaction WHERE TRANSACTION_ID='$transactionId'";
        $selectResult = $this->conn->query($selectResultQuery);
        if($row = $selectResult->fetch_assoc()){
            if($row['totalRowCount'] == 0){
                  return -1;
            } 
         }
        $sql ="";
        if($transactionType==="P"){
            $sql = "UPDATE transaction SET TRANSACTION_DATE='$transactionDate',DEBTOR_ID='$debtorId',PAY_AMOUNT='$amount',TRANSACTION_REMARK='$remark' WHERE TRANSACTION_ID='$transactionId'";
        }else{
            $sql = "UPDATE transaction SET TRANSACTION_DATE='$transactionDate',DEBTOR_ID='$debtorId',RECEIVED_AMOUNT='$amount',TRANSACTION_REMARK='$remark' WHERE TRANSACTION_ID='$transactionId'";
        }
        return $this->conn->query($sql);
    }

    // *getTransactionsBeteenTwoTransactionDate
    public function getTransactionsBeteenTwoTransactionDate($from,$to){
        $fromMonth  = date("m",strtotime($from));
        $toMonth  = date("m",strtotime($to));
        $fromYear = date("Y",strtotime($from));
        $toYear = date("Y",strtotime($to));
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId 
        AND t.TRANSACTION_DATE BETWEEN '$from' AND '$to' 
        AND DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%m') between $fromMonth and $toMonth
        AND DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%Y') between $fromYear and $toYear
        AND t.TRANSACTION_STATUS='1' ORDER BY TRANSACTION_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }


    // *getPaidTransactionBetweenTwoTransactionDate
    public function getPaidTransactionBetweenTwoTransactionDate($from,$to){
        $fromMonth  = date("m",strtotime($from));
        $toMonth  = date("m",strtotime($to));
        $fromYear = date("Y",strtotime($from));
        $toYear = date("Y",strtotime($to));
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId 
        AND t.TRANSACTION_DATE BETWEEN '$from' AND '$to' 
        AND DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%m') between $fromMonth and $toMonth
        AND DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%Y') between $fromYear and $toYear
        AND t.TRANSACTION_STATUS='1' AND TRANSACTION_TYPE='P' ORDER BY TRANSACTION_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *getReceivedTransactionBetweenTwoTransactionDate
    public function getReceivedTransactionBetweenTwoTransactionDate($from,$to){
        $fromMonth  = date("m",strtotime($from));
        $toMonth  = date("m",strtotime($to));
        $fromYear = date("Y",strtotime($from));
        $toYear = date("Y",strtotime($to));
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId
         AND t.TRANSACTION_DATE BETWEEN '$from' AND '$to' 
         AND DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%m') between $fromMonth and $toMonth
         AND DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%Y') between $fromYear and $toYear
         AND t.TRANSACTION_STATUS='1' AND TRANSACTION_TYPE='R' ORDER BY TRANSACTION_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }
    
    // *getCurrentMonthTransactions
    public function getCurrentMonthTransactions(){
        // *getCurrentMonthTransactions
        $userId = $_SESSION["user_auth_id"];
        $month = date("m");
        $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId AND  DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%m') ='$month' AND t.TRANSACTION_STATUS='1' ORDER BY TRANSACTION_DATE ASC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *getCurrentYearTransactions
    public function getCurrentYearTransactions(){
        $userId = $_SESSION["user_auth_id"];
        $year = date("Y");
        $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId AND  DATE_FORMAT(str_to_date(t.TRANSACTION_DATE, '%d-%m-%Y'),'%Y') ='$year' AND t.TRANSACTION_STATUS='1' ORDER BY TRANSACTION_DATE ASC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *searchTransaction
    public function searchTransaction($searchBy,$searchValue){
        $userId = $_SESSION["user_auth_id"];
        $sql = "";
        if($searchBy === "DEBTOR_ID"){
            $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId AND debtors.DEBTOR_NAME = '$searchValue' AND t.TRANSACTION_STATUS='1' ORDER BY TRANSACTION_DATE ASC";
        }else{
            $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE, debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS FROM transaction t LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID where t.USER_ID =$userId AND $searchBy = '$searchValue' AND t.TRANSACTION_STATUS='1' ORDER BY TRANSACTION_DATE ASC";
        }      
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }


     // *searchTransaction
     public function getTransactionByDebtor($debtorId){
        $userId = $_SESSION["user_auth_id"];       
        $sql ="SELECT t.TRANSACTION_ID,t.TRANSACTION_DATE,t.TRANSACTION_REMARK, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,t.TRANSACTION_CREATE_DATE,t.TRANSACTION_UPDATE_DATE,
        (SELECT SUM(t2.RECEIVED_AMOUNT) - SUM(t2.PAY_AMOUNT) FROM transaction t2
         WHERE t2.USER_ID ='$userId' AND t2.DEBTOR_ID ='$debtorId' AND t2.TRANSACTION_STATUS='1' AND t2.TRANSACTION_ID <= t.TRANSACTION_ID) BALANCE,
        debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS
         FROM transaction t 
         LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID
         where t.USER_ID ='$userId' AND t.TRANSACTION_STATUS='1' AND t.DEBTOR_ID = '$debtorId'
         ORDER BY TRANSACTION_DATE ASC";         
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }


    // SELECT * FROM `transaction` WHERE TRANSACTION_DATE BETWEEN "08-07-2020" AND "09-08-2020"
    // SELECT * FROM `transaction` where DATE_FORMAT(str_to_date(TRANSACTION_DATE, '%d-%m-%Y'),"%m") ='08'
    // SELECT * FROM `transaction` where DATE_FORMAT(str_to_date(TRANSACTION_DATE, '%d-%m-%Y'),"%Y") ='2020'

    /*
       SELECT t.TRANSACTION_ID, t.PAY_AMOUNT, t.RECEIVED_AMOUNT,
    (SELECT SUM(t2.RECEIVED_AMOUNT) - SUM(t2.PAY_AMOUNT) FROM transaction t2 WHERE   t2.USER_ID =1 AND t2.DEBTOR_ID =2 AND  t2.TRANSACTION_ID <= t.TRANSACTION_ID) BALANCE,
    debtors.DEBTOR_NAME,debtors.DEBTOR_MOBILE,debtors.DEBTOR_EMAIL,debtors.DEBTOR_ADDRESS
        FROM transaction t
        LEFT JOIN debtors on t.DEBTOR_ID = debtors.DEBTOR_ID 
        where t.USER_ID =1 AND t.DEBTOR_ID =2 AND debtors.DEBTOR_STATUS =1
    */ 

 }

?>