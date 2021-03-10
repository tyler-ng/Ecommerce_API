<?php
header("Access-Control-Allow-Origin: http://localhost/api/");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// dependencies required to decode jwt
include_once '../../config/core.php';
include_once '../../helps/libs/php-jwt-master/src/BeforeValidException.php';
include_once '../../helps/libs/php-jwt-master/src/ExpiredException.php';
include_once '../../helps/libs/php-jwt-master/src/SignatureInvalidException.php';
include_once '../../helps/libs/php-jwt-master/src/JWT.php';

use \Firebase\JWT\JWT;

// get content from post request body
$data = json_decode(file_get_contents("php://input"));

// get back jwt from $data
$jwt = isset($data->jwt) ? $data->jwt : "";

// check if jwt is not empty
if ($jwt) {
  try {
    // decode jwt with HS256 standard
    $payload = JWT::decode($jwt, $key, array('HS256'));

    http_response_code(200);

    echo json_encode(array(
      "message" => "Access authorized.",
      "data" => $payload->data
    ));
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
