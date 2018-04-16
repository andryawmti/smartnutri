<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
//        $user->weight = $request->input('weight');
//        $user->pregnancy_start_at = $request->input('pregnancy_start');
        $user->save();

        return response()->json(array(
            'error' => false,
            'message'=> 'User successfully updated'
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
}
