<?php

namespace Authvin\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use App\User;

abstract class AuthController extends Controller
{

  protected $username = 'username';

  /**
   * Handle a login request to the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function loginByEmailOrUsername(Request $request) {
    if(property_exists($this, 'username')) {
      $this->username = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
      $request->merge([$this->username => $request->input('login')]);
    }
    return $this->login($request);
  }

  /**
   * Handle a registration request for the application.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function registerAndSendEmailConfirmation(Request $request)
  {
    $response = $this->register($request);
    //$user->sendEmailConfirmation();
    return $response;
  }

  /**
   * Create a new user instance after a valid registration.
   *
   * @param  array  $data
   * @return User
   */
  protected function create(array $data)
  {
      $user =  User::create([
          'name' => $data['name'],
          'email' => $data['email'],
          'confirmed' => false,
          'password' => bcrypt($data['password']),
      ]);
      $user->sendEmailConfirmation(Authvin::generateRandomCode());
      return $user;
  }

}
