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
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT * FROM `transaction` WHERE USER_ID='$userId' AND TRANSACTION_STATUS='1' AND TRANSACTION_DATE BETWEEN '$from' AND '$to'";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }


    // *getPaidTransactionBetweenTwoTransactionDate
    public function getPaidTransactionBetweenTwoTransactionDate($from,$to){
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT * FROM `transaction` WHERE USER_ID='$userId' AND TRANSACTION_STATUS='1' AND TRANSACTION_DATE AND TRANSACTION_TYPE='P' BETWEEN '$from' AND '$to'";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *getReceivedTransactionBetweenTwoTransactionDate
    public function getReceivedTransactionBetweenTwoTransactionDate($from,$to){
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT * FROM `transaction` WHERE USER_ID='$userId' AND TRANSACTION_STATUS='1' AND TRANSACTION_DATE AND TRANSACTION_TYPE='R' BETWEEN '$from' AND '$to'";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *getCurrentMonthTransactions
    public function getCurrentMonthTransactions($from,$to){
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT * FROM `transaction` WHERE USER_ID='$userId' AND TRANSACTION_STATUS='1' AND TRANSACTION_DATE AND TRANSACTION_TYPE='R' BETWEEN '$from' AND '$to'";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // *getCurrentYearTransactions
    public function getCurrentYearTransactions($from,$to){
        $userId = $_SESSION["user_auth_id"];
        $sql ="SELECT * FROM `transaction` WHERE USER_ID='$userId' AND TRANSACTION_STATUS='1' AND TRANSACTION_DATE AND TRANSACTION_TYPE='R' BETWEEN '$from' AND '$to'";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;    
    }

    // SELECT * FROM `transaction` WHERE TRANSACTION_DATE BETWEEN "08-07-2020" AND "09-08-2020"
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