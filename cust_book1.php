<!DOCTYPE html>
<html lang="en">
<head>
  <title>Booking</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
  <body id="bookingPage" data-spy="scroll" data-target=".navbar" data-offset="60">
  <div class="container">  

<!-- Display Bill Plan Table-->
<script>

function showDist(str) {
  var xhttp;    
  if (str == "") {
    document.getElementById("dispplan").innerHTML = "";
    return;
  }
  xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      document.getElementById("dispplan").innerHTML = xhttp.responseText;
    }
  };
  
  xhttp.open("GET", "cust_book.php?plan="+str+"&price="+price, true);
  xhttp.send();
}
 
</script>
<!-- End of Displaying the Bill Plan Table -->

                 
<br><br>     
       
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            <div class="panel-title"><b>Booking</b></div>
                        </div>  
                        <div class="panel-body" >
                            <form id="bookingform" class="form-horizontal" role="form" action="customer_dash.php?ur_id=35" method="post" >
                                
                                <div id="signinalert" style="display:none" class="alert alert-danger">
                                    <p>Error:</p>
                                    <span></span>
                                </div>
                                                          
                                       
                                <div class="form-group">
                                    <label for="unit_id" class="col-md-3 control-label">Unit Number:</label>
                                    <div class="col-md-9">
                                        <div class="well well-sm"> <?php echo htmlspecialchars($_GET["unit"]);?></div>
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label for="type" class="col-md-3 control-label">Type</label>
                                    <div class="col-md-9">
                                        <div class="well well-sm"><?php echo htmlspecialchars($_GET["utype"]);?></div>
                                    </div>
                                </div>


                               <div class="form-group">
                                    <label for="tower" class="col-md-3 control-label">Tower</label>
                                    <div class="col-md-9">
                                        <div class="well well-sm"><?php echo htmlspecialchars($_GET["tower"]);?></div>
                                    </div>
                                </div>

                               <div class="form-group">
                                    <label for="type" class="col-md-3 control-label">Price(in USD)</label>
                                    <div class="col-md-9">
                                        <div  class="well well-sm"><?php echo htmlspecialchars($_GET["price"]); 
					echo "<script>var price =".  htmlspecialchars($_GET['price']). "</script>"?></div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="bill_plan" class="col-md-3 control-label">Choose Billing Plan</label>
                                    <div class="col-md-9">
                                     <select class="form-control" name="plan" id="plan" onchange="showDist(this.value)">
					<script>
					  xhttp = new XMLHttpRequest();
					  xhttp.onreadystatechange = function() {
					    if (xhttp.readyState == 4 && xhttp.status == 200) {
					    document.getElementById("plan").innerHTML = xhttp.responseText;
					    }
					  };
 					  xhttp.open("GET", "cust_book.php?fill=plan", true);
					  xhttp.send();
					</script>
					</select>
                                    </div>
                                </div>


				<div class="form-group">
				  <label for="comment" class="col-md-3 control-label">Comments</label>
				  <div class="col-md-9">
				  <textarea class="form-control" rows="5" id="comment"></textarea>
				  </div>
				</div>
                                      				 
                                <button class="btn pull-right" onclick="book()">Book</button>

<script>
function book() {
 var xhttp = new XMLHttpRequest();
  xhttp.onreadystatechange = function() {
    if (xhttp.readyState == 4 && xhttp.status == 200) {
      $stat = xhttp.responseText;
      alert($stat);
    }
  };
  xhttp.open("GET", "cust_book2.php", true);
  xhttp.send();
}
</script>

		

                                </div>
                            </form>


                         </div>
		    <div id = "dispplan">Your Payment Plan Appears Here</div>

                    </div>

<?php $conn->close();?>
  </HEAD>
  </body>
  </HTML>





