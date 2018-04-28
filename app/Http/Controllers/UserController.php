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

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    /**
     * Show user dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('partials.page_user_index')->with(array('users'=>$users));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('partials.page_user_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = new User();
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->address = $request->input('address');
        $user->birth_date = $request->input('birth_date');
        $user->pregnancy_start_at = $request->input('pregnancy_start_at');
        $user->weight = $request->input('weight');
        $user->height = $request->input('height');

        if ($request->hasFile('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $file_url = Storage::url($path);
            $user->photo = $file_url;
            $user->photo_mime = $request->file('image')->getClientMimeType();
        }
        $save = $user->save();

        if ($save) {
            $error = false;
            $result = ['success' =>"New user successfully added"];
        }else{
            $error = true;
            $result = ['error' =>"New user failed to save"];
        }

        return redirect()->route('user.create')->with($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view('partials.page_user_edit_v2')->with(array('user'=>$user));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->first_name = $request->input('first_name');
        $user->last_name = $request->input('last_name');
        $user->email = $request->input('email');
        $user->address = $request->input('address');
        $user->birth_date = $request->input('birth_date');
        $user->pregnancy_start_at = $request->input('pregnancy_start_at');
        $user->weight = $request->input('weight');
        $user->height = $request->input('height');

        if ($request->hasFile('image')) {
            $path = Storage::putFile('public/images', $request->file('image'));
            $file_url = Storage::url($path);
            $user->photo = $file_url;
            $user->photo_mime = $request->file('image')->getClientMimeType();
        }
        $save = $user->save();

        if ($save) {
            $error = false;
            $result = ['success' => "User successfully updated"];
        }else{
            $error = true;
            $result = ['error' => "User failed to update"];
        }

        return redirect()->route('user.index')->with($result);

    }

    public function UpdatePassword(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request->input('password'));
        $save = $user->save();

        if ($save) {
            $error = false;
            $result= ['success' => "Password successfully updated"];
        }else{
            $error = true;
            $result = ['error' => "Password failed to update"];
        }

        return redirect()->route('user.index')->with($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);

        $result = ['success' => 'User '.$user->first_name.' '.$user->last_name.' successfully deleted'];
        return redirect()->route('user.index')->with($result);
    }


}
