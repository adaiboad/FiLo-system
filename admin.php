<?php
	session_start();
	
	//check if the admin is logged in, otherwise redirect to start
	if (! isset($_SESSION['name'])){
		header("Location: adminLogin.php");
		$username = $_POST['username'];
		$password = $_POST['password'];
	}
	//if the form has been submitted
	//connect to the database
	$db = new PDO("mysql:dbname=adaiboad_db;host=adaiboad.eas-cs2410-1617.aston.ac.uk", "adaiboad", "lift18kids");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $query = "SELECT * FROM request";

	$result = $db->query($query);


	?>

<html>
<head>
<link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.13/css/jquery.dataTables.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
           <!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
 
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jquery.dataTables/1.9.4/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="//cdn.datatables.net/1.10.13/js/jquery.dataTables.js"></script>

<script type="text/javascript" src="http://tablesorter.com/addons/pager/jquery.tablesorter.pager.js"></script>       
<link rel="stylesheet" href="http://tablesorter.com/themes/blue/style.css" type="text/css" media="print, projection, screen">	 
	 </head>  
 
</head>
<body>
   
	<table id="item" class="display tablesorter"width="600" border="1" cellspacing="1" cellpadding="1">
	<thead>
	<tr>
	 <th class="header">Item ID</th>
	 <th class="header">Item</th>
	 <th class="header">Description</th>
	 <th class="header">User</th>
	 <th class="header">Status</th>

	 
	</tr>
	</thead>
	<?php
       foreach ($result as $result) {

    ?>
		
          <tr>
                            <td><a href = "itemConfirm.php?id=<?php echo $result['Item_Id'];?>"><?php echo $result['Item_Id'];?></td>
                            <td><?php echo $result['Item'] ;?></a></td>
                            <td><?php echo $result['Description'] ?></td>
							<td><?php echo $result['User'] ?></td>
							<td><?php echo $result['Status'] ?></td>
							

          </tr>
			
    <?php

}

?>
</table><br /> <br />

<h3><a href = "logout.php"> Logout </a><h3></br></br>

</body>
</html>

 <script>
    $(document).ready(function(){
    $('#item').DataTable();
	$("#item").tablesorter();
 $("#item").tablesorter( {sortList: [[0,0], [1,0]]} ); 	
   });
 </script>