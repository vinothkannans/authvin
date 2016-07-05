<?php

namespace Authvin;

use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class User extends Authenticatable
{

  public function sendEmailConfirmation($code)
  {
    $this->confirmed = false;
    $this->confirmation_code = $code;

    $emailView = "emails.email-confirmation";
    if(property_exists($this, 'emailConfirmationView')) {
      $emailView = $emailConfirmationView;
    }
    $emailAddress = $this->email;

    Mail::send($emailView, compact('this'), function ($mail) use ($emailAddress) {
        $mail->to($emailAddress);
        $mail->subject(trans('authvin.email_confirmation_subject'));
    });
    $this->save();
  }

}
