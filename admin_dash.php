<!DOCTYPE html>
<html lang="en">
<head>
  <title>Admin View</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</head>
<body>

<!--------------------------------------------------------------- PHP Code ------------------------------------------------------------------>
<?php

//-----------------------------------------------------Processing SQL Database queries--------------------------------------------------------
function database ($sql, $h_success, $h_fail)
{
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

if ($conn->query($sql) === TRUE) {
    
    echo $h_success;
		
} else {
   echo $h_fail. $conn->error;
   //echo "  <div class='alert alert-danger'><strong>Sorry!</strong>" . $h_fail . "</div></div>";
}

$conn->close();
}

//---------------------------------------------- Add User -------------------------------------------------------------------------------
function add_user($ur_id, $password, $f_nm, $m_nm, $l_nm, $ur_type)
{

$sql = "INSERT INTO user001 (ur_id, password, f_nm, m_nm, l_nm, ur_type, cr_dt, cr_by) values ('$ur_id', '$password', '$f_nm', '$m_nm', '$l_nm', '$ur_type', now(), current_user());";
$h_success = "User: " . $ur_id . " Added Successfully";
$h_success = "<script type='text/javascript'>alert('$h_success');</script>";
$h_fail = "User: " . $ur_id . " Not Added";

database($sql, $h_success, $h_fail);


}

switch ($_POST[add])
{
case "user"  : add_user($_POST[ur_id], $_POST[password], $_POST[f_nm], $_POST[m_nm], $_POST[l_nm], $_POST[ur_type]); break; //add unit
}
?>

<div class="container">
  <h2>Admin</h2>
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Add User</a></li>
<ul class="nav navbar-nav navbar-right">
        <li><a href="logout.php"><span class="glyphicon glyphicon-user"></span>Logout</a></li>
</ul>
  </ul>

<div class="tab-content">
<!tab 1>
    <div id="home" class="tab-pane fade in active">
    <h3>Add User</h3>
    <div class="container">
    	<form role="form" action = "admin_dash.php" method = "POST">
      		
		<div class="form-group">
        	<label>User ID:</label>
         	<input type="email" class="form-control" name="ur_id" placeholder="Enter User ID " required>
    	 	</div>
	        
		<div class="form-group">
	        <label for="tower">Password:</label>
	        <input type="text" class="form-control" name="password" placeholder="Enter Password " required>
	        </div>
	        
		<div class="form-group">
		<label for="f_nm">First Name:</label>
		<input type="text" class="form-control" name="f_nm" placeholder="Enter First Name " required>
	        </div>
	        
		<div class="form-group">
		<label for="m_nm">Middle Name:</label>
		<input type="text" class="form-control" name="m_nm" placeholder="Enter Middle Name ">
	        </div>

	        <div class="form-group">
		<label for="l_nm">Last Name:</label>
		<input type="text" class="form-control" name="l_nm" placeholder="Enter Last Name " required>
	        </div>

		<div class="form-group">
		<label for="ur_type">User Type</label>
		<input type="text" class="form-control" name="ur_type" placeholder="User Type " required>
	        </div>

      		<button type="submit" class="btn pull-right" name="add" value="user" >Add User</button>

      </form>
    </div>
    </div>
    </div>
    </div>


</body>
</html>
