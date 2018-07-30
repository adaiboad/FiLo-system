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
				
				//echo "Success!";
				header("Location: loggedin.php");
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
<head>
<link href="https://fonts.googleapis.com/css?family=Merriweather|Poiret+One" rel="stylesheet">
</head>
<style>
body { 
 background-color:#fff5f2;
 margin:auto;

}

h1 { text-align:center; }
h3 { text-align:center; color:#2f2b2b; }
p { text-align:center; color:#2f2b2b; font-family: 'Merriweather', serif; }
footer{ 
       position: fixed;     
       text-align: center;    
       bottom: 0px; 
       width: 100%;
    font-size: small;	   
   } 
   
.ad_login{
    border: 15px solid rgba(255, 255, 255, 0);
    border-radius: 50em;
    font-size: 16;
    color: white;
    background: #d07c7d;
}

.login{
	    height: 50px;
    width: 200px;
    margin: auto;
    display: block;
    border: 2px solid #d07c7d;
    border-radius: 50em;
    font-family: 'Merriweather', serif;	
    font-size: 16;
    font-weight: bold;
    color: white;
    background: #d07c7d;
	box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
    position: relative;
    top: 180px;	
}

.title{
	position: relative;
    top: -75;
    color: white;
}
   
header[role=banner] {
    height: 50px;
	    position: relative;
    background: #66697c;
}

.register{
    border: 2px solid #d07c7d;
    background: #d07c7d;
    padding: 13;
    border-radius: 50em;
    font-size: 15px;
    position: relative;
    font-family: 'Merriweather', serif;	
    top: 60px;
    color: #fff;
    text-decoration: none;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);	
}

.submit{
    border: 2px solid #d07c7d;
    border-radius: 50em;
    font-size: 14px;
    font-weight: bold;
    font-family: 'Merriweather', serif;
    color: #2f2b2b;
    background: transparent;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);
}

.username, 
.password{
    border: 1px solid #b3b3b3;
    border-radius: 2px;
    background: white;
    color: transparent;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.2);
    padding: 5px;
    padding-left: 70px;
    padding-right: 70px;	
}

</style>
<body>

<header role="banner">
<input class = "ad_login" type="button" value="Admin login" onclick="window.location.href='adminLogin.php'" />


 <h1 class = "title" style="font-family:'Merriweather', serif; font-size:250%;font-weight: normal;" > FiLo : Lost and Found </h1>
</header>
<p style="    font-family: 'Merriweather', serif;, cursive; font-size:150%; font-weight: bold; position: relative; top: 20px;"> <?php
 print "Welcome to the FiLo system<br /><br /><br /> Sign in";
 ?> </p><br />
 
 

<input class = "login" type="button" value="Sign in as a guest" onclick="window.location.href='loggedin2.php'" /> <br /> <br />

<form action="index.php" style="
    position: relative;
    top: -70;
" method="post">
	
	<p>UserName:&nbsp;&nbsp; <input class = "username" type="submit" name="username" size="15" maxlength="20" /></p>
    <p>Password:&nbsp; &nbsp; <input class = "password" type="submit" name="password" size="15" maxlength="20" /></p>
    <p><input class = "submit" type="submit" name="submit" value="Submit" /></p>
    <input type="hidden" name="submitted" value="TRUE" />
  </form>
 
 <h3> <a  class = "register" href = "register.php">Register </a></h3> <br /> <br /><br /> <br /><br /> <br /><br /> <br /><br /> <br />
 
 
<footer style="font-family:'Merriweather', serif;"> 
<footer class = "footer">
 &copy; 2017, Deborah Adai Boateng - 159037889 
</footer>
</body>
</html>
