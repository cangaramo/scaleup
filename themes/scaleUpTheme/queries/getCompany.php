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
$sql = "SELECT c.name, c.company_no, c.sic_2007, c.sic_2003, c.type, c.incorporation_date, " .
" i.trading_address_line_1 AS address1, i.trading_address_line_2 AS address2, " .
" i.trading_address_line_3 AS address3, i.trading_address_line_4 AS address4,  " .
" i.telephone, i.website, " .
" f.turnover, f.turnover_delta, f.net_assets, f.net_assets_delta, f.return_on_capital_employed, " .
" f.accounts_filing_type AS accounts, f.latest_returns, f.latest_accounts as annual_accounts " .
" FROM company c".
" INNER JOIN finances f" .
" ON f.company_no = c.company_no" .
" JOIN contact_info i" .
" ON i.company_no = c.company_no WHERE c.company_no = " . $id .
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