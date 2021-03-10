<?php
// request header's metadata
header("Access-Control-Allow-Origin: *");
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

// get posted data
$data = json_decode(file_get_contents("php://input"));

// set product property values
$user->firstname = $data->firstname;
$user->lastname = $data->lastname;
$user->email = $data->email;
if (!empty($data->password)) {
  $user->password = $data->password;
}
$user->phone_number = $data->phone_number;

// create the user
if (
  !empty($user->firstname) &&
  !empty($user->lastname) &&
  !empty($user->email) &&
  !empty($user->password) &&
  !empty($user->phone_number) &&
  $user->create()
) {
  http_response_code(200);
  echo json_encode(array("message" => "An user account was created."));
} else if (
  (empty($data->password)) &&
  !empty($user->firstname) &&
  !empty($user->lastname) &&
  !empty($user->email) &&
  !empty($user->phone_number) &&
  $user->create()
) {
  http_response_code(200);
  echo json_encode(array("message" => "A guest was recorded."));
} else {
  http_response_code(400);
  echo json_encode(array("message" => "Unable to create user."));
}
