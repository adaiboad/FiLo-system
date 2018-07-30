<html>
<body>

<?php

session_start();

$db = new PDO("mysql:dbname=adaiboad_db;host=adaiboad.eas-cs2410-1617.aston.ac.uk", "adaiboad", "lift18kids");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//get user
  $user = $_GET['user'];
  $id = $_GET['id'];
  $accept="Accepted";
  $decline="Declined";

if(isset ($_GET['approve'])){

$query ="UPDATE request SET Status = '$accept' WHERE Item_Id = '$id' ";
$result = $db->query($query);
echo "You have successfully accepted $user's request.</br></br>";
}

if(isset ($_GET['decline'])){
$query ="UPDATE request SET Status = '$decline' WHERE Item_Id = '$id' ";
$result = $db->query($query);
echo "You have successfully declined $user's request.</br></br>";
}


?>

<a href = "admin.php"> Go back </a></br></br>

</body>
</html>