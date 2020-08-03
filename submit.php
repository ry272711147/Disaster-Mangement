      <?php
            session_start();
            include_once('connection.php');
            //getting from database
            $query = "SELECT * from map";
            $result = mysqli_query($con, $query);


            //inserting in database
            if(isset($_POST['submit'])) {
              $fname=$_POST['fname'];
              $lname=$_POST['lname'];
              $gender=$_POST['gender'];
              $request=$_POST['request'];
              $lat=$_POST['lat'];
              $lng=$_POST['lng'];

              $image = $_FILES['image'];
              $imgName = $_FILES['image']['name'];
              $imgTmpName = $_FILES['image']['tmp_name'];
              $imgType = $_FILES['image']['type'];
              $imgExt = explode('.', $imgName);
              $imgActualExt = strtolower(end($imgExt));
              $allowed = array('jpg', 'jpeg', 'png');

              if (in_array($imgActualExt, $allowed)) {
                if($_FILES['image']['error'] === 0){
                  if ($_FILES['image']['size'] < 100000) {
                    $imgNameNew = uniqid('', true).".".$imgActualExt;
                    $imgDst = 'uploads/'.$imgNameNew;
                    move_uploaded_file($imgTmpName, $imgDst);
                  } else{
                    echo "Image too large!";
                  }
                } else{
                  echo "Error uploading file!";
                }
              } else{
                echo "Can upload images only!";
              }


              $query="INSERT INTO map(fname, lname, gender, request, lat, lng, image) 
              VALUES('$fname', '$lname', '$gender', '$request', '$lat', '$lng', '$imgNameNew')";
              if(!mysqli_query($con, $query)) {
                echo 'Not added';
              } else {
                //echo"<div class='alert alert-success'>Pace inserted in Database</div>";
              }
              
              //echo $lat."".$lng;\
              $_SESSION['pic'] = $imgNameNew;
              header("Location: form.php");
              // die();  
    }
  ?>