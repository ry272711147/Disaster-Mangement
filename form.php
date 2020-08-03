<!DOCTYPE html>
<html>

  <head>
    <meta charset="utf-8">
    <title>Request Form</title>
    <link rel = "stylesheet" type = "text/css" href = "css/style.css">
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script> -->
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


    <div class="project">
      <div class="perDetails">
          <form method="post" action="submit.php" enctype="multipart/form-data">
            <h2>Personal Info:</h2><br>  
    	      <div>
    			   	<label>Firstname : </label>
    				  <input type="text" name="fname">
    		    </div>
    			  <br>
    		    <div>
    			   	<label>Lastname : </label>
    			   	<input type="text" name="lname">
    		    </div>
    		    <br>
    		    <div>
    			   	<label>Gender : </label>
    			   	<input type="radio" name="gender" value="male"/> Male
    			   	<input type="radio" name="gender" value="female"/> Female
    			   	<input type="radio" name="gender" value="other"/> Other
    		    </div>
    		    <br><br>
    			  <div>
    				  <label>Emergency:</label>
    			   	<textarea name='request'id='help' style="cols: '1400'; rows: '50'"></textarea> 
    			  </div>
    			  <br>
            <input type="hidden" name="lat" id="lat">
    		    <input type="hidden" name="lng" id="lng">
    		    <input type="hidden" name="loc" id="loc">
            <br><br><br>
            <input type="file" name="image" id="image" />
            <img id="blah" src="#" alt="your image" /><br><br><br>
            
             <script type="text/javascript">
                function readURL(input) {
                  if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                    $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#image").change(function(){
    readURL(this);
});
             </script>
          </div>
          <div class="mapDetails">
            <label>Location:</label><br><br>
            <div  id = "pac-card">
              <div>
                <div id="title"> Search Your Location</div>
                <div id="type-selector" class="pac-controls"></div>
              </div>
              <div id="pac-container">
                <input id="pac-input" type="text" 
                placeholder="Enter a location">
              </div>
            </div>
            <div id="map"></div>
      <!--   <div id="infowindow-content">
            <img src="" width="14" height="16" id="place-icon">
            <span id="place-name"  class="title"></span><br>
            <span id="place-address"></span>	

      </div>
     -->
          </div>
            <br><br><br><br><br>
          <div class="submitBtn">
            <input type="submit" name="submit" value="Submit">
          </div>
          <br><br>
        </form>
      </div>
    </div>
    <script>

      function initMap() {
        var map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 19.07283, lng: 72.88261},
          zoom: 17
        });
        var card = document.getElementById('pac-card');
        var input = document.getElementById('pac-input');
        var types = document.getElementById('type-selector');
        var strictBounds = document.getElementById('strict-bounds-selector');

        map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);

        var autocomplete = new google.maps.places.Autocomplete(input);

        autocomplete.bindTo('bounds', map);

        autocomplete.setFields(
            ['address_components', 'geometry', 'icon', 'name']);

        var infowindow = new google.maps.InfoWindow();
        var infowindowContent = document.getElementById('infowindow-content');
        infowindow.setContent(infowindowContent);
        var marker = new google.maps.Marker({
          map: map,
          draggable: true,
          anchorPoint: new google.maps.Point(0, -29)
        });

        google.maps.event.addListener(marker, 'dragend', function() {
          geocodePosition(marker.getPosition());
        });

        function geocodePosition(pos) {
   geocoder = new google.maps.Geocoder();
   geocoder.geocode
    ({
        latLng: pos
    }, 
        function(results, status) 
        {
            if (status == google.maps.GeocoderStatus.OK) 
            {
                $("#mapSearchInput").val(results[0].formatted_address);
                $("#mapErrorMsg").hide(100);
            } 
            else 
            {
                $("#mapErrorMsg").html('Cannot determine address at this location.'+status).show(100);
            }
        }
    );
}

        autocomplete.addListener('place_changed', function() {
          infowindow.close();
          marker.setVisible(false);
          var place = autocomplete.getPlace();
          if (!place.geometry) {
            window.alert("No details available for input: '" + place.name + "'");
            return;
          }

          if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
          } else {
            map.setCenter(place.geometry.location);
            map.setZoom(24); 
          }
          marker.setPosition(place.geometry.location);
          marker.setVisible(true);

          var posLat = place.geometry.location.lat();
          var posLng = place.geometry.location.lng();
          var posLoc = place.formatted_address;


          document.getElementById("lat").value=posLat;
          document.getElementById("lng").value=posLng;

          var address = '';
          if (place.address_components) {
            address = [
              (place.address_components[0] && place.address_components[0].short_name || ''),
              (place.address_components[1] && place.address_components[1].short_name || ''),
              (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
          }

          infowindowContent.children['place-icon'].src = place.icon;
          infowindowContent.children['place-name'].textContent = place.name;
          infowindowContent.children['place-address'].textContent = address;
          infowindow.open(map, marker);
        });

        function setupClickListener(id, types) {
          var radioButton = document.getElementById(id);
          radioButton.addEventListener('click', function() {
            autocomplete.setTypes(types);
          });
        }

        setupClickListener('changetype-all', []);
        setupClickListener('changetype-address', ['address']);
        setupClickListener('changetype-establishment', ['establishment']);
        setupClickListener('changetype-geocode', ['geocode']);

        document.getElementById('use-strict-bounds')
            .addEventListener('click', function() {
              console.log('Checkbox clicked! New state=' + this.checked);
              autocomplete.setOptions({strictBounds: this.checked});
            });
      }
    </script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3UjNHkxFsJ-lmCOIDINFpHkXfthClJkA&libraries=places&callback=initMap"
        async defer></script>

  </body>

</html>
