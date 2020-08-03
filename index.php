<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width-device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <!-- Font Awesome-->
        <script src="https://kit.fontawesome.com/47d83f34b3.js" crossorigin="anonymous"></script>

        <link href="https://fonts.googleapis.com/css?family=Candal|Lora&display=swap" rel="stylesheet">
        
        <script type='text/javascript' src='jquery-3.4.1.min.js'></script>
        <!--Custom Styling-->
        <link rel="stylesheet" href="css/style.css">


        <title>Diaster Mangement</title>
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

        <!-- PAGE WRAPPER-->
        <div class="page-wrapper">

            <!--post slider-->
            <div class="post-slider">
                <h1 class="slider-title"> Request</h1>
                <i class="fas fa-chevron-left prev"></i>
                <i class="fas fa-chevron-right next"></i>
                <div class="post-wrapper">

                 

                <?php
    
                    include_once('connection.php');    
                    $query = "SELECT * from map";
                    $result = mysqli_query($con, $query);
                    ?>

                    <?php

                    while($rows=mysqli_fetch_assoc($result)) {

                    ?>                        
                        <div class="post"  
                             id="<?php echo htmlspecialchars($rows['map_id']); ?>" 
                             onclick="redirect(this.id)">

                            <img class="slider-image" src="uploads/<?php echo $rows['image']?>">
                             <h4><?php echo $rows['fname'], " ", $rows['lname']; ?></h4>
                             <p><?php echo $rows['request']?></p>
                        </div>
                    
                            <?php 
                              }
                            ?>
				</div>
         </div>
         
         <!--COntent-->
         <div class="content clearfix">
             <div class="main-content">

                <b class="logo-text"><h3>Disaster Management</h3></b>
                 <p>
                        Disaster Management can be defined as the organization and management of resources and 
                        responsibilities for dealing with all humanitarian aspects of emergencies,
                         in particular preparedness, 
                         response and recovery in order to lessen the impact of disasters.
                 </p>

             </div>

             
         </div>
     </div>

     <!--Footer-->

     <div class="footer">
        We cannot stop natural disasters but we can arm ourselves with knowledge: so many lives wouldn't have to be lost if there was enough disaster preparedness.
        <div class="footer-bottom">
            &copy; |Designed By Rahul Yadav Vivek Ram Sachin Dubey
        </div>
     </div>
        J-Query--> 
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" ></script> 
       
        Slick 
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
 				
       
        <script src="js/script.js"></script>
        
<script>
  
  function redirect(ID){    
      var a = ID;
      $.post('temp.php',{id:a},
        function(data){
            window.location.href = "request.php";
        });
  }

</script>

				


    </body>
</html>