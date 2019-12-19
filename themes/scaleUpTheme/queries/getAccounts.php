<?php
$id = isset($_GET['id']) ? $_GET['id'] : 0; 

// Create connection
$con=mysqli_connect("localhost","companiesdbu","vaCtvw222KGNmnMB","scale-up-companies");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
// SQL statement

//Sin left join
$sql = "SELECT company_no, turnover, employee_count, gross_profit, pre_tax_profit, assets_total, assets_net, exports, date  " .
" FROM accounts".
" WHERE company_no = " . $id .
" ORDER BY date DESC LIMIT 3";


//For joins we need an alias for the tables
mysqli_set_charset($con, "utf8" );
if ($result = mysqli_query($con, $sql))
{
	//Temporary array to hold the data
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