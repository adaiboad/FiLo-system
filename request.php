<?php

session_start();

//get user
if (isset($_GET['User'])) {
    $username = $_GET['User'];
}
//if the form has been submitted, create a database connection
if (isset($_POST['submitted'])) {
    $db = new PDO("mysql:dbname=adaiboad_db;host=adaiboad.eas-cs2410-1617.aston.ac.uk", "adaiboad", "lift18kids");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //get and sanitise the inputs, we don't need to do this with the password as we hash it anyway
    $safe_itemID = $db->quote($_POST['Item_Id']);
	$safe_item = $db->quote($_POST['Item']);
    $safe_description = $db->quote($_POST['Description']);
    $safe_username = $db->quote($_POST['User']);
	$safe_status = $db->quote($_POST['Status']);

    $username = $_POST['User'];
    //insert the entry into the database
    $query = ("INSERT INTO request VALUES ($safe_itemID, $safe_item, $safe_description, $safe_username,  $safe_status ) ");
    $db->query($query);

    //Output success or the errors
    echo "Your request has been successfully forwarded to our administrator.";
}

//Form validation




?>


<html>
 <body>
    <h1>Request item</h1>
	 <p>Make a request to retrieve an item.</p>
	<form action = "request.php" method = "post">
	  <p>Enter the items ID : <input type="number" name="Item_Id" size="15" maxlength="10"<p>
      <p>Item name : <input type="text" name="Item" size="15" maxlength="20" /></p>
      <p>Your reason : </br>
	  <textarea name="Description"rows="4" cols="50"> "Describe your item here..." </textarea> </p>
	  <p><input type="submit" name="submit" value="Submit" /></p>
       <input type="hidden" name="submitted" value="TRUE" />
        <input type="hidden" name="User" value="<?php echo $username?>" />
		<input type="hidden" name="Status"  />
    </form>
	<a href = "loggedin.php"> Go back </a></br></br>
	<footer>
 &copy; 2017, Deborah Adai Boateng - 159037889 
</footer>
 </body>
</html>