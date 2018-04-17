<?php

namespace App\Http\Controllers;

use App\Fileentry;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth:user-api'],['except'=>['index']]);
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
            'user' => $user,
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
            return response()->json($user);
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
            return response()->json($users);
        }

        return response()->json(array(
            'message' => 'User not found'
        ));
    }

    public function updatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $user->save();

        return response()->json(array(
            'error' => false,
            'message'=> 'Password successfully updated',
            'user' => $user,
        ));
    }

    public function uploadPhoto(Request $request, $id)
    {
        $file = Request::file('photo_profile');
        $extension = $file->getClientOriginalExtension();
        $file_name = $unique_name = md5($file->getFilename() . time());
        Storage::disk('local')->put($file_name.'.'.$extension, File::get($file));

        $user = User::find($id);
        $user->photo = $file_name.".".$extension;
        $user->photo_mime = $file->getClientMimeType();
        $user->save();

        return response()->json(array(
            'error' => false,
            'message'=> 'Photo profile successfully updated',
            'user' => $user,
        ));
    }

    /*public function getFile($filename){

        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return (new Response($file, 200))
            ->header('Content-Type', $entry->mime);
    }*/
}
