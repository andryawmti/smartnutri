<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class UserLoginController extends Controller
{
    public function __construct()
    {
        return $this->middleware('guest:user', ['except'=>['userLogout']]);
    }

    /**
     * Show login form
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showLoginForm()
    {
        return view('auth.login');
    }

    /**
     * Login
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function login(Request $request)
    {
        // validate the form data
        $this->validate($request, array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        ));

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );

        // attempt to log the user in
        if (Auth::guard('user')->attempt($credentials, $request->remember)) {
            // if successful, then redirect to their intended location
            $user = Auth::guard('user')->user();
            $user->generateToken();
            return response()->json(array(
                'user'=> $user
            ));
//            return redirect()->intended(route('dashboard'));
        }

        return response()->json(array(
            'message' => 'authentication failed'
        ));

        // if unsuccessful, then redirect back to login with the form data
//        return redirect()->back()->withInput($request->only('email', 'remember'));
    }

    /**
     * Logout
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function userLogout(Request $request)
    {
        $api_logout = $this->apiLogout();
        return $api_logout;
        Auth::guard('user')->logout();
        return redirect('/user/login');
    }

    public function apiLogout()
    {
        $user = Auth::guard('user-api')->user();
        if ($user) {
            $user->api_token = null;
            $user->save();
        }

        return response()->json(['data'=>'User logged out', 'user' => $user], 201);
    }

    public function userLogin(Request $request)
    {
        // validate the form data
        $this->validate($request, array(
            'email' => 'required|email',
            'password' => 'required|min:6'
        ));

        $credentials = array(
            'email' => $request->email,
            'password' => $request->password
        );

        if (Auth::guard('user')->attempt($credentials, $request->remember)) {
            $user = Auth::guard('user')->user();
            $user->generateToken();
            return response()->json(array(
                'error' => false,
                'message' => 'login successful',
                'user' => $user
            ));
        }

        return response()->json(array(
            'error' => true,
            'message' => 'login failed, credentials not match',
        ));
    }
}
