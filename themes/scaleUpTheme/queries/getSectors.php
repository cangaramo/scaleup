<?php
$parametro = isset($_GET['parametro']) ? $_GET['parametro'] : 0; 

// Create connection
$con=mysqli_connect("localhost","companiesdbu","vaCtvw222KGNmnMB","scale-up-companies");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
// SQL statement
$sql = "SELECT *" . 
" FROM sic_codes c";
 
//For joins we need an alias for the tables

if ($result = mysqli_query($con, $sql))
{
	$resultArray = array();
	$tempArray = array();
 
	// Loop through each row in the result set
	while($row = $result->fetch_object())
	{
		// Add each row into our results array
		$tempArray = $row;
	    array_push($resultArray, $tempArray);
	}
 
	// Finally, encode the array to JSON and output the results
	$json = json_encode($resultArray);
	$decode = html_entity_decode ($json);
	echo $decode;

}


// Close connections
mysqli_close($con);
?>