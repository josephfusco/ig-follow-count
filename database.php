<?php

require_once( 'startup.php' );

try {
  $db = new PDO("mysql:host=host-10;
                       dbname=9recent;
                       port=3306", //specify DB port if need be
                       "root", //db username
                       DB_PASSWORD); //DB password
  //var_dump($db); //Dump the database info
  $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); //Shows errors if the PDO object returns errors such as cannot execute query
                                                               //in PHP the 2 colons "::" represent a relationship between the class name on the left and the property or method on the right
  //$db->exec("SET NAMES 'utf8'"); //set standard character set

} catch (Exception $e) {
  echo "Could not connect to DB"; //Display message if you cant connect
  exit; //end connection
}

try{
  $results = $db->query("SELECT * FROM 9recent");
} catch (Exception $e){
  echo "Data could not be retreived from database";
  exit;
}

  echo "<pre>";
  var_dump($results->fetchAll(PDO::FETCH_ASSOC));

 ?>
 <?php
/*
try{


$servername = "host-10";
$username = "root";
$password = DB_PASSWORD;
$dbname = "9recent";
// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
$conn->setAttribute(mysqli::ATTR_ERRMODE,mysqli::ERRMODE_EXCEPTION);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$sql = "SELECT * FROM 9recent";
//$result = $conn->query($sql);
$result = mysql_query($sql);
while ($rows = mysql_fetch_array($result)):
    $user_id = $rows['user_id'];
    $username = $rows['username'];
    $total_comments = $rows['total_comments'];
    $total_likes = $rows['total_likes'];
    $avg_likes = $rows['avg_likes'];
    $engagement_ratio = $rows['engagement_ratio'];
    $picture = $rows['picture'];
    $time_stamp = $rows['time_stamp'];
    $num_followers = $rows['num_followers'];

echo "Username: {$row['username']}";
endwhile;
} catch (Exception $e){
  echo "Didnt work";
  exit;
}


if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "id: " . $row["user_id"]. " - Name: " . $row["username"]. " " . $row["total_comments"]. "<br>";
    }
} else {
    echo "0 results";
}

$conn->close();

?>
