 <?php
$offset = isset($_GET['offset']) ? $_GET['offset'] : 0; 
$min_turnover = isset($_GET['min_turnover']) ? $_GET['min_turnover'] : 0; 
$max_turnover = isset($_GET['max_turnover']) ? $_GET['max_turnover'] : 0; 
$min_employees = isset($_GET['min_employees']) ? $_GET['min_employees'] : 0; 
$max_employees = isset($_GET['max_employees']) ? $_GET['max_employees'] : 0;
$min_growth = isset($_GET['min_growth']) ? $_GET['min_growth'] : 0; 
$max_growth = isset($_GET['max_growth']) ? $_GET['max_growth'] : 0;

// Show only if growrth is > 20%

//Turnover
if ($min_turnover != 0 && $max_turnover != 0){
	$turnover_query = "f.turnover > " . $min_turnover . " AND f.turnover < " . $max_turnover;
}
else {
	$turnover_query = "f.turnover > 1";
}

//Employees
if ($min_employees != 0 && $max_employees != 0){
	$employees_query = " AND c.employee_count > " . $min_employees . " AND c.employee_count < " . $max_employees;
}
else {
	$employees_query = " AND c.employee_count > 1";
}

//Growth
if ($min_growth != 0 && $max_growth != 0){
	$growth_query = " AND f.turnover_delta > " . $min_growth . " AND f.turnover_delta < " . $max_growth;
}
else {
	$growth_query = " AND f.turnover_delta > 20";
}

//Where clause
$where_query = "WHERE " . $turnover_query . $employees_query . $growth_query;

// Create connection
$con=mysqli_connect("localhost","companiesdbu","vaCtvw222KGNmnMB","scale-up-companies");
 
// Check connection
if (mysqli_connect_errno())
{
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}
 
// SQL statement

//Sin left join
$sql = "SELECT c.name, c.sic_2007, i.lat, i.lng, i.lep_code" . 
" FROM company c".
" INNER JOIN finances f" .
" ON f.company_no = c.company_no" .
" JOIN contact_info i" .
" ON i.company_no = c.company_no " . $where_query .
" ORDER BY c.name ASC";

 
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