<?php

namespace Authvin\Social;

use Auth;

trait Social {

  /**
  * Redirect the user to the authentication page.
  *
  * @return Response
  */
  protected function redirectToSocial($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  /**
  * Obtain the user information.
  *
  * @return User
  */
  public function getSocialUser($provider)
  {
    $user = Socialite::driver($provider)->user();
    return $user;
  }

  public function redirectToGoogle() {
    return $this->redirectToSocial('google');
  }

  public function handleGoogleCallback() {
    $provider = 'google';
    $ouser = $this->getSocialUser($provider);
    $user = queryProfiles($provider)->where('id', $ouser->getId())->first();
    if($user == null) {
      $this->createOAuthUser($ouser, $provider);
    } else {
      Auth::login($user);
    }
  }

  protected function createOAuthUser($user, $provider) {
    DB::table('oauth_profiles')->insert(
      ['provider' => $provider, 'id' => $user->getId()]
    );
  }

  protected function queryProfiles($provider) {
    $query = DB::table('oauth_profiles')->where('provider', $provider);
    return $query;
  }

}
