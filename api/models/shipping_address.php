<?php
// Order model
class ShippingAddress
{
  private $conn;
  private $table_name = "Shipping_Address";

  private $addressline;
  private $city;
  private $province;
  private $country;
  private $postalcode;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  function create()
  {
    // insert query
    $query = "INSERT INTO " . $this->table_name . "(addressline, city, province, country, postalcode) VALUES (:addressline, :city, :firstname, :lastname)";

    $stmt = $this->conn->prepare($query);

    $this->addressline =  htmlspecialchars(strip_tags($this->addressline));
    $this->city = htmlspecialchars(strip_tags($this->city));
    $this->province = htmlspecialchars(strip_tags($this->province));
    $this->country = htmlspecialchars(strip_tags($this->country));
    $this->postalcode = htmlspecialchars(strip_tags($this->postalcode));

    $stmt->bindParam(':addressline', $this->addressline);
    $stmt->bindParam(':city', $this->city);
    $stmt->bindParam(':province', $this->province);
    $stmt->bindParam(':country', $this->country);
    $stmt->bindParam(':postalcode', $this->postalcode);

    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
