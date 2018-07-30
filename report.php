<?php

session_start();
//get user
if (isset($_GET['Found_user'])) {
    $username = $_GET['Found_user'];
} 
//if the form has been submitted, create a database connection
if (isset($_POST['submitted'])){

	$db = new PDO("mysql:dbname=adaiboad_db;host=adaiboad.eas-cs2410-1617.aston.ac.uk", "adaiboad", "lift18kids");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//get and sanitise the inputs
	$safe_item = $db->quote($_POST['Found_item']);
	$safe_category = $db->quote($_POST['Category']);
	$safe_place = $db->quote($_POST['Found_place']);
	$safe_date = $db->quote($_POST['Date']);
	$safe_user = $db->quote($_POST['Found_user']);
	$safe_colour = $db->quote($_POST['Colour']);
	$safe_photo = $db->quote($_POST['Photo']);
	$safe_detail = $db->quote($_POST['Description']);

	

	$username = $_POST['Found_user'];	
	//insert the entry into the database
	$query = ("INSERT INTO item VALUES ( default, $safe_item, $safe_category, $safe_place, $safe_date, $safe_user, $safe_colour, $safe_photo, $safe_detail);");

	$db->exec("$query");	
	
	

	//get the ID
	$ID = $db->lastInsertId();
	
	//Output success or the errors
	echo "You have successfully reported a found item, item number $ID";
}

//Form validation

?>

<html>
<body>
<h1>Report found item</h1>
<p>Please fill in the information of the item that you have found.</p>
<form action = "report.php" method = "post">

<p>Found item : <input type="text" name="Found item" size="15" maxlength="25" required /></p>
	<p>Category: </p>
	<input type="radio" name="Category" value="pet"> Pet<br>
	<input type="radio" name="Category" value="jewellery"> Jewellery<br>
	<input type="radio" name="Category" value="electronic"> Electronic
<p>Where did you find this item? : <input type="text" name="Found place" size="15" maxlength="25" /></p>
<p>Date : <input type="date" name="Date" value="2017-01-01" size="15" maxlength="20" required /></p>
<p>What colour is the item: <input type="text" name="Colour" size="15" maxlength="25" required /></p>
<p>Please upload an image of the item: <input type="file" name="Photo" accept="image/*"/></p>
<p>Please give a brief description of the item: <input type="text" name="Description" size="15" maxlength="50" required /></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="submitted" value="TRUE" />   
 
<input type="hidden" name="Found_user" value="<?php echo $username?>" />   
</form>




<a href = "loggedin.php"> Go back </a></br></br>
<footer>
 &copy; 2017, Deborah Adai Boateng - 159037889 
</footer>
</body>
</html>
        