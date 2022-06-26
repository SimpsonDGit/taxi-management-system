<?php 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: index.php");
}
$uname = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Bucai Taxi - Welcome</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css"href="w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins">
<style>
  body,h1,h2,h3,h4,h5 {font-family: "Poppins", sans-serif}
  body {font-size:16px;}
  .w3-half img{margin-bottom:-6px;margin-top:16px;opacity:0.8;cursor:pointer}
  .w3-half img:hover{opacity:1}
  .zoom {
    padding: 50px;
    
    transition: transform .2s;
    width: 200px;
    height: 200px;
    margin: 0 auto;
  }

  .zoom:hover {
    -ms-transform: scale(1.5); /* IE 9 */
    -webkit-transform: scale(1.5); /* Safari 3-8 */
    transform: scale(1.5); 
  }
  * {box-sizing: border-box}

  a:link {
  text-decoration: none;
  }

  /* Container needed to position the overlay. Adjust the width as needed */
  .container2 {
    position: relative;
    display:inline-block;
    width: 50%;
    max-width: 300px;
    padding-top:20px;
  }

  /* The overlay effect - lays on top of the container and over the image */
  .overlay {
    position: absolute;
    bottom: 0;
    background: rgb(0, 0, 0);
    background: rgba(0, 0, 0, 0.5); /* Black see-through */
    color: #f1f1f1;
    width: 60%;
    transition: .5s ease;
    opacity:0;
    color: white;
    font-size: 14px;
    padding: 20px;
    text-align: center;
  }

  /* When you mouse over the container, fade in the overlay title */
  .container2:hover .overlay {
    opacity: 1;
  }
</style>
</head>

<body>
<!-- Sidebar/menu -->
<nav class="w3-sidebar w3-yellow w3-collapse w3-top w3-large w3-padding" style="z-index:3;width:300px;font-weight:bold; right:0" id="mySidebar"><br>
  <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-hide-large w3-display-topleft" style="width:100%;font-size:22px">Close Menu</a>
  <div class="w3-container">
    <a href="welcome.php"> <h3 class="w3-padding-64"><img src="Bucai Taxi Logo.jpg" style="width:80%"> </h3> </a>
  </div>
  <div class="w3-bar-block">
    <a href="#forms" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Forms</a> 

    <?php if($uname == "Admin") { ?>
      <a href="#tables" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Tables</a>
    <?php } ?>

	  <!--<a href="#contact" onclick="w3_close()" class="w3-bar-item w3-button w3-hover-white">Contact</a>-->
    <a href="logout.php" class="w3-bar-item w3-button w3-hover-black">Logout</a>
  </div>
</nav>

<!-- Top menu on small screens -->
<header class="w3-container w3-top w3-hide-large w3-red w3-xlarge w3-padding">

  <a href="javascript:void(0)" class="w3-button w3-red w3-margin-right" onclick="w3_open()">☰</a>
  <span>Bucai Taxi</span>
</header>

<!-- Overlay effect when opening sidebar on small screens -->
<div class="w3-overlay w3-hide-large" onclick="w3_close()" style="cursor:pointer" title="close side menu" id="myOverlay"></div>

<!-- !PAGE CONTENT! -->
<div class="w3-main" style="margin-left:40px;margin-right:350px">
<!--<?php echo "<h1>Welcome " . $_SESSION['username'] . "</h1>"; ?>-->
  <!-- Header -->
  <div class="w3-container" style="margin-top:30px" id="forms">
    <h1 class="w3-jumbo"><b><?php echo "Welcome " . $_SESSION['username'] . ""; ?></b></h1>
    <h1 class="w3-xxxlarge w3-text-green"><b>Submit a New Form.</b></h1>
    <hr style="width:250px;border:5px solid black" class="w3-round">
  </div>
  
  <!-- Photo grid (modal) onclick="onClick(this)"-->
  <div class="w3-row-padding">
    <div class="container2">
      <a href="addDriver.php"><img src="driver_icon.png" style="width:55%"  alt="Add Driver"> 
      <div class="overlay">Add New Driver</div></a>
    </div>
    <div class="container2">
      <a href="addvehicle.php"><img src="taxi_Icon.png" style="width:55%"  alt="Add Vehicle"> 
      <div class="overlay">Add New Vehicle</div></a>
    </div>
    <div class="container2">
      <a href="addtaxicompany.php"><img src="" style="width:55%"  alt="Add Taxi Company"> 
      <div class="overlay">Add Taxi Company</div></a>
    </div>
    <div class="container2">
      <a href="addinsured.php"><img src="company_icon.png" style="width:55%"  alt="Add Insurance Company"> 
      <div class="overlay">Add Insurance Company</div></a>
    </div>
    <div class="container2">
      <a href="createReceipt.php"><img src="receipt_icon.png" style="width:55%"  alt="Create Receipt"> 
      <div class="overlay">Create Receipt</div></a>
    </div>
    <div class="container2">
      <a href="addservice.php"><img src="service_icon.png" style="width:55%"  alt="Add Service Appointment"> 
      <div class="overlay">Add Service Appointment</div></a>
    </div>
    <div class="container2">
      <a href="accidentform.php"><img src="incident_icon.png" style="width:55%"  alt="Report Accident"> 
      <div class="overlay">Accident Form</div></a>
    </div>
