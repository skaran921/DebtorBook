<?php 
class Debtors{
    // conn
    private $conn;

    // constructor
    public function __construct($conn){        
        $this->conn = $conn;
    }
     

    // **get list of all active debtors
    public function getActiveDebtors(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT * FROM debtors WHERE USER_ID='$userId' AND DEBTOR_STATUS='1' ORDER BY DEBTOR_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }

    // **get list of all in-active debtors
    public function getInActiveDebtors(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT * FROM debtors WHERE USER_ID='$userId' AND DEBTOR_STATUS='0' ORDER BY DEBTOR_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }

     // **get debtor details from given id
     public function getDebtorById($id){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT * FROM debtors WHERE USER_ID='$userId' AND DEBTOR_ID='$id'";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }

    // **insert new debtor in db
    public function insertDebtor($debtorName,$debtorMobile,$debtorEmail,$debtorAddress){
        $userId = $_SESSION["user_auth_id"];
        $selectQuery = "SELECT COUNT(*) AS total FROM debtors WHERE DEBTOR_MOBILE='$debtorMobile'";
        $selectResult = $this->conn->query($selectQuery);
        if($row = $selectResult->fetch_assoc()){
           if($row['total'] == 1){
                 return -1;
           } 
        }
        $sql="INSERT INTO debtors(DEBTOR_NAME,DEBTOR_MOBILE,DEBTOR_EMAIL,DEBTOR_ADDRESS,USER_ID)VALUES('$debtorName','$debtorMobile','$debtorEmail','$debtorAddress','$userId')";
        return $this->conn->query($sql);        
    }

    // **Update debtor in db
    public function updateDebtor($debtorId,$debtorName,$debtorMobile,$debtorEmail,$debtorAddress){
        $selectQuery = "SELECT COUNT(*) AS total FROM debtors WHERE DEBTOR_MOBILE='$debtorMobile' AND DEBTOR_ID !='$debtorId'";
        $selectResult = $this->conn->query($selectQuery);
        if($row = $selectResult->fetch_assoc()){
           if($row['total'] == 1){
                 return -1;
           } 
        }
        $sql="UPDATE debtors SET DEBTOR_NAME='$debtorName',DEBTOR_MOBILE='$debtorMobile',DEBTOR_EMAIL='$debtorEmail',DEBTOR_ADDRESS='$debtorAddress' WHERE DEBTOR_ID='$debtorId'";
        return $this->conn->query($sql);        
    }

    // **inActive debtor in db
    public function inActiveDebtor($debtorId){
        $sql="UPDATE debtors SET DEBTOR_STATUS='0' WHERE DEBTOR_ID='$debtorId'";
        if($this->conn->query($sql)){
            $sql="UPDATE transaction SET TRANSACTION_STATUS='0' WHERE DEBTOR_ID='$debtorId'";
            return $this->conn->query($sql);
        }else{
            return false;
        }         
    }
    
    // **delete debtor in db
    public function deleteDebtor($debtorId){
        $userId = $_SESSION["user_auth_id"];
        $sql = "SELECT  COUNT(*) AS total from transaction where DEBTOR_ID ='$debtorId' AND USER_ID='$userId'";
        $result = $this->conn->query($sql);
        if($row = $result->fetch_assoc()){
            if($row["total"] === 0){
                //delete debtor a/c
                $sql="DELETE FROM debtors WHERE DEBTOR_ID='$debtorId'";
                return $this->conn->query($sql);
            }else{
                return -1;
            }
           
        }else{
            return false;
        }         
    }

   
    // **Active debtor in db
    public function activeDebtor($debtorId){
        $sql="UPDATE debtors SET DEBTOR_STATUS='1' WHERE DEBTOR_ID='$debtorId'";
        return $this->conn->query($sql);        
    }

}
?>