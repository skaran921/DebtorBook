<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Create Account - DebtorBook</title>
   <?php 
     include "../externalCss.php";
   ?>
  </head>
  <body>
    <!-- container -->
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 col-lg-6 col-sm-12">
          <div class="main-img">
            <img
              src="../assets/images/accounting.jpg"
              alt="login"
              style="width: 100%;"
            />
          </div>
        </div>
        <div class="col-md-12 col-lg-6 col-sm-12 right-login-block">
          <div class="content">
            <!-- sign in text-->
            <div class="sign-in-text text-right p-2">
              <span class="gray-text">Already have an Account?</span>
              <a href="../" class="blue-text text-decoration-none">Sign in</a>
            </div>
            <!-- sign in form -->
            <div class="sign-in-form p-4 text-center">
              <!-- alert danger -->
              <div class="alert alert-danger m-2 error_msg">                
              </div>
              <div class="alert alert-success m-2 success_msg">
              </div>
              <span class="blue-text" style="font-size: 2rem;"
                >Create Account for Debtor Book</span
              >
              <!-- sign in form -->
              <form action="" method="post" onsubmit="return validateSignUpForm()">
                <div class="form-group">
                  <input
                    type="text"
                    name="firstName"
                    id="firstName"
                    class="mt-4"
                    placeholder="First Name"
                    required
                  />
                  <input
                    type="text"
                    name="lastName"
                    id="lastName"
                    class="mt-4"
                    placeholder="Last Name"
                    required
                  />
                  <input
                    type="tel"
                    name="mobile"
                    id="mobile"
                    class="mt-4"
                    placeholder="10 Digit Mobile No."
                    required
                  />

                  <textarea                    
                    name="address"
                    id="address"
                    title="Address"
                    class="mt-4"
                    placeholder="Address"
                    required
                  ></textarea>
                  
                  <input
                    type="email"
                    name="email"
                    id="email"
                    pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,}$"
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

                  <button type="submit" name="signUp" class="mt-4 btn-block">Sign Up</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <?php
       include "../externalJs.php";
    ?>
    <script>
      function validateSignUpForm(){
          let firstName = $("#firstName").val(); 
          let lastName = $("#lastName").val(); 
          let mobile = $("#mobile").val(); 
          let address = $("#address").val(); 
          let email = $("#email").val(); 
          let password = $("#password").val();
          let passwordPattern = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}$/;          
         
         if(firstName.length === 0){
            $(".error_msg").text("First Name Required");
            $(".error_msg").show();
            return false;
         }else if(firstName.includes(" ")){
            $(".error_msg").text("First Name Is Not Valid. Please Remove Extra Space");
            $(".error_msg").show();
            return false;
         }else if(lastName.length === 0 ){
            $(".error_msg").text("Last Name Required");
            $(".error_msg").show();
            return false;
         }else if(lastName.includes(" ")){
            $(".error_msg").text("Last Name Is Not Valid. Please Remove Extra Space.");
            $(".error_msg").show();
            return false;
         }else if(mobile.trim().length !== 10 ){
            $(".error_msg").text("Mobile No. Must Contains 10 Digits");
            $(".error_msg").show();
            return false;
         }else if(address.trim().length <= 5 ){
            $(".error_msg").text("Address Should Be More Than 5 characters.");
            $(".error_msg").show();
            return false;
         }else if(email.trim().length === 0 || !email.includes('@')){
            $(".error_msg").text("Email is Not Valid");
            $(".error_msg").show();
            return false;
         }  else if(!password.match(passwordPattern)){        
            // fasle
            $(".error_msg").text("Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
            $(".error_msg").show();
            return false;
          }else{
            $(".error_msg").css("display","none");
            return true;
          }
      }
    </script>

    <?php
      if(
        isset($_POST["firstName"]) &&
        isset($_POST["lastName"]) &&
        isset($_POST["mobile"]) &&
        isset($_POST["address"]) &&
        isset($_POST["email"]) &&
        isset($_POST["password"]) 
        ){
            //  hide all alert box
          ?>
                <script>
                      $(".success_msg").css("display","none");
                      $(".error_msg").css("display","none");
                </script>
          <?php 

          if(
            !empty($_POST["firstName"]) &&
            !empty($_POST["lastName"]) &&
            !empty($_POST["mobile"]) &&
            !empty($_POST["address"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["password"])
            ){
              // proceed
              include "../api/helper/ValidationHelper.php";
                $firstName = $_POST["firstName"];
                $lastName = $_POST["lastName"];
                $mobile = $_POST["mobile"];
                $address = $_POST["address"];
                $email = $_POST["email"];
                $password = $_POST["password"];
                $status= 1;

             if(!ValidationHelper::validateName($firstName)){
                  //  if firstName validation failed
               ?>
               <script>
                   $(".error_msg").text("Invalid First Name");
                   $(".error_msg").show();
               </script>
            <?php
             }elseif(!ValidationHelper::validateName($lastName)){
              //  if last validation failed
           ?>
           <script>
               $(".error_msg").text("Invalid Last Name");
               $(".error_msg").show();
           </script>
        <?php
         }elseif(!ValidationHelper::validateEmail($email)){
                   //  if email validation failed
                ?>
                <script>
                    $(".error_msg").text("Invalid Email");
                    $(".error_msg").show();
                </script>
             <?php
              }elseif(!ValidationHelper::validateEmail($mobile)){
                //  if mobile no. validation failed
             ?>
             <script>
                 $(".error_msg").text("Invalid Mobile No.");
                 $(".error_msg").show();
             </script>
          <?php
           } elseif(!ValidationHelper::validatePassword($password)){
                //  if password validation failed
                ?>
                   <script>
                       $(".error_msg").text("Password must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters");
                       $(".error_msg").show();
                   </script>
                <?php
              }else{
                // check user email already exist or not
                $encrypted_password = md5($password);
                include "../api/db.php";
                $sql =  $conn->prepare("SELECT * FROM users WHERE USER_EMAIL= ?");
                $sql->bind_param("s", $email);
                $sql->execute();
                $result = $sql->get_result();
                if($result->num_rows === 0){
                  // new user user then insert new user info into db
                  include "../api/User.php";
                  $user =new User($conn);
                  if($user->insertNewUser($firstName,$lastName,$mobile,$address,$email,$encrypted_password)){
                          // success
                    ?>
                      <script>                    
                          $(".success_msg").text("Your New Account Created Successfully.");
                          $(".success_msg").css("display","block");
                          $(".error_msg").css("display","none");                          
                      </script>
                    <?php
                  }else{
                      //  error
                   ?>
                    <script>                    
                        $(".error_msg").text("Oops! Something Went Wrong. Contact To Admin.");
                        $(".error_msg").css("display","block");
                    </script>
                  <?php
                  }
                                    
                }else{
                  ?>
                    <script>                    
                        $(".error_msg").text("Sorry, <?php echo $email; ?> is already taken by another user.");
                        $(".error_msg").css("display","block");
                    </script>
                  <?php
                }
                $sql->close();
                $conn->close();
               
              }          
            }else{
               ?>
                  <script>
                       $(".error_msg").text("All Fields Are Required.");
                       $(".error_msg").css("display","block");
                  </script>
               <?php 
            }
            
            ?>
            <script>history.pushState({}, "", "")</script>
            <?php
      }
    ?>
  </body>
</html>
