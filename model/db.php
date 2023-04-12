
<!-- MODEL -->
<!-- All related database connection and insert data -->

<?php

// require_once('../controller/ph_address.php');  

// PDO
$pdo = new PDO('mysql:host=localhost;dbname=address', 'root', '@raym33B3m14');
$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

class Database{
  private $dsn = "mysql:host=localhost;dbname=address";
  private $user = "root";
  private $pass = "@raym33B3m14";
  public $conn;


  public function __construct(){
    try{
      $this->conn = new PDO($this->dsn, $this->user, $this->pass);
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      echo 'Successfully connected';
    } catch(PDOException $e){
      echo $e->getMessage();
    }
  }

  // Insert define method
  public function insertAcc($fullname, $stat){

    $sql = "INSERT INTO account (name, status) VALUES (:name, :status);";
    
    $statement = $this->conn->prepare($sql);  

    $statement->bindparam("name", $fullname, PDO::PARAM_STR); // PDO::PARAM_STR - represents the SQL CHAR, VARCHAR, or other string data type.
    $statement->bindparam("status", $stat);

    $statement->execute();
    
    return true;
    // echo 'Successfully inserted';
    // echo $statement;
    // print_r($statement);  
    // var_dump($check);
    // exit();
    // try{
      

    // } 
    // catch (PDOException $e){
    //   echo $e->getMessage();
    // }
    
  }   
  // Insert define method

  // Insert to account details
  public function insertAccDetails($id, $full_address, $gender){
    $sql = "INSERT INTO accountdetails (account_id, address, gender) VALUES (:account_id, :address, :gender)";

    $statement = $this->conn->prepare($sql);

    $statement->bindparam(":account_id", $id);
    $statement->bindparam(":address", $full_address);
    $statement->bindparam(":gender", $gender);
    // PDO::PARAM_STR
    
    $statement->execute();
    return true;
  }
  // Insert to account details


  // Read define method
  public function view_info(){
    $data = array();
    $sql = "SELECT a.name, ad.address, a.status FROM account a LEFT JOIN accountdetails ad ON a.id = ad.account_id";
    $statement = $this->conn->prepare($sql);
    $statement->execute();
    $result = $statement->fetchAll(PDO::FETCH_ASSOC);
    foreach($result as $row){
      $data[] = $row;
    }
    return $data;
  }
  // Read define method 


  // Get user ID
  public function getUserId($id){
    $sql = "SELECT * FROM account WHERE id = :id";
    $statement = $this->conn->prepare($sql);
    $statement->execute([
      'id'=>$id
    ]);
    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
  }
  // Get user ID

  // Island data
  public function getIsland(){
    $island_sql = "SELECT * FROM island";
    $statement = $this->conn->prepare($island_sql);
    $statement->execute();
    $island_result = $statement->fetch(PDO::FETCH_ASSOC);
    return $island_result;
  }
  // Island data
}

// Create new object of the Database class
// $objDatabase = new Database();
// echo $objDatabase->totalRowCount();

// PDO


?>

<!-- All related data connection, insert data -->
<!-- MODEL -->