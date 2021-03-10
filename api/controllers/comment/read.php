<?php
// required headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../../config/database.php';
include_once '../../models/comment.php';

// instantiate database and product object
$database = new Database();
$db = $database->getConnection();

// initialize object
$comment = new Comment($db);

// query products
$stmt = $comment->read();
$num = $stmt->rowCount();

// check if more than 0 record found
if ($num > 0) {
    // products array
    $comments_arr = array();
    $comments_arr["comments"] = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $comment_item = array(
            "id" => $id,
            "rating" => html_entity_decode($rating),
            "text" => $text,
            "productId" => $productId
        );

        array_push($comments_arr["comments"], $comment_item);
    }

    // set response code - 200 OK
    http_response_code(200);

    // show products data in json format
    echo json_encode($comments_arr);
} else {

    // set response code - 404 Not found
    http_response_code(404);

    // tell the user no products found
    echo json_encode(
        array("message" => "No comments found.")
    );
}
