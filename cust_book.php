<!-------- to populate the tower dropdown ------------------------------------------------------>
      <?php
	if ($_GET[fill] == "tower"){
	$servername = "localhost";
	$username = "root";
	$password = "College@2015";
	$dbname = "ESPDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT tw_id, name from tower where tw_id != ''";

	$result = $conn->query($sql);

	if ($result->num_rows > 0) {
 	echo "<option value=''>Select a Tower:</option>";
	while($row = $result->fetch_assoc()) {
	
		echo "<option value=". $row['tw_id'] . ">" . $row['name'] . "</option>";
	    }	

	} 
	
	$conn->close();
	}
	?>
<!--------------------------------------------End of populating tower dropdown ------------------------------------------------------------>

<!-------------------------------------------- to populate the billing plan dropdown ------------------------------------------------------>
      <?php
	if ($_GET[fill] == "plan"){
	$servername = "localhost";
	$username = "root";
	$password = "College@2015";
	$dbname = "ESPDB";

	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 

	$sql = "SELECT bill_plan, name from bill_plan where bill_plan != ''";

	$result = $conn->query($sql);
	
	if ($result->num_rows > 0) {
 	echo "<option value=''>Select a Billing Plan:</option>";
	while($row = $result->fetch_assoc()) {
	
		echo "<option value=". $row['bill_plan'] . ">" . $row['name'] . "</option>";
	    }	

	} 
	
	$conn->close();
	}
	?>
<!--------------------------------------------End of populating billing plan dropdown ---------------------------------------------------->

<!----------------------------------------------------- code for displaying the bill table ----------------------------------------------->
<?php
if ($_GET[plan] != ""){
//the chosen tower is stored in the below variable
$val = $_GET[plan]; 
$price = $_GET[price];
$servername = "localhost";
$username = "root";
$password = "College@2015";
$dbname = "ESPDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT bill_plan, name, no_years, roi from  bill_plan where bill_plan = '$val'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while($row = $result->fetch_assoc()) {
echo "
<div class='container'>
  <h2>$row[name]</h2>      
  <table class='table table-hover table-bordered'>
    <thead>
      <tr class='billplan' bgcolor = #E0F8F7>
        <th align = center>Installment No.</th>
	<th align = center>Payment Date</th>
        <th align = center>Amount to be paid(Base Amount + Interest)</th>
        <th align = center>Rate of Interest</th>
	<th align = center>Interest Amount</th>
      </tr>
    </thead>
    <tbody>";
    // output data of each row
    	
    unset($iprice); unset($interest); unset($totprc); unset($totint); unset($date);$i = 0; $j = 0;

	$date = date("m/d/y");
	for ($i = 1; $i <= $row["no_years"]; $i++) {
	 	
	if($row["roi"]<=0)
	{ 
	$iprice = $price / $row["no_years"];
	$interest = 0;
	
	}
	else
	{
	$iprice = (($price / $row["no_years"]) * (($row["roi"]+100) / 100));
	$interest = $iprice - ($price / $row["no_years"]) ;
	}
	
	$totprc = $totprc + $iprice;
	$totint = $totint + $interest;	
	$j = $i - 1;
	$date   = date('m-d-y', strtotime("+$j years"));
	
        echo "<tr><td align=center>".$i."</td>
	<td align=center>".$date.
	"</td><td align =right>$".$iprice.
	"</td><td align=center>".$row["roi"] .
	"</td><td align=right>$".$interest."</td></tr>";

    }
    }
    echo "<tr bgcolor='#FFFF00'><td align=center>Total</td>
	  <td> </td>
	  <td align=right>$".$totprc . "</td>
	  <td> </td>
	  <td align=right>$" .$totint. "</td></tr>";
    echo "</tbody>
  </table>
</div>";

} else {
    echo "No Result found";
}
$conn->close();
}
?>

<!---------------------------------------------End of code for displaying the bill table ---------------------------------------------------->

<!----------------------------------------------------- code for displaying the unit table -------------------------------------------->
<?php
if ($_GET[tower] != ""){
//the chosen tower is stored in the below variable
$tower = $_GET[tower]; 

$servername = "localhost";
$username = "root";
$password = "College@2015";
$dbname = "ESPDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

//$sql = "SELECT * from unit where tw_id = '$tower'";
$sql = "SELECT unit.ut_id, unit.type, unit.tw_id, unit.floor, unit.area, unit.status, tower.name as twname, type.name as tyname, type.price from unit LEFT JOIN tower on unit.tw_id = tower.tw_id LEFT JOIN type on unit.type=type.type_id where unit.tw_id = '$tower';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
echo "
<div class='container'>
  <h2>Units in Tower : $tower</h2>      
  <table class='table table-hover table-bordered'>
    <thead>
      <tr class='success'>
        <th>Condominium Number</th>
	<th>Type</th>
        <th>Tower</th>
        <th>Floor</th>
	<th>Area (in Sqft)</th>
	<th>Price (in USD)</th>
	<th>Status</th>
      </tr>
    </thead>
    <tbody>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
	
	if ($row["status"] == "available")
	{
	$color = "#00FF00";
	}
	elseif ($row["status"] == "sold")
	{
	$color = "#FF0000";
	}
		
        $price = $row["price"] * $row["area"];	
	$send = "?unit=" .$row["ut_id"] . "&tower=" . $row["twname"] . "&utype=" . $row["tyname"] . "&price=" . $price;
	
        echo "<tr><td><a href='cust_book1.php" .$send. "'>".$row["ut_id"]."</td>
	<td>".$row["tyname"].
	"</td><td>".$row["twname"].
	"</td><td align='center'>".$row["floor"].
	"</td><td align='right'>".$row["area"].
	"</td><td align='right'>$".$price.".00".
	"</td><td align='center' bgcolor = $color id='status'>".$row["status"]."</a></td></tr>";
    }
    echo "</tbody>
  </table>
</div>";

} else {
    echo "No Result found";
}
}
?>

<!---------------------------------------------End of code for displaying the unit table ---------------------------------------------->