</div>

  <!-- Modal for full size images on click
  <div id="modal01" class="w3-modal w3-black" style="padding-top:0" onclick="this.style.display='none'">
    <span class="w3-button w3-black w3-xxlarge w3-display-topright">×</span>
    <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent w3-padding-64">
      <img id="img01" class="w3-image">
      <p id="caption"></p>
    </div>
  </div>
  -->
  <?php if($uname == "Admin") { ?>
  <!-- Table Header -->
  <div class="w3-container" id="tables" style="margin-top:60px">
    <h1 class="w3-xxxlarge w3-text-green"><b>View Table Data.</b></h1>
    <hr style="width:50px;border:5px solid black" class="w3-round">
    
  </div>
  
  <!-- Data Tables -->
  <div class="w3-row-padding w3-grayscale">
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="/w3images/team2.jpg" alt="taxi" style="width:100%">
        <div class="w3-container">
          <h3><a href="viewVehicle.php">Vehicles</a></h3>
          <p class="w3-opacity"># of vehicles</p>
          <p>View and Edit Vehicle Records.</p>
        </div>
      </div>
    </div>
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="/w3images/team1.jpg" alt="driver" style="width:100%">
        <div class="w3-container">
          <h3><a href="viewDriver.php">Drivers</a></h3>
          <p class="w3-opacity"># of drivers</p>
          <p>View and edit Driver Records.</p>
        </div>
      </div>
    </div>
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="/w3images/team3.jpg" alt="receipt" style="width:100%">
        <div class="w3-container">
          <h3><a href="viewReceipts.php">Receipts</a></h3>
          <p class="w3-opacity"># of receipts</p>
          <p>View and edit receipt information.</p>
        </div>
      </div>
    </div>
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="/w3images/team3.jpg" alt="maintenance" style="width:100%">
        <div class="w3-container">
          <h3><a href="viewServicing.php">Service Details</a></h3>
          <p class="w3-opacity"># of records</p>
          <p>View and edit vehicle service schedule/details.</p>
        </div>
      </div>
    </div>
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="/w3images/team3.jpg" alt="accident" style="width:100%">
        <div class="w3-container">
          <h3><a href="viewAccident.php">Incident Details</a></h3>
          <p class="w3-opacity"># of incidents</p>
          <p>View and edit incident details.</p>
        </div>
      </div>
    </div>
    <div class="w3-col m4 w3-margin-bottom">
      <div class="w3-light-grey">
        <img src="/w3images/team3.jpg" alt="company" style="width:100%">
        <div class="w3-container">
          <h3><a href="viewInsCompanies.php">Insurance Companies</a></h3>
          <p class="w3-opacity"># of records</p>
          <p>View and edit Insurance Company details.</p>
        </div>
      </div>
    </div>
  </div>
  <?php } ?>

  <!-- Contact 
  <div class="w3-container" id="contact" style="margin-top:75px">
    <h1 class="w3-xxxlarge w3-text-red"><b>Contact.</b></h1>
    <hr style="width:50px;border:5px solid green" class="w3-round">
    <p>Do you want us to style your home? Fill out the form and fill me in with the details :) We love meeting new people!</p>
    <form action="/action_page.php" target="_blank">
      <div class="w3-section">
        <label>Name</label>
        <input class="w3-input w3-border" type="text" name="Name" required>
      </div>
      <div class="w3-section">
        <label>Email</label>
        <input class="w3-input w3-border" type="text" name="Email" required>
      </div>
      <div class="w3-section">
        <label>Message</label>
        <input class="w3-input w3-border" type="text" name="Message" required>
      </div>
      <button type="submit" class="w3-button w3-block w3-padding-large w3-red w3-margin-bottom">Send Message</button>
    </form>  
  </div>
  -->
<!-- End page content -->
</div>



<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
  document.getElementById("myOverlay").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
  document.getElementById("myOverlay").style.display = "none";
}

// Modal Image Gallery
function onClick(element) {
  document.getElementById("img01").src = element.src;
  document.getElementById("modal01").style.display = "block";
  var captionText = document.getElementById("caption");
  captionText.innerHTML = element.alt;
}
</script>

</body>
</html>
