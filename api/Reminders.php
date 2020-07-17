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


    
    // **get list of all in-active reminders
    public function getInActiveReminders(){
        $userId = $_SESSION["user_auth_id"];
        $sql="SELECT * FROM reminders WHERE USER_ID='$userId' AND REMINDER_STATUS='0' ORDER BY 	REMINDER_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }


    // **getReminderFromId
    public function getReminderFromId($reminderId){
        $sql="SELECT * FROM reminders WHERE REMINDER_ID='$reminderId'";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }

    // **insertNewReminder
    public function insertNewReminder($reminderDate,$reminder){
        $userId = $_SESSION["user_auth_id"];
        $sql="INSERT INTO reminders(REMINDER_DATE,REMINDER,USER_ID)VALUES('$reminderDate','$reminder','$userId')";
        return $this->conn->query($sql);
    }


    // **setInactiveReminder
    public function setInactiveReminder($reminderId){
        $sql="UPDATE reminders SET REMINDER_STATUS='0' WHERE REMINDER_ID='$reminderId'";
        return $this->conn->query($sql);
    }

       // **deleteReminder
       public function deleteReminder($reminderId){
        $sql="DELETE FROM reminders WHERE REMINDER_ID='$reminderId'";
        return $this->conn->query($sql);
    }

    // **setActiveReminder
    public function setActiveReminder($reminderId){
        $sql="UPDATE reminders SET REMINDER_STATUS='1' WHERE REMINDER_ID='$reminderId'";
        return $this->conn->query($sql);
    }

    // **updateReminder
    public function updateReminder($reminderId,$reminderDate,$reminder){
        $sql="UPDATE reminders SET REMINDER_DATE='$reminderDate',REMINDER='$reminder' 
        WHERE REMINDER_ID='$reminderId'";
        return $this->conn->query($sql);
    }

    // **getTodaysReminderCount
    public function getTodaysReminder(){
        $userId = $_SESSION["user_auth_id"];
        $date = date("d-m");
        $sql="SELECT * FROM reminders WHERE USER_ID='$userId' AND REMINDER_STATUS='1'
         AND DATE_FORMAT(str_to_date(REMINDER_DATE, '%d-%m-%Y'),'%d-%m') = '$date' ORDER BY REMINDER_ID DESC";
        $result = $this->conn->query($sql);
        $rows = $result->fetch_all(MYSQLI_ASSOC);
        $this->conn -> close();
        return $rows;
    }
}
?>