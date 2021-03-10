<?php
class Comment{
  
    // database connection and table name
    private $conn;
    private $table_name = "comments";

    public $id;
    public $rating;
    public $text;
    public $productId;
    
    // constructor with $db as database connection
    public function __construct($db){
        $this->conn = $db;
    }

    function create(){
        // insert query
    $query = "INSERT INTO " . $this->table_name . "(rating, text, productId) VALUES (:rating, :text, :productId)";

    $stmt = $this->conn->prepare($query);

    // sanitize posted data
    $this->rating = htmlspecialchars(strip_tags($this->rating));
    $this->text = htmlspecialchars(strip_tags($this->text));
    $this->productId = htmlspecialchars(strip_tags($this->productId));


    // bind the values
    $stmt->bindParam(':rating', $this->rating);
    $stmt->bindParam(':text', $this->text);
    $stmt->bindParam(':productId', $this->productId);

    // execute the query and return if it was successful
    if ($stmt->execute()) {
        return true;
      }
  
      return false;
    }

    // read products
    function read()
    {

        // select all query
        $query = "SELECT * FROM $this->table_name";

        // prepare query statement
        $stmt = $this->conn->prepare($query);

        // execute query
        $stmt->execute();

        return $stmt;
    }

    function read_one()
    {

         // select all query
         $query = "SELECT * FROM " . $this->table_name . " WHERE comments.productId = ?";

         // prepare query statement
         $stmt = $this->conn->prepare($query);

         $stmt->bindParam(1, $this->id);

         // execute query
         $stmt->execute();

         return $stmt;

        }
}