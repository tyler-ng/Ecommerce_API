<?php
header("Access-Control-Allow-Origin: http://localhost/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

include_once '../../config/database.php';
include_once '../../models/user.php';

// get db connection
$database = new Database();
$db = $database->getConnection();

// initial a user object
$user = new User($db);

// check email existence
$data = json_decode(file_get_contents("php://input"));

// dependencies required to decode jwt
include_once '../../config/core.php';
include_once '../../helps/libs/php-jwt-master/src/BeforeValidException.php';
include_once '../../helps/libs/php-jwt-master/src/ExpiredException.php';
include_once '../../helps/libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../../helps/libs/php-jwt-master/src/JWT.php';


use \Firebase\JWT\JWT;

// get back jwt from $data
$jwt = isset($data->jwt) ? $data->jwt : "";

// check if jwt is not empty
if ($jwt) {
  try {
    // decode jwt with HS256 standard
    $payload = JWT::decode($jwt, $key, array('HS256'));

    // assign user properties to new values
    $user->id = $payload->data->id;
    $user->email = $data->email;
    $user->password = $data->password;
    $user->firstname = $data->firstname;
    $user->lastname = $data->lastname;
    $user->phone_number = $data->phone_number;

    // update user
    if ($user->update()) {
      // re-generate jwt cause user has been updated
      $token = array(
        "iat" => $issued_at,
        "exp" => $expiration_time,
        "iss" => $issuer,
        "data" => array(
          "id" => $user->id,
          "firstname" => $user->firstname,
          "lastname" => $user->lastname,
          "email" => $user->email,
        )
      );
      $jwt = JWT::encode($token, $key);

      http_response_code(200);
      $user->password = "";
      echo json_encode(array(
        "message" => "User was updated.",
        "jwt" => $jwt
      ));
    } else {
      http_response_code(401);
      echo json_encode((array(
        "message" => "Unable to update user."
      )));
    };
  } catch (Exception $e) {
    http_response_code(401);
    echo json_encode(array(
      "message" => "Access denied/unauthorized.",
      "error" => $e->getMessage()
    ));
  }
} else {
  http_response_code(401);
  echo json_encode(array(
    "message" => "Access denied/unauthorized."
  ));
}
