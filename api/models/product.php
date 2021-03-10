<?php
class Product
{
    // database connection and table name
    private $conn;
    private $table_name = "Product";

    public $id;
    public $name;
    public $description;
    public $image;
    public $price;
    public $shipping_cost;

    // constructor with $db as database connection
    public function __construct($db)
    {
        $this->conn = $db;
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
        $query = "SELECT * FROM " . $this->table_name . " WHERE Product.id = ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);

        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->name = $row['name'];
        $this->price = $row['price'];
        $this->description = $row['description'];
        $this->image = $row['image'];
        $this->shipping_cost = $row['shippingcost'];
    }
}
