<?php

session_start();
// ** NOTE: Below code checks if the passenger is logged in or not. If he/she isn't logged in,
// it redirects the passenger to passenger_login.php

if (!isset($_SESSION["passenger_id"])) 
{
    session_unset();
    session_write_close();
    $url = "../passenger_login_signup/passenger_login.php";
    header("Location: $url");
} 

// ** NOTE: Main page for the passenger dashboard, it displays the no. of airlines available,
// amount spend on bookings, top destinations etc. along with side navigation bar.


$passenger_id=$_SESSION['passenger_id'];
$mysqli = new mysqli("localhost","root","","airline_system");
$sql = "SELECT * FROM airline_system.flights
        WHERE flight_no
        IN (SELECT flight_no FROM airline_system.booked_flights WHERE passenger_id='$passenger_id')";
$money=0;  
$count=0;
$result = $mysqli->query($sql);      
while($rows=$result->fetch_assoc())
{
  $money=$money+$rows['amount'];
  $count=$count+1;
}            
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://maxst.icons8.com/vue-static/landings/line-awesome/line-awesome/1.3.0/css/line-awesome.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>

    <input type="checkbox" id="nav-toggle"> 
    <div class="sidebar">
        <div class="sidebar-brand">
           <h2>
               <center>
                   <br/>
                <span>Airline Management</span>
                </center>
           </h2>
        </div>
        <div class="sidebar-menu">
            <ul>
                <li>
                    <a href="" class="active"><span class="las la-home"></span>
                    <span>Dashboard</span></a>
                </li>
<br>
                <li>
                    <a href="flights.php"><span class="las la-plane"></span>
                    <span>Airlines Available</span></a>
                </li>
                <br/>
                <li>
                    <a href="booking.php"><span class="las la-clipboard-list"></span>
                    <span>View Bookings</span></a>
                </li>
                <br/>
                <li>
                    <a href="ticket.php"><span class="las la-ticket-alt"></span>
                    <span>Book Ticket</span></a>
                </li>
                <br/>
                <li>
                    <a href="print_ticket.php" ><span class="las la-clipboard-list"></span>
                    <span>Print Ticket</span></a>
                </li>
                <br/>
                <li>
                    <a href="status.php"><span class="las la-signal"></span>
                    <span>Flight Status</span></a>
                </li>
                <br/>
                <li>
                    <a href="profile.php"><span class="las la-user-circle"></span>
                    <span>Profile</span></a>
                </li>
                <br/>
                <li>
                    <a href="../passenger_login_signup/passenger_logout.php"><span class="las la-sign-out-alt"></span>
                    <span>Sign Out</span></a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-content">
        <header>
           <h2>
             <label for="nav-toggle">
                 <span class="las la-bars"></span>
             </label>
             Dashboard
            </h2>
           
        </header>
    <main>
        <div class="cards">
            <div class="card-single">
                <div>
                    <h3>8</h3>
                    <span>Airlines Available</span>
                </div>
                <div>
                    <span class="las la-plane"></span>
                </div>
            </div>
            
            <div class="card-single">
                    <div>
                        <h3><?php echo $count ?></h3>
                        <span>Bookings</span>
                    </div>
                    <div>
                        <span class="las la-clipboard-list"></span>
                    </div>
            </div>
            <div class="card-single">
                    <div>
                        <h3><?php echo $money ?></h3>
                        <span>Money Spent</span>
                    </div>
                    <div>
                        <span class="las la-rupee-sign"></span>
                    </div>
            </div>
            <div class="card-single">
                <div>
                    <h3>10%</h3>
                    <span>Minimum Discount</span>
                </div>
                <div>
                    <span class="las la-wallet"></span>
                </div>
            </div>
        </div>
    </main>
    </div>   
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>


    <div class="main-content"> 
      <div class="bar">
        <span><h3>Top Destinations(in India)</h3></span>       
      </div>
            <div class="cards">
             <div class="card-single">
                <div>
                    <img src="img/leh.jpg" style="width:100%">
                    <div>
                    <center>Jammu & Kashmir</center>
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/Punjab.jpg" style="width:100%">
                    <div>
                    <center>Punjab</center>
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/kerala.jfif" style="width:100%">
                    <div>
                    <center>Kerala</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/Rajasthan.jfif" style="width:100%">
                    <div>
                    <center>Rajasthan</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/assam.jpg" style="width:100%">
                    <div>
                    <center>Assam</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/Delhi.jfif" style="width:100%">
                    <div>
                    <center>Delhi</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/karnataka.jfif" style="width:100%">
                    <div>
                    <center>Karnataka</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/Tn.jfif" style="width:100%">
                    <div>
                    <center>Tamil Nadu</center>    
                    </div>
                </div>
             </div>
            </div>

        <span><h3>Top Destinations(outside India)</h3></span>       
      </div>
            <div class="cards">
             <div class="card-single">
                <div>
                    <img src="img/Ceatle.jfif" style="width:100%">
                    <div>
                    <center>Ceatle</center>
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/London.jfif" style="width:100%">
                    <div>
                    <center>London</center>
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/paris.jfif" style="width:100%">
                    <div>
                    <center>Paris</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/egypt.jfif" style="width:100%">
                    <div>
                    <center>Egypt</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/newyork.jfif" style="width:100%">
                    <div>
                    <center>New York</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/brazil.jfif" style="width:100%">
                    <div>
                    <center>Brazil</center>    
                    </div>
                </div>
             </div>
             <div class="card-single">
                <div>
                    <img src="img/Berlin.jfif" style="width:100%">
                    <div>
                    <center>Berlin</center>    
                    </div>
                </div>
             </div>
             
             <div class="card-single">
                <div>
                    <img src="img/canada.jfif" style="width:100%">
                    <div>
                    <center>Canada</center>    
                    </div>
                </div>
             </div>
            </div>


    </body>
    </html>
    