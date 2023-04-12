<!-- Controller -->
<!-- More on logic -->

<?php

// PDO connection
// require_once('dbconnection.php');
// require_once('./index.php');
require_once('../model/db.php');


// Create object of the database
$db = new Database();

// PDO

// View account information in jqGrid
// if(isset($_POST['action']) && $_POST['action'] == 'view'){
//   $output = '';
//   // Object read get from inherited class
//   $data = $db->read();
//   if($db->totalRowCount() == 0){
//     echo "No data.";
//   }
// }
// View account information in jqGrid



// ---------------------------------------------------

// Regions
if(isset($_POST['island_id'])){
  $islandId = $_POST['island_id'];
  // $island_query = mysqli_query($connect, "SELECT * FROM region WHERE island_id = $islandId");
  $statement = $pdo->query("SELECT * FROM region WHERE island_id = $islandId");

  ?>
  <select name="region" id="" class="reset" class="form-control">
    <option value="">Select region...</option>
    <?php
      // while($row_region = mysqli_fetch_assoc($island_query)):
      while($row_region = $statement->fetch(PDO::FETCH_ASSOC)):
    ?>
      <option value="<?php echo htmlspecialchars($row_region['region_id']); ?>"><?php echo htmlspecialchars($row_region['region_name']); ?></option>
    <?php
      endwhile;
    ?>
  </select>
  
  <?php
}
// Regions

// Provinces
if(isset($_POST['region_id'])){
  $regionId = $_POST['region_id'];
  $statement = $pdo->query("SELECT * FROM province WHERE region_id = $regionId");

  ?>
  <select name="province" id="province" class="reset" class="province form-control">
    <option value="">Select province...</option>
    <?php
      while($row_province = $statement->fetch(PDO::FETCH_ASSOC)):
    ?>
      <option value="<?php echo htmlspecialchars($row_province['province_id']); ?>"><?php echo htmlspecialchars($row_province['province_name']); ?></option>
    <?php
      endwhile;
    ?>
  </select>
  
  <?php
}
// Provinces


// // Cities
if(isset($_POST['province_id'])){
  $provinceId = $_POST['province_id'];
  // $city_query = mysqli_query($connect, "SELECT * FROM city WHERE province_id = ");
  $statement = $pdo->query("SELECT * FROM city WHERE province_id = $provinceId");

  ?>
  <select name="city" id="city" class="reset" class="form-control">
    <option value="">Select city...</option>
    <?php
      while($row_city = $statement->fetch(PDO::FETCH_ASSOC)):
    ?>
      <option value="<?php echo htmlspecialchars($row_city['city_id']) ?>"><?php echo htmlspecialchars($row_city['city_name']) ?></option>
    <?php
      endwhile;
    ?>
  </select>
  
  <?php
}
// // Cities



// Barangay
if(isset($_POST['city_id'])){
  $cityId = $_POST['city_id'];
  // $brgy_query = mysqli_query($connect, "SELECT * FROM barangay WHERE city_id = ");

  $statement = $pdo->query("SELECT * FROM barangay WHERE city_id = $cityId");

  ?>
  <select name="brgy" id="brgy" class="reset" class="form-control">
    <option value="">Select barangay...</option>
    <?php
      while($row_brgy = $statement->fetch(PDO::FETCH_ASSOC)):
    ?>
      <option value="<?php echo htmlspecialchars($row_brgy['barangay_id']) ?>"><?php echo htmlspecialchars($row_brgy['barangay_name']) ?></option>
    <?php
      endwhile;
    ?>
  </select>
  
  <?php
}
// // Barangay


// ---------------------------------------------------

// Insert data to account information database
//  && $_POST['action'] == 'insert'
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
// if(isset($_POST['action']) && $_POST['action'] == "insert"){

  // Do the get try get the get the data thru get lol

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  // It sanitize data from html input with htmlspecialchars
// if(isset($_POST["form_data"])){
  $lname = $_POST['lastname'];
  $fname = $_POST['firstname'];

  $island = $_POST['island'];
  $region = $_POST['region'];
  $province = $_POST['province'];
  $city = $_POST['city'];
  $barangay = $_POST['brgy'];

  $name = htmlspecialchars($fname . " " . $lname);
  $status = $_POST['status'];

  $accId = $_POST['accId'];
  $address = htmlspecialchars($island . ", " . $region . ", " . $province . ", " . $city . ", " . $barangay);
  $gender = $_POST['gender'];
  

  // Sanitize the data before inserting it into the database

  $userAddress = filter_var($address, FILTER_SANITIZE_STRING);
  $userGender = filter_var($gender, FILTER_SANITIZE_STRING);
  $statusaccount = filter_var($status, FILTER_SANITIZE_STRING);

  // Set the db object and call the insert method and pass all the variable that declared in the insert method in model
  // , $address, $gender
  // $db->insertAccDetails($accId, $userAddress, $userGender);
  $checkData = $db->insertAcc($name, $statusaccount);
  // echo $checkData;
  // return $checkData;

  if($checkData){
    echo "Data inserted successfully!";
  } else{
    echo "Error inserting data";
  }

  
  // echo $lname;
  // print_r($check);  
  // // var_dump($check);
  // exit();
  // header("Location:../index.php");
}






// if(isset($_POST['action']) && $_POST['action'] == 'insert'){

//   $lname = $_POST['lastname'];
//   $fname = $_POST['firstname'];

//   $name = $fname . " " . $lname;

//   $island = $_POST['island'];
//   $region = $_POST['region'];
//   $province = $_POST['province'];
//   $city = $_POST['city'];
//   $barangay = $_POST['barangay'];

//   $address = $island . "," . $region . "," . $province . "," . $city . "," $barangay;

//   $gender = $_POST['gender'];
//   $status = $_POST['status'];

//   // Set the db object and call the insert method and pass all the variable that declared in the insert method in model
//   $db->insert($name, $status, $address, $gender);

// }
// Insert data to account information database

?>


<!-- Controller -->