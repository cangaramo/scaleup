<?php
  
  //Change port from 
// Create connection 8889 to 3306
$con=mysqli_connect("127.0.0.1:3306","companiesdbu","vaCtvw222KGNmnMB","scale-up-companies");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
// SQL statement
$sql = "SELECT company_no, name, incorporation_date, type, sic_2003, sic_2007, employee_count, status, sic_2003_description, sic_2007_description, updated_date FROM company LIMIT 100"; 
 
if ($result = mysqli_query($con, $sql))
{
	// If so, then create a results array and a temporary one
	// to hold the data
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
	//echo json_encode($resultArray);
	$json = json_encode($resultArray);
	$decode = html_entity_decode ($json);
//	$decode = utf8_encode ($decode);
	echo $decode;

}


// Close connections
mysqli_close($con);
?>