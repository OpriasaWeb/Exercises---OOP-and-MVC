<!-- View -->

<?php
session_start();

// Include database connection
require_once('./model/db.php');
// require_once('./controller/ph_address.php');

$db = new Database();

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}






?>


<!-- Include header -->
<?php
  include 'includes/header.php'
?>

<body>
  <div class="container">
    <div class="m-5">
    <p class="fs-4">PhilWeb exercises</p>
    <a href="./info.php" class="btn btn-success float-end">View info</a>
    </div>
  </div>

  <div class="input-section">
    <div class="container-input">
      <!-- ./controller/ph_address.php -->
    <form action="" method="POST" name="form-data" id="form-data">
      <div class="mb-3">
        <label for="" class="form-label">Lastname <span class="limitation">(Only letters, period and space are allowed)</span></label>
        <input type="text" name="lname" id="lastname" class="form-control" maxlength="32" onInput="getLname()" required> 
        <span id="resultLname"></span>
        <!-- pattern="^[^~!$%^?]$" title="Only the letters, period and space are allowed." -->
      </div>
      <div class="mb-3">
        <label for="" class="form-label">Firstname <span class="limitation">(Only letters, period and space are allowed)</span></label>
        <input type="text" name="fname"  id="firstname" class="form-control" maxlength="32" onInput="getFname()" required>
        <span id="resultFname"></span>
        <!-- pattern=^[^~!$%^?]$" title="Only the letters, period and space are allowed." -->
      </div>
      <p class="fs-5 text-bold">Address</p>

      <input type="hidden" name="accId" value="1">
      <input type="hidden" name="status" value="online">

      <label for="island">Island</label>
      <span id="resultIsland"></span>
      <select id="island" name="slnd" class="reset form-select mb-3">
        <!-- value="<?php echo $island['island_name'] ?>" -->
        <option value="" selected disabled>Select an island...</option>

        <!-- Fetching island from database using while loop -->
        <?php
          // fetching island data from db
          // $statement = $db->getIsland();
          $statement = $pdo->query("SELECT * FROM island");
          while($island = $statement->fetch(PDO::FETCH_ASSOC)){
        ?>
          <option value="<?php echo $island['island_id'] ?>"><?php echo $island['island_name'] ?></option>
        <?php
          } 
        ?>
          
        
        <!-- Fetching island from database using while loop -->
        
      </select>
      

      <label for="region">Region</label>
      <span id="resultRegion"></span>
      <select class="reset form-select mb-3" name="rgn" id="region" placeholder="Select region...">
        <option disabled>Select region...</option>
      </select>
      

      <label for="province">Province</label>
      <span id="resultProvince"></span>
      <select class="reset province form-select mb-3" name="prvnc" id="province">
        <option disabled>Select province...</option>
      </select>
      

      <label for="city">City</label>
      <span id="resultCity"></span>
      <select class="reset form-select mb-3" name="ct" id="city">
        <option disabled>Select city...</option>
      </select>
      

      <label for="barangay">Barangay</label>
      <span id="resultBarangay"></span>
      <select class="reset form-select mb-3" name="brgy" id="barangay">
        <option disabled>Select barangay...</option>
      </select>
      

      <div class="mb-3">
        <label for="" class="form-label">Bldg/Blk/Lot/Subd</label>
        <input type="text" onInput="addressInput()" name="ddrss" id="address" pattern="^[a-zA-Z0-9\s,'-]*$" title="!, $, %, ^ are not allowed" class="address form-control">
        <span id="resultAddress"></span>
        
      </div>

      <div class="mb-3">
        <label for="" class="form-label">Gender</label>
        <select id="gender" name="gndr" class="gender form-select" aria-label="Default select example">
          <option value="">Choose...</option>
          <option value="male">Male</option>
          <option value="female">Female</option>
        <!-- <option value="No">I'd rather not to say</option> -->
        </select>
        <span id="resultGender"></span>
        
      </div>

      <div class="mb-3">
        <label>Birthdate <span class="limitation">(21 above are allowed)</span></label>
        <input type="text" name="birthdate" id="datepicker" class="birthdate form-control" placeholder="Date..">
        <span id="resultBirthdate"></span>
      </div>

      <div class="form-group">
        <input type="submit" value="Submit" name="insert" id="insert" class="btn btn-success btn-block mb-3 float-end" onclick="displayData()">
      </div>
      
      <!-- <button type="submit" name="info" id="newUser" class="btn btn-primary float-end mb-3" onclick="displayData()">Submit</button> -->
      <!-- <button type="submit" name="info" id="newUser" class="btn btn-primary float-end mb-3" onclick="displayData()">Submit</button> -->

      
    </form>
    </div>
  </div>

  <!-- Last modal please -->
  <!-- Simple pop-up dialog box, containing a form -->
  <dialog id="favDialog">
    <form method="dialog">
      <button id="close" class="float-end" aria-label="close" formnovalidate>&times;</button>
      <section>
        <p class="fs-4">View info</p>
        <div class="viewInfo" id="viewInfo">
        
        </div>
      </section>
    </form>
  </dialog>
  <!-- Last modal please -->


  <!-- --------------------------------------------------------------------------- -->

  <!-- Footer -->
  <?php
    include 'includes/footer.php'
  ?>
  <!-- Footer -->

  <!-- Date picker -->
  <script type="text/javascript">

    

    // View account information
      // $(document).ready(function(){
      //   $("jqTable").jqGrid();

      //   function showAllUsers(){
      //     $.ajax({
      //       url: "./controller/ph_address.php",
      //       type: "POST",
      //       data: {
      //         action: "view"
      //       },
      //       success:function(response){
      //         console.log(response);
      //       }
      //     })
      //   }
      // });
    // View account information


    // Prevent the bad input in names
    function getLname(){
      let lname = document.getElementById("lastname");
      let lnameValue = lname.value;

      let result = document.getElementById("resultLname");
      // result.innerText = lnameValue;
      
      // create a regular expression to match against the user input
      var regex = /^[a-zA-Z.\s*]*$/;

      // regex for empty input by user
      var emptyInput = /\s*/;

      if(lnameValue == ""){
        result.style.color = 'red';
        result.innerText = "* required";
      }

      if(!regex.test(lnameValue)){
        lname.style.fontWeight = 'bold';
        lname.style.color = 'red';
        result.style.color = 'red';
        result.innerText = "Ooops. Invalid input.";
      } else{
        lname.style.fontWeight = 'normal';
        lname.style.color = 'black';
        result.style.fontWeight = 'bold';
        result.style.color = 'green';
        result.innerText = "Valid input.";
      }
    }

    function getFname(){
      let fname = document.getElementById("firstname");
      let fnameValue = fname.value;

      let resultFname = document.getElementById("resultFname");
      // result.innerText = lnameValue;
      
      // create a regular expression to match against the user input
      var regexfName = /^[a-zA-Z.\s]*$/;

      if(!regexfName.test(fnameValue)){
        fname.style.fontWeight = 'bold';
        fname.style.color = 'red';
        resultFname.style.color = 'red';
        resultFname.innerText = "Ooops. Invalid input.";
      } else{
        fname.style.fontWeight = 'normal';
        fname.style.color = 'black';
        resultFname.style.fontWeight = 'bold';
        resultFname.style.color = 'green';
        resultFname.innerText = "Valid input.";
      }
    }
    // Prevent the bad input in names

    // Prevent bad input of address
    function addressInput(){
      let inputAddress = document.getElementById("address");
      let addressValue = inputAddress.value;

      let resultAddress = document.getElementById("resultAddress");
      // result.innerText = lnameValue;
      
      // regex for address
      var addressRegex = /^[a-zA-Z0-9\s,'-.]*$/;

      if(!addressRegex.test(addressValue)){
        inputAddress.style.fontWeight = 'bold';
        inputAddress.style.color = 'red';
        resultAddress.style.color = 'red';
        resultAddress.innerText = "Ooops. Invalid input.";
      } else{
        inputAddress.style.fontWeight = 'normal';
        inputAddress.style.color = 'black';
        resultAddress.style.fontWeight = 'bold';
        resultAddress.style.color = 'green';
        resultAddress.innerText = "Valid input.";
      }
    }
    // Prevent bad input of address

    // ---------------------------------------------------------- //

    // Form button display data
    function displayData(){

      // Regex pop error message condition
      // Regex for address
      var addressRegex = /^[a-zA-Z0-9\s,'-.]*$/;

      // Address
      var inputAddress = document.getElementById("address");
      var addressValue = inputAddress.value;


      // Regex for lastname and firstname 
      var regex = /^[a-zA-Z.\s]*$/;

      // Lastname
      var lname = document.getElementById("lastname");
      var lnameValue = lname.value;

      // Firstname
      var fname = document.getElementById("firstname");
      var fnameValue = fname.value;

      // Island
      var island = document.getElementById("island");
      var islandValue = island.value;

      // Region
      var region = document.getElementById("region");
      var regionValue = region.value;

      // Province
      var province = document.getElementById("province");
      var provinceValue = province.value;

      // City
      var city = document.getElementById("city");
      var cityValue = city.value;

      // Barangay
      var barangay = document.getElementById("barangay");
      var barangayValue = barangay.value;

      // Gender
      var gender = document.getElementById("gender");
      var genderValue = gender.value;

      // Birthdate
      var birthdate = document.getElementById("datepicker");
      var birthdateValue = birthdate.value;

      // Required message span id
      let resultLname = document.getElementById("resultLname");
      let resultFname = document.getElementById("resultFname");
      let resultAddress = document.getElementById("resultAddress");
      let resultIsland = document.getElementById("resultIsland");
      let resultRegion = document.getElementById("resultRegion");
      let resultProvince = document.getElementById("resultProvince");
      let resultCity = document.getElementById("resultCity");
      let resultBarangay = document.getElementById("resultBarangay");
      let resultGender = document.getElementById("resultGender");
      let resultBirthdate = document.getElementById("resultBirthdate");
      // Required message span id

      // If island left no value
      if(islandValue == ""){
        resultIsland.style.fontWeight = 'bold';
        resultIsland.style.color = 'red';
        resultIsland.innerText = "* required";
        // If any of these if empty
        alert("Island should not be empty.");
        return;
        // if(!islandValue == ""){
        //   resultIsland.innerText = "";
        // }
        // return;
      }
      // If region left no value
      else if(regionValue == ""){
        resultRegion.style.fontWeight = 'bold';
        resultRegion.style.color = 'red';
        resultRegion.innerText = "* required";
        // If any of these if empty
        alert("Region should not be empty.");
        return;
      }
      // If province left no value
      else if(provinceValue == ""){
        resultProvince.style.fontWeight = 'bold';
        resultProvince.style.color = 'red';
        resultProvince.innerText = "* required";
        // If any of these if empty
        alert("Province should not be empty.");
        return;
      }
      // If city left no value
      else if(cityValue == ""){
        resultCity.style.fontWeight = 'bold';
        resultCity.style.color = 'red';
        resultCity.innerText = "* required";
        // If any of these if empty
        alert("City should not be empty.");
        return;
      }
      // If barangay left no value
      else if(barangayValue == ""){
        resultBarangay.style.fontWeight = 'bold';
        resultBarangay.style.color = 'red';
        resultBarangay.innerText = "* required";
        // If any of these if empty
        alert("Barangay should not be empty.");
        return;
      }
      // If gender left no value
      else if(genderValue == ""){
        resultGender.style.fontWeight = 'bold';
        resultGender.style.color = 'red';
        resultGender.innerText = "* required";
        // If any of these if empty
        alert("Gender is required.");
        return;
      }
      // If birthdate left no value
      else if(birthdateValue == ""){
        resultBirthdate.style.fontWeight = 'bold';
        resultBirthdate.style.color = 'red';
        resultBirthdate.innerText = "* required";
        // If any of these if empty
        alert("Birthdate should not be empty.");
        return;
      }
      // If lastname left no value
      else if(lnameValue == ""){
        resultLname.style.fontWeight = 'bold';
        resultLname.style.color = 'red';
        resultLname.innerText = "* required";
        // If any of these if empty
        alert("Last name should not be empty.");
        return;
      } 
      // If firstname left no value
      else if(fnameValue == ""){
        resultFname.style.fontWeight = 'bold';
        resultFname.style.color = 'red';
        resultFname.innerText = "* required";
        alert("First name should not be empty.");
        return;
      } 
      // If address left no value
      else if(addressValue == ""){
        resultAddress.style.fontWeight = 'bold';
        resultAddress.style.color = 'red';
        resultAddress.innerText = "* required";
        alert("Address should not be empty.");
        return;
      } 
      else if(!regex.test(lnameValue) || !regex.test(fnameValue) || !addressRegex.test(addressValue)){
        // if any of these is false
        alert("Kindly recheck the lastname, firstname or address if valid input.");
        return;
      }
      // If no error, show the popup created user
      else{
        // Inputs variable

        // ------------------------------------------------------- //

        // Dialog pop


        const closeButton = document.getElementById("close");
        const dialog = document.getElementById("favDialog");

        // Debugging if working correctly
        function openCheck(dialog) {
          if (dialog.open) {
            console.log("Dialog open");
          } else {
            console.log("Dialog closed");
          }
        }

        // Show the light box containing the data inputted by the user
        dialog.showModal();
        openCheck(dialog);

      
        // Form close button closes the dialog box
        closeButton.addEventListener("click", () => {
          dialog.close();
          openCheck(dialog);

          setTimeout(function() {
            location.reload(true);
          }, 100);
        });

        // Dialog pop

        // ------------------------------------------------------- //
        
        // Content of the input data from the user
        var lname = document.getElementById("lastname").value;
        var fname = document.getElementById("firstname").value;
        var islnd = document.getElementById("island").value;
        var rgn = document.getElementById("region").value;

        // Get the province text content
        var prvnc = document.getElementById("province");
        var prvncOption = prvnc.options[prvnc.selectedIndex];
        var prvncSelected = prvncOption.textContent;
        // Get the province text content

        // Get the city text content
        var ct = document.getElementById("city");
        var ctOption = ct.options[ct.selectedIndex];
        var ctSelected = ctOption.textContent;
        // Get the city text content
        
        // Get the barangay text content
        var brgy = document.getElementById("barangay");
        var brgyOption = brgy.options[brgy.selectedIndex];
        var brgySelected = brgyOption.textContent;
        // Get the barangay text content

        var addrss = document.getElementById("address").value;
        var gndr = document.getElementById("gender").value;
        var birthdate = document.getElementById("datepicker").value;

        // To be display
        var nameOfUser = "Fullname: " + fname + " " + lname;
        var userAddress = "Address: " + addrss + ", " + brgySelected + ", " + ctSelected + ", " + prvncSelected;
        var genderUser = "Gender: " + gndr;
        // To be display

        // Create div to include the info
        const nameDiv = document.createElement("p");
        const addressDiv = document.createElement("p");
        const genderDiv = document.createElement("p");
        // const dialogPop = document.createElement("dialog");

        // Put the context of the string to the newly created div
        nameDiv.textContent = nameOfUser;
        addressDiv.textContent = userAddress;
        genderDiv.textContent = genderUser;

        // Display modal variable text content
        var viewInfo = document.getElementById("viewInfo");

        viewInfo.appendChild(nameDiv);
        viewInfo.appendChild(addressDiv);
        viewInfo.appendChild(genderDiv);

        // alert("Created user successfully!");
        // Content of the input data from the user

        // ------------------------------------------------------- //

        // Form variable to reset
        // location.reload(true);
        // var valForm = document.getElementById("valForm");
        // valForm.reset();


      }
    }
    // Form button display data

    // ---------------------------------------------------------- //

    // Date picker
    $(function(){
      var ageAllowed = new Date('2002-12-31'); // set the start date where the age bracket is allowed, 21 years old up.
      $("#datepicker").datepicker({
        changeMonth: true,
        changeYear: true,
        yearRange: 'c-150:c', // year range from the current date going down to 150 numbers of years
        maxDate: ageAllowed // set to current date using JS object date
      });
    });
    // Date picker

    // ---------------------------------------------------------- //

    // Island
    $(document).ready(function(){
      // Region
      $("#island").change(function(){

        var islandId = $(this).val();

        $.ajax({
          url: "./controller/ph_address.php",
          method: 'POST',
          data:{
            island_id: islandId
          },
          success:function(data){
            $("#region").html(data);
          }
        });
      });

      // Province
      $("#region").change(function(){
        // var islandId = $("#island").val();
        var regionId = $(this).val();
        $.ajax({
          url: "./controller/ph_address.php",
          method: 'POST',
          data:{
            region_id: regionId
          },
          success:function(data){
            $("#province").html(data);
          }
        });
      });

      // City
      $("#province").change(function(){
        var provinceId = $(this).val();
        $.ajax({
          url: "./controller/ph_address.php",
          method: 'POST',
          data:{
            province_id: provinceId
          },
          success:function(data){
            $("#city").html(data);
          }
        });
      });

      // Barangay
      $("#city").change(function(){
        var cityId = $(this).val();
        $.ajax({
          url: "./controller/ph_address.php",
          method: 'POST',
          data:{
            city_id: cityId
          },
          success:function(data){
            $("#barangay").html(data);
          }
        });
      });

    });

    // ---------------------------------------------------------- //

    // Reset click

    // Reset click island
    $("#island").change(function(){
      if($(this)){
        $(".reset").slice(1, 5).find("option").prop("selected", false);
      // console.log(this);
      }
    });

    // // Reset click region
    $("#region").change(function(){
      if($(this)){
        $(".reset").slice(2, 5).find("option").prop("selected", false);
      }
    });

    // // Reset click province
    $("#province").change(function(){
      if($(this)){
        $(".reset").slice(3, 5).find("option").prop("selected", false);
      }
    });
    
    // Reset click

    // ---------------------------------------------------------- //

    // Insert ajax request
    $("#insert").click(function(e){
      if($("#form-data")[0].checkValidity()){

        e.preventDefault();

        // Island item in select
        var islandName = $('select[name="slnd"] option:selected').text();
        // Region item in select
        var regionName = $('select[name="rgn"] option:selected').text();
        // Province item in select
        var provinceName = $('select[name="prvnc"] option:selected').text();
        // City item in select
        var cityName = $('select[name="ct"] option:selected').text();
        // Barangay item in select
        var barangayName = $('select[name="brgy"] option:selected').text();

        var data = $("#form-data").serialize()+"&action=insert&islandName=" + islandName + "&regionName=" + regionName + "&provinceName=" + provinceName + "&cityName=" + cityName + "&barangayName=" + barangayName; // serialize - get the data form and turn it into an array

        // Debugging
        // console.log(data);

        $.ajax({
          url: "./controller/ph_address.php",
          type: "POST",
          data: data,
          success: function(response){
            console.log(response);
          }
          // error: function(error){

          // }
        })
      }

    })
    // Insert ajax request


  </script>
  
</body>
</html>
<!-- View -->