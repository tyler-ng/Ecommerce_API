<?php
// User model
class User
{
  private $conn;
  private $table_name = "User";

  public $id;
  public $firstname;
  public $lastname;
  public $email;
  public $password;
  public $phone_number;

  public function __construct($db)
  {
    $this->conn = $db;
  }


  // create user method
  function create()
  {
    // insert query
    if (!empty($this->password)) {
      $query = "INSERT INTO " . $this->table_name . "(email, password, firstname, lastname, phone_number) VALUES (:email, :password, :firstname, :lastname, :phone_number)";
    } else {
      $query = "INSERT INTO " . $this->table_name . "(email, firstname, lastname, phone_number) VALUES (:email, :firstname, :lastname, :phone_number)";
    }

    $stmt = $this->conn->prepare($query);

    // sanitize posted data
    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->email = htmlspecialchars(strip_tags($this->email));
    if (!empty($this->password)) {
      $this->password = htmlspecialchars(strip_tags($this->password));
    }
    $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));

    // bind the values

    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':phone_number', $this->phone_number);
    // hash the password first
    if (!empty($this->password)) {
      $password_hash = password_hash($this->password, PASSWORD_BCRYPT);
      $stmt->bindParam(':password', $password_hash);
    }

    // execute the query and return if it was successful
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }

  function emailExists()
  {
    $query = "SELECT id, firstname, lastname, password FROM " . $this->table_name . " WHERE email = ? LIMIT 0,1";

    $stmt = $this->conn->prepare($query);

    // sanitize
    $this->email = htmlspecialchars(strip_tags($this->email));

    $stmt->bindParam(1, $this->email);

    $stmt->execute();

    $num = $stmt->rowCount();

    if ($num > 0) {
      // get record details
      $row = $stmt->fetch(PDO::FETCH_ASSOC);

      // assign value to object properties
      $this->id = $row['id'];
      $this->firstname = $row['firstname'];
      $this->lastname = $row['lastname'];
      $this->password = $row['password'];

      // return true if email exist
      return true;
    }
    return false;
  }

  function update()
  {
    // if update password
    $set_password = !empty($this->password) ? ", password = :password" : "";

    // set query string for updating user into db
    $query = "UPDATE " . $this->table_name . "
                  SET
                    email = :email
                    {$set_password},
                    firstname = :firstname,
                    lastname = :lastname,
                    phone_number = :phone_number
                  WHERE id = :id";
    // prepare the query
    $stmt = $this->conn->prepare($query);

    // sanitize data
    $this->email = htmlspecialchars(strip_tags($this->email));
    $this->firstname = htmlspecialchars(strip_tags($this->firstname));
    $this->lastname = htmlspecialchars(strip_tags($this->lastname));
    $this->phone_number = htmlspecialchars(strip_tags($this->phone_number));

    // values binding
    $stmt->bindParam(':id', $this->id);
    $stmt->bindParam(':email', $this->email);
    $stmt->bindParam(':firstname', $this->firstname);
    $stmt->bindParam(':lastname', $this->lastname);
    $stmt->bindParam(':phone_number', $this->phone_number);

    // password hashing
    $this->password = htmlspecialchars(strip_tags($this->password));
    if (!empty($this->password)) {
      $this->password = htmlspecialchars(strip_tags($this->password));
      $hashed_password = password_hash($this->password, PASSWORD_BCRYPT);
      $stmt->bindParam(':password', $hashed_password);
    }

    // finally execute the query
    if ($stmt->execute()) {
      return true;
    }

    return false;
  }
}
