<?php

session_start();

//if the form has been submitted
if (isset($_POST['submitted'])){
	//create a database connection
	
		$db = new PDO("mysql:dbname=adaiboad_db;host=adaiboad.eas-cs2410-1617.aston.ac.uk", "adaiboad", "lift18kids");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	//get and sanitise the inputs, we don't need to do this with the password as we hash it anyway
	$safe_username = $db->quote($_POST['username']);
	$safe_firstname = $db->quote($_POST['firstname']);
	$safe_lastname = $db->quote($_POST['lastname']);
	$safe_email = $db->quote($_POST['email']);
	$safe_mobile = $db->quote($_POST['mobile']);
	$safe_gender = $db->quote($_POST['gender']);
	$hashed_password = md5($_POST['password']);
		
	//insert the entry into the database
	$query = ("INSERT INTO user VALUES ( $safe_username, '$hashed_password', $safe_firstname, $safe_lastname, $safe_gender, $safe_email, $safe_mobile, default );");

	$db->exec("$query");	
	/*OR
	you can do 
	$db->query("INSERT INTO user VALUES ( $safe_username, '$hashed_password', $safe_firstname,$safe_lastname, $safe_gender, $safe_email, $safe_mobile, default );")
	*/
	

	//get the ID
	$id = $db->lastInsertId();
	
	//Output success or the errors
	echo "Congratulations! You are now registered. Your ID is: $id";
}

//Form validation




?>

<html>
<style>
body { 
 background-color:#FFF5EE;

}

footer{ 
       position: fixed;     
       text-align: center;    
       bottom: 0px; 
       width: 100%;
   } 
 
</style>
<body>
<footer style="font-family:pmingliu-extb;">
<form action = "register.php" method = "post" style="
    position: relative;
    top: -100px;
">
 <h1 style="font-family:pmingliu-extb; font-size:300%;" > Register to the FiLo system </h1>
<p>User Name: <input type="text" name="username" size="15" maxlength="20" required /></p>
<p>Password: <input type="password" name="password" size="15" maxlength="50" required /></p>
<p>First name: <input type="text" name="firstname" size="15" maxlength="20" required /></p>
<p>Last name: <input type="text" name="lastname" size="15" maxlength="20" required /></p>
<fieldset style="
    border: none;
">
	<legend>Gender:</legend>
	<input type="radio" name="gender" value="female"> Female 
	<input type="radio" name="gender" value="male"> Male
	<input type="radio" name="gender" value="other"> Other
</fieldset>
<p>Email: <input type="email" name="email" size="15" maxlength="25" required /></p>
<p>Mobile: <input type="number" name="mobile" maxlength="11" required /></p>
<p><input type="submit" name="submit" value="Submit" /></p>
<input type="hidden" name="submitted" value="TRUE" />    
</form></br></br>
<a href = "index.php"> Go back </a></br></br>
<footer>
 &copy; 2017, Deborah Adai Boateng - 159037889 
</footer>
</body>
</html>
