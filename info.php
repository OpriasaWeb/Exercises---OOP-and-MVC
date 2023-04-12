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
    <br>
    <br>
    <br>

    <table id="jqgajax"></table>
    <div id="jqgajax"></div> 
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

    
    jQuery("#jqgajax").jqGrid({
      ajaxGridOptions : {type:"POST"},
      serializeGridData : function(postdata) {
        postdata.page = 1;
        return postdata;
      },
        url:'server.php?q=2',
      datatype: "json",
        colNames:['Inv No','Date', 'Client', 'Amount','Tax','Total','Notes'],
        colModel:[
          {name:'id',index:'id', width:55},
          {name:'invdate',index:'invdate', width:90},
          {name:'name',index:'name asc, invdate', width:100},
          {name:'amount',index:'amount', width:80, align:"right"},
          {name:'tax',index:'tax', width:80, align:"right"},		
          {name:'total',index:'total', width:80,align:"right"},		
          {name:'note',index:'note', width:150, sortable:false}		
        ],
        rowNum:10,
        width:700,
        rowList:[10,20,30],
        pager: '#pjqgajax',
        sortname: 'invdate',
        viewrecords: true,
        sortorder: "desc",
        caption:"New API Example"
    });
    jQuery("#pjqgajax").jqGrid('navGrid','#pjqgajax',{edit:false,add:false,del:false});
  </script>
  
  


  <!-- Include header -->
  <?php
    include 'includes/footer.php'
  ?>
</body>
</html>