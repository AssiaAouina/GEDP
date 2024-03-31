

<?php

session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}

   ?>


 
 <?php require('includes/header.php');?>
           
 <div class="five"> <h1>  <?php 
                        if(isset($_SESSION['user']))
                        {
                           echo $_SESSION['user'];
                        }?> 
                       <span>  <?php
                     date_default_timezone_set('Africa/Casablanca');

       $CurrentHour=date('G');
       $greeting="";
       $imagePath = "";
       if ($CurrentHour>=5 && $CurrentHour <12){
              $greeting="good Morning ";
              echo '<img src="data:image/png;base64,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">';
             
       } elseif ($CurrentHour >= 12 && $CurrentHour < 18) {
         $greeting = 'Good Afternoon';
                      echo '<img src="data:image/png;base64,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">';

     } else {
         $greeting = 'Good Evening';
     }
     echo $greeting;
?></h1></span>
  </div>

                        


 <?php require('includes/footer.php');?>
