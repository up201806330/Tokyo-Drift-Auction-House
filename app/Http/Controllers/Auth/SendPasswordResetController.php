<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class SendPasswordResetController extends Controller {
    use SendsPasswordResetEmails;

    protected function sendResetLinkResponse(Request $request, $response) {
        return $request->wantsJson() ? new JsonResponse() : back();
    }

    protected function sendResetLinkFailedResponse(Request $request, $response) {
        if($response === "passwords.throttled") {
            if ($request->wantsJson()) {
                return new JsonResponse(["error" => "throttled"], 422);
            }
            
            return back()
                ->withInput($request->only('email'))
                ->withErrors(['email' => trans($response)]);
        }

        return $this->sendResetLinkResponse($request, $response);
    }
}
