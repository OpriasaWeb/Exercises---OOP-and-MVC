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

if(isset($_POST['action']) && $_POST['action'] == "insert"){

  $lname = $_POST['lname'];
  $fname = $_POST['fname'];
  $fullname = $fname . " " . $lname;
  $stat = $_POST['status'];

  $island = $_POST['islandName'];
  $region = $_POST['regionName'];
  $province = $_POST['provinceName'];
  $city = $_POST['cityName'];
  $barangay = $_POST['barangayName'];
  $address = $_POST['ddrss'];

  $full_address = $address . ", " . $barangay . ", " . $city . ", " . $province . ", " . $region . ", " . $island;

  $id = $_POST['accId'];

  $gender = $_POST['gndr'];

  $checkInsert = $db->insertAcc($fullname, $stat);
  $checkAddress = $db->insertAccDetails($id, $full_address, $gender);

  if($checkInsert && $checkAddress){
    echo "
      <script>console.log('Inserted successfully.')</script>
    ";
  } else{
    echo "
      <script>console.log('Inserting data failed.')</script>
    ";
  }
}

// Insert data to account information database
//  && $_POST['action'] == 'insert'
// if($_SERVER['REQUEST_METHOD'] == 'POST'){
// if(isset($_POST['action']) && $_POST['action'] == "insert"){

  // Do the get try get the get the data thru get lol


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