<?php 
    return array( 
      "base_url" => "http://www..com/path/to/hybridauth/",  
      "providers" => array (
        "Facebook" => array ( 
          "enabled" => true,
          "keys"    => array ( "id" => "374453862708387", "secret" => "d8ab419c4d092be99eb9911949c02208" ), 
          "scope"   => "email, user_about_me, user_birthday, user_hometown", // optional
          "display" => "popup" // optional
    )));