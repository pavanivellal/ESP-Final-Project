<? include "login.php"; ?>

<!DOCTYPE html>

<html lang="en">
<head>
  <title>Customer View</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<br><br><br>
</head>
<style>
body  {
    background-image: url("http://www.smh.com.au/advertisers/brand-discover/officeworks/IT/img/Officeworks-image-4.jpg");
    background-color: #cccccc;
}
.jumbotron { 
    background-color: #000000 ; /* Orange */
    color: #ffffff;
    padding: 10px 15px;
    
}

 .navbar {
    margin-bottom: 0;
    background-color: #f4511e;
    z-index: 9999;
    border: 0;
    font-size: 12px !important;
    line-height: 1.42857143 !important;
    letter-spacing: 4px;
    border-radius: 0;
}

.navbar li a, .navbar .navbar-brand {
    color: #fff !important;
}

.navbar-nav li a:hover, .navbar-nav li.active a {
    color: #f4511e !important;
    background-color: #fff !important;
}
.bg-grey {
      background-color: #f6f6f6;
  }
.navbar-default .navbar-toggle {
    border-color: transparent;
    color: #fff !important;
}

</style>

<body>

<!--------------------------------------------------------------- PHP Code ------------------------------------------------------------------>
<?php

//-----------------------------------------------------Processing SQL Database queries--------------------------------------------------------
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

$sql = "SELECT cust_id FROM customer WHERE email = " . "'". $_GET[ur_id] . "'";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

	
while($row = $result->fetch_assoc()) {

$cust_id = $row[cust_id];
}
}

$sql = "Select * from sales_order where cust_id = '$cust_id'";

$result = $conn->query($sql);
if ($result->num_rows > 0) {

	
while($row = $result->fetch_assoc()) {

$cust_id = $row[cust_id];
$so_no = $row[so_no];
$ut_id = $row[ut_id];
$tw_id = $row[tw_id];
$type_id = $row[type_id];
$ut_price = $row[ut_price];
$bill_plan = $row[bill_plan];
$cr_dt = $row[cr_dt];
$ch_dt = $row[ch_dt];

}
}


unset($sql); unset($result); unset($row);
$sql = "select * from customer where cust_id = $cust_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {

	
while($row = $result->fetch_assoc()) {

$f_nm = $row[f_nm];
$m_nm = $row[m_nm];
$l_nm = $row[l_nm];
$email = $row[email];
$dob = $row[dob];
$phone = $row[phone];
$street = $row[street];
$adr_l2 = $row[adr_l2];
$city = $row[city];
$state = $row[state];
$zipcode = $row[zipcode];
$country = $row[country];

}
}

unset($sql); unset($result); unset($row);
$sql = "select * from type where type_id = $type_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

	
while($row = $result->fetch_assoc()) {

$type_name = $row[name];
}
}

unset($sql); unset($result); unset($row);
$sql = "select * from tower where tw_id = $tw_id";
$result = $conn->query($sql);
if ($result->num_rows > 0) {

	
while($row = $result->fetch_assoc()) {

$tower_name = $row[name];
}
}
/*
 else {
   $h_fail = "Error: ". $conn->error;
   echo "<div class='alert alert-danger'><strong>Sorry!</strong>" . $h_fail . "</div>";
   echo "<script type='text/javascript'>alert('$h_fail');</script>";
}
*/
$conn->close();


?>

<!navbar>
<body id="myPage" data-spy="scroll" data-target=".navbar" data-offset="60">

		<nav class="navbar navbar-default navbar-fixed-top">
 			 <div class="container">
   			 <div class="navbar-header">
     		 <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
       			<span class="icon-bar"></span>
       		 	<span class="icon-bar"></span>
        	 	<span class="icon-bar"></span>                        
     		 </button>
     
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#about">ABOUT</a></li>
    
        <li><a href="#contactus">CONTACT</a></li>
	<?php echo "<li><a href=cust_book.html?cust_id=$cust_id>PROJECT</a></li>" ?>

      </ul>
    </div>
  </div>

</div></nav>

<br><br><br>

<div class="container bg-grey">
  <h2>Customer View : <?php echo $f_nm . ' ' . $l_nm?></h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Sales Order</a></li>
    <li><a data-toggle="tab" href="#menu1">Profile</a></li>
    <li><a data-toggle="tab" href="#menu3">Payment</a></li>
    <li><a data-toggle="tab" href="#menu4">Construction Progress</a></li>
<ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
</ul>
   
  </ul>

  <div class="tab-content">
<!tab 1>
    <div id="home" class="tab-pane fade in active">
    <h3>Sales Order Details</h3>
    <div class="container">
    <form role="form" action = "sales_dash.php" method = "POST">

      <div class="form-group">
        <label>Sales Order Number :</label>
         <div id="so_no" class="well well-sm"><?php echo $so_no ?></div>
      </div>

      <div class="form-group">
        <label>Unit Number : </label>
         <div id="ut_id" class="well well-sm"><?php echo $ut_id ?></div>
      </div>

      
      <div class="form-group">
        <label>Tower Name : </label>
         <div id="tw_id" class="well well-sm"><?php echo $tw_id ?></div>
      </div>

      <div class="form-group">
        <label>Type : </label>
         <div id="type_id" class="well well-sm"><?php echo $type_id ?></div>
      </div>    

      <div class="form-group">
        <label>Unit Price : </label>
         <div id="ut_price" class="well well-sm"><?php echo $ut_price ?></div>
      </div>

      <div class="form-group">
        <label>Bill Plan Chosen : </label>
         <div id="bill_plan" class="well well-sm"><?php echo "$bill_plan" ?></div>
      </div>

      <div class="form-group">
        <label>Created On : </label>
         <div id="cr_dt" class="well well-sm"><?php echo $cr_dt ?></div>
      </div>

      <div class="form-group">
        <label>Last Changed On : </label>
         <div id="ch_dt" class="well well-sm"><?php echo $ch_dt ?></div>
      </div> 

      </form>
    </div>
    </div>

<!tab2>

    <div id="menu1" class="tab-pane fade">
    <h3>User Profile</h3>
    <div class="container">
    <form role="form" action = "sales_dash.php" method = "POST">

      <div class="form-group">
        <label>Customer Name : </label>
         <div id="cust_id" class="well well-sm"><?php echo $f_nm . ' ' . $m_nm . ' ' . $l_nm ?></div>
      </div>

      <div class="form-group">
        <label>Date of Birth : </label>
         <div id="cust_id" class="well well-sm"><?php echo $dob ?></div>
      </div>

      <div class="form-group">
        <label>Phone : </label>
         <div id="cust_id" class="well well-sm"><?php echo $phone ?></div>
      </div>

      <div class="form-group">
        <label>Street : </label>
         <div id="cust_id" class="well well-sm"><?php echo $street ?></div>
      </div>

      <div class="form-group">
        <label>City : </label>
         <div id="cust_id" class="well well-sm"><?php echo $city ?></div>
      </div>

      <div class="form-group">
        <label>State : </label>
         <div id="cust_id" class="well well-sm"><?php echo $state ?></div>
      </div>

      <div class="form-group">
        <label>Country : </label>
         <div id="cust_id" class="well well-sm"><?php echo $country ?></div>
      </div>

      </form>
    </div>
    </div>

<div id="menu3" class="tab-pane fade">
      <h3>Billing Plan Chosen</h3>
    <div class="container">
    <form role="form" action = "sales_dash.php" method = "POST">
<!---End of Add Billing Plan -->
<!----------------------------------------------------- code for displaying the bill table ----------------------------------------------->
<?php
if ($bill_plan != ""){
//the chosen tower is stored in the below variable
$val = $bill_plan; 
$price = $ut_price;
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
	<th align = center>Payment Status</th>
      </tr>
    </thead>
    <tbody>";
    // output data of each row
    	
    unset($iprice); unset($interest); unset($totprc); unset($totint); unset($date);$i = 0; $j = 0;

	$date = $cr_dt;//date("m/d/y");
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
	"</td><td align=right>$".$interest."</td>
	<td align=center";
	
	if ($i<3){
	echo " bgcolor = #00FF00>Paid ";
	}
	else
	{
	echo " bgcolor = #FF0000> Due ";
	}

	echo "</td></tr>";
	


	

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
</div>
</div>
<!---------------------------------------------End of code for displaying the bill table ---------------------------------------------------->

<!---Add Billing Plan -->


<!tab3>

    <div id="menu4" class="tab-pane fade">
    <h3>Construction Progress</h3>
    <div class="container">
    <div class="progress-bar" role="progressbar" aria-valuenow="70"
  aria-valuemin="0" aria-valuemax="100" style="width:70%">
    70%
  </div>
    </div>
    </div>
<!---Add Billing Plan -->



 </div>
  </div>

</div>

</body>
</html>
