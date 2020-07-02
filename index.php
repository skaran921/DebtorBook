<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Login - DebtorBook</title>
   <?php 
     include "./externalCss.php";
   ?>
  </head>
  <body>
    <!-- container -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-6 col-sm-12">
          <div class="main-img">
            <img
              src="./assets/images/accounting.jpg"
              alt="login"
              style="width: 100%;"
            />
          </div>
        </div>
        <div class="col-md-12 col-lg-6 col-sm-12 right-login-block">
          <div class="content">
            <!-- sign in text-->
            <div class="sign-in-text text-right p-2">
              <span class="gray-text">New user?</span>
              <span class="blue-text">Sign up</span>
            </div>
            <!-- sign in form -->
            <div class="sign-in-form p-4 text-center">
              <!-- alert danger -->
              <div class="alert alert-danger m-2 error_msg">
                
              </div>
              <span class="blue-text" style="font-size: 2rem;"
                >Sign in to Debtor Book</span
              >
              <!-- sign in form -->
              <form action="" method="post" onsubmit="return validateSignUpForm()">
                <div class="form-group">
                  <input
                    type="email"
                    name="email"
                    id="email"
                    class="mt-4"
                    placeholder="Email"
                    required
                  />

                  <input
                    type="password"
                    name="password"
                    id="password"
                    title="Password"
                    class="mt-4"
                    placeholder="Password"
                    required
                  />

                  <button type="submit" name="signUp" class="mt-4 btn-block">Sign in</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
       include "./externalJs.php";
    ?>
    <script>
      function validateSignUpForm(){
          let password = $("#password").val();
          let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;
          if(password.match(passwordPattern)){            
            $(".error_msg").hide();
            return true;
          }else{
            // fasle
            $(".error_msg").text("Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
            $(".error_msg").show();
            return false;
          }
      }
    </script>

    <?php
      if(
        isset($_POST["signUp"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"])
        ){

          if(
            !empty($_POST["email"]) &&
            !empty($_POST["password"]) 
            ){
              // proceed
              include "./api/helper/ValidationHelper.php";
                $email = $_POST["email"];
                $password = $_POST["password"];
                $status= 1;

              if(!ValidationHelper::validateEmail($email)){
                   //  if email validation failed
                ?>
                <script>
                    $(".error_msg").text("Invalid Email");
                    $(".error_msg").show();
                </script>
             <?php
              }elseif(!ValidationHelper::validatePassword($password)){
                //  if password validation failed
                ?>
                   <script>
                       $(".error_msg").text("Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
                       $(".error_msg").show();
                   </script>
                <?php
              }else{
                // check user authentication
              echo  $password = md5($password);

                include "./api/db.php";
                $sql =  $conn->prepare("SELECT * FROM users WHERE USER_EMAIL= ? AND USER_PASSWORD= ? AND USER_STATUS= ?");
                $sql->bind_param("ssi", $email, $password,$status);
                $sql->execute();
                $result = $sql->get_result();
                if($result->num_rows === 0){
                  // unauthenticate user
                ?>
                <script>                    
                    $(".error_msg").text("Sorry, invalid email AND password");
                    $(".error_msg").css("display","block");
                </script>
             <?php
                }else{
                  // authenticate user
                  if($row= $result->fetch_assoc()){
                      $encoded_in_base64_user_id = base64_encode(strval($row["USER_ID"]));
                      $_SESSION["user_token"] = $encoded_in_base64_user_id;  
                      header("Location:./user");                    
                  }
                  ?>
                  <script>
                      $(".error_msg").hide();
                  </script>
                 <?php
                }
                $sql->close();
                $conn->close();
               
              }
            
              ?>
              <script>history.pushState({}, "", "")</script>
              <?php
            }
         
      }
    ?>
  </body>
</html>
