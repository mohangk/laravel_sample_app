<?php

  return array(	
    "base_url"  => "http://localhost:8000/sign-in/hybrid/auth",

    "providers" => array(

      "Google"    => array(
        "enabled"   => true,

        "keys"      => array(
          "id"        => "431495654649.apps.googleusercontent.com",
          "secret"    => "_Px0UawbSuYH54J4EPsja-WF"
        ),

        "scope"     =>  "https://www.googleapis.com/auth/userinfo.profile ".
                        "https://www.googleapis.com/auth/userinfo.email ".
                        "https://www.googleapis.com/auth/analytics.readonly",

        "access_type" => "offline"

      ),

    ),
  );
