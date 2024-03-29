<?php
/**
 * Allows the GPSTracker Mobile App to obtain the current list of vehicles
 * on start. This way, there will always be an up-to-date vehicle list.
 */

include './config.php';
//Connect to database
$con = mysql_connect($hostname, $username, $password) or die (mysql_error());
//Select database
mysql_select_db($database) or die (mysql_error());

// array for json response
$response = array();
$response["vehicles"] = array();

// Mysql select query
$result = mysql_query("SELECT * FROM tracker_vehicle");

//Get list of vids
while($row = mysql_fetch_array($result)){
    $tmp = array();
    $tmp["id"] = $row["VehID"];   //vehicle id
    $tmp["name"] = $row["Title"]; //vehicle title
    // push category to final json array
    array_push($response["vehicles"], $tmp);
}

//set header encoding to json
header('Content-Type: application/json');

//print json array
echo json_encode($response);
//close connection
mysql_close($con);
?>
