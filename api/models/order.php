<?php
// Order model
class Order
{
  private $conn;
  private $table_name = "Orders";

  private $subtotal;
  private $taxes;
  private $total;
  private $count;
  private $userId;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  // add order record
  function create()
  {
    // insert query
    // need information from cart:
    // subtotal, taxes, total, count, userId
    // save data into order table
    // save orderId, quantity, and productId into order_item
    $query = "INSERT INTO " . $this->table_name . "";
  }

  // get all orders of an user account
  function get_user_order()
  {
  }
}
