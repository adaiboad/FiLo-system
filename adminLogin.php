<?php
	session_start();

	//if the form has been submitted
	if (isset($_POST['submitted'])){
	//get the information out of get or post depending on your form
		$username = $_POST['username'];
		$password = $_POST['password'];

	//connect to the database
	$db = new PDO("mysql:dbname=adaiboad_db;host=adaiboad.eas-cs2410-1617.aston.ac.uk", "adaiboad", "lift18kids");
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	
	//sanitise the inputs!
	$safe_username = $db->quote($username);
	
	//run a query to get the user associated with that username
	$query = "select * from user where User = $safe_username";
	
	$result = $db->query($query);
	
	$firstrow = $result->fetch(); //get the first row
	
		if (!empty($firstrow)) {
			//check the passwords, if correct add the session info and redirect
			$hashed_password = md5($password);
			
			if ($firstrow['Password'] == $hashed_password){
				$_SESSION['id'] = $firstrow['id'];
				$_SESSION['name'] = $firstrow['User'];
				if($firstrow['User'] == 'adaiboad'){
					header("Location: admin.php");
					exit();
				}
				//user is not alllowed to access the admin page
				echo "Users are not allowed to access the admin page";
				header("Location: index.php");
				exit();
			} else {
				echo "<h1>Error logging in, password does not match</h1>";
			}
		} else {
			//else display an  error
			echo "<h1>Error logging in, Username not found </h1>";
		}
	}
?>
<html>
<style>
body { 
 background-color:#FFF5EE;

}
h1 { text-align:center; }
h3 { text-align:center; }
p { text-align:center; }
footer{ 
       position: fixed;     
       text-align: center;    
       bottom: 0px; 
       width: 100%;
   } 
 
</style>
<body>
 <h1 style="font-family:pmingliu-extb; font-size:300%;" > Log in as an admin  </h1>

<form action="adminLogin.php" method="post">
	
	<p style="font-family:pmingliu-extb; font-size:100%;">Username: <input type="text" name="username" size="15" maxlength="20" /></p>
    <p style="font-family:pmingliu-extb; font-size:100%;">Password: <input type="password" name="password" size="15" maxlength="20" /></p>
    <p><input type="submit" name="submit" value="Submit" /></p>
    <input type="hidden" name="submitted" value="TRUE" />
  </form>
<a href = "index.php"> Go back </a></br></br>
<footer>
 &copy; 2017, Deborah Adai Boateng - 159037889 
</footer>
</body>
</html>