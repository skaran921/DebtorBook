<?php
// generate json web token
include_once './core.php';
include_once './src/BeforeValidException.php';
include_once './src/ExpiredException.php';
include_once './src/SignatureInvalidException.php';
include_once './src/JWT.php';

use \Firebase\JWT\JWT;

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST,GET");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


function showErrorMsg($msg, $errCode = 400)
{
    http_response_code($errCode);
    $result["msg"] = "$msg";
    $result["err"] = "X";
    echo json_encode($result);
}

function showSuccessMsg(String $msg = "Success", array $results, int $errCode = 200)
{
    http_response_code($errCode);
    $result["msg"] = "$msg";
    $result["results"] = $results;
    $result["err_msg"] = "";
    echo json_encode($result);
}

function validateJwtToken($token, $key)
{
    if ($token) {
        try {
            // decode jwt
            $decoded = JWT::decode($token, $key, array('HS256'));
            return $decoded->data;
        } catch (Exception $e) {
            return false;
        }
    } else {
        return false;
    }
}

/// routes constants
$loginRoute = "/login";
$createNewDebtor = "/debtor/create";
$getAllActiveDebtor = "/debtor/read";
$getUserDetailById = "/getUserDetailById";

if (isset($_POST["ROUTE"])) {
    include_once "./db.php";
    $route = $_POST["ROUTE"];
    switch ($route) {
        case $loginRoute:
            loginAuthentication($conn, $key, $issued_at, $expiration_time, $issuer);
            break;
        case $createNewDebtor:
            createNewDebtor($conn, $key);
            break;
        case $getAllActiveDebtor:
            getAllActiveDebtors($conn, $key);
            break;
        case $getUserDetailById:
            getUserDetailById($conn, 1);
            break;
        default:
            showErrorMsg("Sorry, no valid route found!");
    }
} else {
    showErrorMsg("Sorry, no route found!");
}






function loginAuthentication($conn, $key, $issued_at, $expiration_time, $issuer)
{
    if (isset($_POST["EMAIL"]) && isset($_POST["PASSWORD"]) &&  !empty($_POST["EMAIL"]) && !empty($_POST["PASSWORD"])) {
        include_once "./User.php";
        $email = $_POST["EMAIL"];
        $password = $_POST["PASSWORD"];
        $user = new User($conn);
        $response = $user->authenticationUser($email, $password);
        if (gettype($response) === 'string') {
            /// error
            showErrorMsg($response, 401);
        } else {
            include_once './core.php';

            /// success
            $response["USER_PASSWORD"] = "";
            // showSuccessMsg("success", $response);
            $token = array(
                "iat" => $issued_at,
                "exp" => $expiration_time,
                "iss" => $issuer,
                "data" => $response
            );
            // generate jwt
            $jwt = JWT::encode($token, $key);
            $result["msg"] = "Successful login.";
            $result["err"] = "";
            $result["jwt"] = $jwt;
            echo json_encode(($result));
        }
    } else {
        showErrorMsg("Sorry, email and password are required");
    }
}

// getUserById
function getUserDetailById($conn, $userId)
{
    include_once "./User.php";
    $user = new User($conn);
    $response = $user->getUserDetails($userId);
    showSuccessMsg("Success", $response);
}



/// create new debtor
function createNewDebtor($conn, $key)
{
    if (isset($_POST['JWT']) && isset($_POST['NAME']) && !empty($_POST['JWT']) && !empty($_POST['NAME'])) {
        $jwt = $_POST['JWT'];
        $jwtToken = validateJwtToken($jwt, $key);
        if ($jwtToken) {
            $user_id =  $jwtToken->USER_ID;
            include "./Debtors.php";
            $debtor = new Debtors($conn);
            $debtorName = $_POST["NAME"];
            $debtorMobile = $_POST["MOBILE"];
            $debtorEmail  = $_POST["EMAIL"];
            $debtorAddress = $_POST["ADDRESS"];

            $response = $debtor->insertDebtor($debtorName, $debtorMobile, $debtorEmail, $debtorAddress, $user_id);
            if ($response === -1) {
                /// error
                echo showErrorMsg("Debtor Account Already Exist");
            } else {
                /// success
                showSuccessMsg("Debtor Account Create", []);
            }
        } else {
            echo showErrorMsg("Authentication Failed", 401);
        }
    } else {
        echo showErrorMsg("Missing Required Fields");
    }
}


/// get ALl Active debtor
function getAllActiveDebtors($conn, $key)
{
    if (isset($_POST['JWT'])  && !empty($_POST['JWT'])) {
        $jwt = $_POST['JWT'];
        $jwtToken = validateJwtToken($jwt, $key);
        if ($jwtToken) {
            $user_id =  $jwtToken->USER_ID;
            include "./Debtors.php";
            $debtor = new Debtors($conn);
            $response = $debtor->getActiveDebtors($user_id);
            showSuccessMsg("success", $response);
        } else {
            echo showErrorMsg("Authentication Failed", 401);
        }
    } else {
        echo showErrorMsg("Missing Required Fields");
    }
}
