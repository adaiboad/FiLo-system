<html>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
 <body>
    <h1>Lost item</h1>


<?php
session_start();

  $id = $_GET['id'];
//connect to the database
	$db = new PDO("mysql:dbname=adaiboad_db;host=adaiboad.eas-cs2410-1617.aston.ac.uk", "adaiboad", "lift18kids");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
$query = "SELECT * FROM item WHERE ID = '$id' ";
$result = $db->query($query);



?>
<?php
    print "<ul>\n";
       foreach ($result as $result) {

    ?>
		
          <tr> 
		                    <td><h3><?php echo $result['ID'] ?></td>
							<td><?php echo $result['Found_item'] ?></h3></td></br>
		                    <td><img src="<?php  echo $result[ 'Photo' ];?>" height=180 width=180 /></td></br>
							<td><?php echo $result['Found_user'] ?></td></br>
                            <td><?php echo $result['Category'] ?></td></br>
                            <td><?php echo $result['Found_place'] ?></td></br>
                            <td><?php echo $result['Date'] ?></td></br>
							<td><?php echo $result['Colour'] ?></td></br>					       
							<td><?php echo $result['Description'] ?></td></br></br>
							

          </tr>
			
    <?php

}

?></br>
<!--The admin's approve or rejection buttons will send an automatic email to the user -->

<form action = "admin.php" method = "post">
<input type="button" name="approve" value="Approve request " onclick="window.location.href='confirm.php?id=<?php echo $result['ID']?>&approve=<?php echo $result['ID']?>&user=<?php echo $result['Found_user'] ?>'" /> 
    <input type="button" name="decline" value="Decline request" onclick="window.location.href='confirm.php?id=<?php echo $result['ID']?>&decline=<?php echo $result['ID']?>&user=<?php echo $result['Found_user'] ?>'" /> 

<a href = "admin.php"> Go back </a></br></br>

<footer>
 &copy; 2017, Deborah Adai Boateng - 159037889 
</footer>
</body>
</html>

