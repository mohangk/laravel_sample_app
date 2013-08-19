<?php

namespace Sessions;

class HybridController extends \BaseController {

  public function create($action = "") {
    if ($action == "auth") {

      try {
        \Hybrid_Endpoint::process();
      } catch (Exception $e) {
        return Redirect::route('hybridauth');
      }

      return;
    }

    $socialAuth = new \Hybrid_Auth(app_path() . '/config/hybridauth.php');

    $provider = $socialAuth->authenticate("Google");

    if(!$provider->isUserConnected()) return;

    $accessToken = $provider->getAccessToken();
    $userProfile = $provider->getUserProfile();

    $provider->logout();

    $user = \User::where('email', '=', $userProfile->email)->first();
    $email = $userProfile->email;

    if($user) {
      $user->update([
        'google_access_token' => $accessToken['access_token'],
        'google_access_token_expires_at' => date(\DateTime::ISO8601, $accessToken['expires_at']),
        'google_photoURL' => $userProfile->photoURL
      ]);


      \Auth::login($user);
      return \Redirect::to('/');
    } else {
      return \Redirect::to('sign-in')
        ->with('message', "We couldn't find a user with the email '$email'");
    }
  }

}
