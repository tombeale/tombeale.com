<?php
  $email = $_REQUEST['email'] ;
  $message = $_REQUEST['message'] ;
mail( "tombeale07@earthlink.net", "Feedback Form Results", $message, "From: $email" );
#  header( "Location: http://www.example.com/thankyou.html" );
?>
Done...