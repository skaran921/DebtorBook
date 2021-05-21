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
    $result["err_msg"] = "X";
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

/// routes constants
$loginRoute = "/login";
$getUserDetailById = "/getUserDetailById";

if (isset($_POST["ROUTE"])) {
    include_once "./db.php";
    $route = $_POST["ROUTE"];
    switch ($route) {
        case $loginRoute:
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
            break;
        case $getUserDetailById:
            /// TODO: add a param for user id
            include_once "./User.php";
            $user = new User($conn);
            $response = $user->getUserDetails(1);
            showSuccessMsg("Success", $response);
            break;
        default:
            showErrorMsg("Sorry, no valid route found!");
    }
} else {
    showErrorMsg("Sorry, no route found!");
}
