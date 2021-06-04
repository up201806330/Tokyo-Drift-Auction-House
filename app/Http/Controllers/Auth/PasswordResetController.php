<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordResetController extends Controller {
    use ResetsPasswords;

    protected $redirectTo = '/';
    
}
