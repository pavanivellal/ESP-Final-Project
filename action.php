<?php
include 'database_conn.php';
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
    echo "User Successfully Registered";
	header($h_success);
		
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    $msg = "<br>Error: " . "<br>" . $conn->error;
    $h_fail = $h_fail . "?msg=" . $msg;
    header($h_fail);
    exit();
}
$conn->close();
}


//-------------------------------------------------------------Register Customer -------------------------------------------------------
function register($firstname, $middlename, $lastname, $email, $dob, $phone=NULL, $addrl1, $addrl2, $city, $state, $country, $zipcode){

$sql = "INSERT INTO customer (f_nm, m_nm, l_nm, email, dob, phone, street, adr_l2, city, state, country, zipcode, cr_dt)
VALUES ('$firstname', '$middlename', '$lastname', '$email', '$dob', '$phone', '$addrl1', '$addrl2', '$city', '$state', '$country', '$zipcode', now());";

$h_success = "Location:reg_success.html";
$h_fail = "Location:reg_fail.php";

database($sql,$h_success, $h_fail);

}

//------------------------------------------------------------ Create Customer id ----------------------------------------------------------
function create_user($email, $passwd, $repasswd, $firstname, $middlename, $lastname)
{
if (strcmp($passwd, $repasswd) !== 0) {
    die("Password and Re-Enter Password is not equal");
}

$sql = "INSERT INTO user001 (ur_id, password, f_nm, m_nm, l_nm, cr_dt, cr_by)
VALUES ('$email', '$passwd', '$firstname', '$middlename', '$lastname', now(), current_user());";

$h_success = "Location:reg_success.html";
$h_fail = "Location:reg_fail.php";

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
    echo "User Successfully Registered";
register($_POST[firstname], $_POST[middlename], $_POST[lastname], $_POST[email], $_POST[dob], $_POST[phone], $_POST[addr1], $_POST[addr2], $_POST[city], $_POST[state], $_POST[country], $_POST[postalCode]);
		
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    $msg = "Error: " . "<br>" . $conn->error;
    $h_fail = $h_fail . "?msg=" . $msg;
    header($h_fail);
    exit();
}

$conn->close();

}

//---------------------------------------------------------------Function Calls--------------------------------------------------------------

if ($_POST[register])
{

create_user($_POST[email], $_POST[pass1], $_POST[pass2],$_POST[firstname], $_POST[middlename], $_POST[lastname]);


//register($_POST[firstname], $_POST[middlename], $_POST[lastname], $_POST[email], $_POST[dob], $_POST[phone], $_POST[addr1], $_POST[addr2], $_POST[city], $_POST[state], $_POST[country], $_POST[postalCode]);
}

//-------------------------------------------------------- End of Function Calls ------------------------------------------------------------
?>


