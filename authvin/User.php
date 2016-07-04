<?php

namespace Authvin;

use Illuminate\Foundation\Auth\User as Authenticatable;

abstract class User extends Authenticatable
{

  public function sendEmailConfirmation()
  {
    $emailAddress = $this->email;
    $emailConfirmationCode = "";
    Mail::send($this->emailView, compact('user'), function ($mail) use ($emailAddress) {
        $mail->to($emailAddress);
        $mail->subject(trans('authvin.email_confirmation_subject'));
    };
    $this->confirmed = false;
    $this->confirmation_code = $emailConfirmationCode;
    $this->save();
  }

}
