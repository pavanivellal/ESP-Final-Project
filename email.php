<!DOCTYPE html>
<html lang="en">
<head>
  <title>Password Recovery</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<?php
require ('/var/www/html/ESP/PHPMailer-master/PHPMailerAutoload.php');

if ($_POST[forgotpw])
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
$sql = "SELECT * from user001 where ur_id = '$_POST[ur_id]';";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
    email($row);
    }
} else {
    
    echo "<script type='text/javascript'>alert('User ID does not exist');window.location='signup.html';</script>";	
    die();
}

$conn->close();

}

function email($row) {
/**
 * email sending via Google's Gmail servers.
 */

//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

//Create a new PHPMailer instance
$mail = new PHPMailer;

//Tell PHPMailer to use SMTP
$mail->isSMTP();

//Enable SMTP debugging
// 0 = off (for production use)
// 1 = client messages
// 2 = client and server messages
$mail->SMTPDebug = 2;

//Ask for HTML-friendly debug output
$mail->Debugoutput = 'html';

//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';
// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6

//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;

//Set the encryption system to use - ssl (deprecated) or tls
$mail->SMTPSecure = 'tls';

//Whether to use SMTP authentication
$mail->SMTPAuth = true;

//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "teammarshmallow15@gmail.com";

//Password to use for SMTP authentication
$mail->Password = "SJSUfall15";

//Set who the message is to be sent from
$mail->setFrom('teammarshmallow15@gmail.com', 'TM Builders');

//Set an alternative reply-to address
$mail->addReplyTo('teammarshmallow15@gmail.com', 'TMBuilders');

//Set who the message is to be sent to
$mail->addAddress($row['ur_id'], $row['f_nm']);

//Set the subject line
$mail->Subject = 'PHPMailer GMail SMTP test';

//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents_email.html'), dirname(__FILE__));
$mail->msgHTML("<!DOCTYPE html>
<!DOCTYPE html>
<html>
<head>
<title>Your Password</title>
</head>
<body>

<p>Hello $row[f_nm] $row[l_nm],</p>

<p>Your user id : $row[ur_id]
<br>
Your Password : $row[password]
</p>

<p>Click on the link below to signin to your account.</p>
<a href='http://localhost/esp_proj/login.php?ur_id=$row[ur_id]'>Click here to signin</a>

<p>Thankyou for being our Customer. <br> We will continue to server you with the Best of Best.</p>

<p>Regards, <br> TM Builders </p>
</body>
</html> ");


//Replace the plain text body with one created manually
$mail->AltBody = 'Your Password';

//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
    $msg = "Mailer Error: " . $mail->ErrorInfo;
    $fpage = "Location:reg_fail?msg=" . $msg;
    header($fpage);
    exit();
} else {
    echo "<script type='text/javascript'>alert('Email Sent to Registered mail id');window.location='login.php';</script>";
    exit();
}
}
?>


<div class="container">    
        <div id="forgetpw" style="margin-top:50px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">                    
            <div class="panel panel-info" >
                    <div class="panel-heading">
                        <div class="panel-title"><b>Password Recovery</b></div>
                        
                    <div style="padding-top:30px" class="panel-body" >

                        <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                            
                        <form id="forgotpw" class="form-horizontal" role="form" action = "email.php" method = "POST">
                                    
                            <div style="margin-bottom: 25px" class="input-group">
                                        <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                        <input id="login-username" name = "ur_id" type="email" class="form-control" name="username" value="" placeholder="Enter your Registered email id" required>                                        
                                    </div>
                                
                                   

                            <div style="margin-bottom: 25px" class="input-group">
                            <button type="submit" id = "forgotpw" name = "forgotpw" value = "forgotpw" class="btn btn-primary" right >Recover Password</button>

                            </div>
		 
                            </form>     

</form>
</body>
</html>












