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
 }

?>