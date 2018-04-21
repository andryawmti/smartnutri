<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    

    public function resetPassword(Request $request)
    {
        $email = $request->input('email');
        return $email;
//        $user = User::where('email', '=', $email)->first();
//        if ( count($user) > 0 ) {
//            $newPassword = str_random(8);
//            $send = Mail::to("andri@niagahoster.co.id")->send(new ResetPassword($newPassword));
//            if (Mail::failures()) {
//                return json_encode(array(
//                    "error" => true,
//                    "message" => "Email was not sent"
//                ));
//            }
//
//            $user->password = Hash::make($newPassword);
//            $user->save();
//
//            return json_encode(array(
//                "error" => false,
//                "message" => "Message has been sent"
//            ));
//        }
//
//        return json_encode(array(
//            "error" => true,
//            "message" => "Email not found"
//        ));

    }

}
