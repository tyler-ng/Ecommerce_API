<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../../config/database.php';
include_once '../../models/product.php';

// get db connection
$database = new DataBase();
$db = $database->getConnection();

$single_product = new Product($db);

// set product id which is from url query
$single_product->id = isset($_GET['id']) ? $_GET['id'] : die();

$single_product->read_one();

if ($single_product->name != null) {
  $details_array = array(
    "id" => $single_product->id,
    "name" => $single_product->name,
    "description" => $single_product->description,
    "price" => $single_product->price,
    "image" => $single_product->image,
    "shipping_cost" => $single_product->shipping_cost
  );

  http_response_code(200);
  echo json_encode($details_array);
} else {
  http_response_code(404);
  echo json_encode(array("message" => "Product not found."));
}
