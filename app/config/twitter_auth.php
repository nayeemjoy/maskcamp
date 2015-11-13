<?php 
    return array( 
      "base_url" => "http://www.scdnlab.com/joy/public/tauth/auth",  
      "providers" => array (
        "Facebook" => array ( 
          "enabled" => true,
          "keys"    => array( "id" => "WqzxfZThUZoLJUD4SdKrdwXHI", 
          	"secret" => "J2G1m7ChD4QPDfUSCygfaA5BcSYT7Oom1bdascznMAGOTmPOm8" ), 
          "scope"   => "email, user_about_me, user_birthday, user_hometown", // optional
          "display" => "popup" // optional
    )));