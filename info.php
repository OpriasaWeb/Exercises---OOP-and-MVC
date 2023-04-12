<?php


?>

<!-- Include header -->
<?php
  include 'includes/header.php'
?>
<body>

  <div class="container m-5">
    <p class="fs-4 float-end">View info</p>
    <a href="./index.php" class="btn btn-info">Back</a>

    <table id="myGrid"></table>
    <div id="myGridPager"></div>
  </div>


  <script type="text/javascript">
    $(function () {
      $("#myGrid").jqGrid({
        url: "mydata.json", // URL for grid data
        datatype: "mysql", // Data type for grid data
        colNames: ["Name", "Address", "Status"], // Column names for grid data
        colModel: [ // Column models for grid data
          { name: "name", index: "name", width: 150 },
          { name: "age", index: "age", width: 50 },
          { name: "email", index: "email", width: 200 }
        ],
        pager: "#myGridPager", // ID for grid pager
        rowNum: 10, // Number of rows to display at a time
        rowList: [10, 20, 30], // Options for number of rows to display at a time
        viewrecords: true, // Show record count in pager
        caption: "Account holder" // Grid caption
      });
    });
  </script>
  
  


  <!-- Include header -->
  <?php
    include 'includes/footer.php'
  ?>
</body>
</html>