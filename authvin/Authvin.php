<?php

namespace Authvin;

use Illuminate\Support\Str;

class Authvin {

    public function generateRandomCode()
    {
        return hash_hmac('sha256', Str::random(40), config('app.key'));
    }

}
