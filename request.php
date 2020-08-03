<!DOCTYPE html>
 <html>
 <head>
 	<title>Request</title>
 	<script type='text/javascript' src='jquery-3.4.1.min.js'></script>
 	<meta name="viewport" content="initial-scale=1.0">
    <meta charset="utf-8">
	<link rel="stylesheet" href="css/style.css">

 </head>
 <body>

 <header>
            <div class="logo">
                <h1 class="logo.text"><span>Disaster Management</span></h1>
            </div>
            <!-- <i class="fa fa-bars menu-toggle" ></i> -->
            <ul class="nav">
                <li><a href="index.php">Home</a></li>
                <li><a href="form.php">Request</a></li>
            </ul>
        </header>

 	 <?php 
      //Variavles to use in html
 	    session_start(); 	
 		$fname = $_SESSION['fname'];
  		$lname = $_SESSION['lname'];
  		$gender = $_SESSION['gender'];
  		$request = $_SESSION['request'];
  		$lat = $_SESSION['lat'];
  		$lng = $_SESSION['lng'];  	
	?>

  <!-------------MAP------------>
  	<!-- <div class="form-request"> -->
  <div class="reqHolder">
    <div class="details">    
        <label>Name: </label><label><?php echo $fname, " ", $lname ?></label>
        <br><br>
        <label>gender: </label><label><?php echo $gender ?></label>
        <br>
        <br>
        <label>Request: </label><label><?php echo $request ?></label>
        <br>
        <br>
        <label>Latitude: </label><label><?php echo $lat ?></label>
        <br>
        <br>
        <label>Longitutude: </label><label><?php echo $lng ?></label>
        <br>
        <br>
        <br>
    </div>  

    <!-- <div class="border"></div> -->

    <div class="details1">
      <div id="map"></div>
  	</div>
    <br><br><br><br><br><br><br><br><br>
  </div>
  <script>
    var map;
    function initMap() {
      map = new google.maps.Map(document.getElementById('map'), {
        center: {lat: <?php echo $lat ?>, lng: <?php echo $lng?>},
        zoom: 17
      });
      var marker = new google.maps.Marker({
      	position: {lat: <?php echo $lat ?>, lng: <?php echo $lng?>}, 
      	map: map
      });

    }
  </script>

  <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3UjNHkxFsJ-lmCOIDINFpHkXfthClJkA&callback=initMap"
  async defer></script>
	<!-- </div> -->
 </body>
 </html>