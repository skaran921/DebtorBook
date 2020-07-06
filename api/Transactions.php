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