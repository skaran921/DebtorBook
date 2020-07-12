<?php 
class Reminders{
    // conn
    private $conn;

    // constructor
    public function __construct($conn){        
        $this->conn = $conn;
    }
     

    // **get list of all active reminders
    public function getActiveReminders(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT * FROM reminders WHERE USER_ID='$userId' AND REMINDER_STATUS='1' ORDER BY 	REMINDER_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }
}
?>