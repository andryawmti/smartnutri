<?php

namespace App\Http\Controllers;

use App\Mail\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;

class UserControllerApi extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware("auth:user-api")->except(['index','resetPassword','signUp']);
    }

    /**
     * Show user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }

    public function updateUser(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->address = $request->input('address');
        $user->email = $request->input('email');
        $user->birth_date = $request->input('birth_date');
        $user->weight = (int)$request->input('weight');
        $user->pregnancy_start_at = $request->input('pregnancy_start');
        $user->save();

        return response()->json(array(
            'error' => false,
            'message'=> 'User successfully updated',
            'user' => $this->getUserForAndroid($user),
        ));
    }

    /**
     * get user by id
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUser($id)
    {
        $user = User::find($id);
        if ($user) {
            return response()->json($this->getUserForAndroid($user));
        }

        return response()->json(array(
            'message' => 'User not found'
        ));
    }

    /**
     * get all user
     * @return \Illuminate\Http\JsonResponse
     */
    public function getUsers()
    {
        $users = User::all();
        if (count($users) > 0) {
            return response()->json($this->getUserForAndroid($user));
        }

        return response()->json(array(
            'message' => 'User not found'
        ));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $save = $user->save();

        if ($save) {
            $error = false;
            $message = "Password successfully updated";
        } else {
            $error = true;
            $message = "Password update failed";
        }

        return response()->json(array(
            'error' => $error,
            'message'=> $message,
            'user' => $this->getUserForAndroid($user),
        ));
    }

    public function uploadPhoto(Request $request, $id)
    {
        if ($request->hasFile("image")){
            $path = Storage::putFile("public/images", $request->file("image"));
            $user = User::find($id);
            $file_url = Storage::url($path);

            if ($user->photo != null) {
                $old_photo = $user->photo;
            }

            $user->photo = $file_url;
            $user->photo_mime = $request->file("image")->getClientMimeType();
            $save = $user->save();

            if ($save) {
                if (isset($old_photo)) {
                    unlink(url($old_photo));
                }
                $error = false;
                $message = "Photo profile successfully updated";
            } else {
                $error = true;
                $message = "Photo profile updated failed";
            }

            return response()->json(array(
                'error' => $error,
                'message'=> $message,
                'user' => $this->getUserForAndroid($user),
            ));

        }else{
            return response()->json(array(
                'error' => true,
                'message'=> 'No file choosed'
            ));
        }

    }

    public function getPhotoProfileUrl(Request $request, $id)
    {
        $user = User::find($id);
        $url = Storage::url($user->photo);
        return $url;
    }

    public function getUserForAndroid($user){
        $birth_date = $user->birth_date;
        $pregnancy_start = $user->pregnancy_start_at;
        $user->birth_date = date("Y-m-d", strtotime($birth_date));
        $user->pregnancy_start_at = date("Y-m-d", strtotime($pregnancy_start));
        return $user;
    }
}
