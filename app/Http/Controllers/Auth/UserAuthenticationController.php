<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;



class UserAuthenticationController extends Controller
{

    public function index()
    {
        if (session()->has('error')) {
            Alert::warning('Warning!', session()->pull('error'));
           
        }
        if(session()->has('success')){

         Alert::success('success!',session()->pull('success'));

        }
        header('Cache-Control: no-store, private, no-cache, must-revalidate');
        header('Cache-Control: pre-check=0, post-check=0, max-age=0, max-stale = 0', false);
        header('Pragma: public');
        header('Expires: Sat, 26 Jul 1997 05:00:00 GMT');
        header('Expires: 0', false);
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Pragma: no-cache');
        return view('auth.login_page');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'name' => ['required', 'string', 'exists:users,name'],
            // 'email'=>['required','email','exists:users,email'],
            'password' => ['required', 'min:5', 'max:15'],
        ], [
            'name.exists' => 'The entered username is not registered in the database',
            'email.exists' => 'The entered email is not registered in the database',
        ]);


        if (Auth::attempt($credentials)) {
            if (!Auth::user()->is_approved) {

                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();

                return redirect()->route('index')->with('error', 'You are not yet approved by admin');
            } else if (Auth::user()->usertype === 'admin') {
                return redirect()->intended(route('admin.usermanagement.index'));
            } else {
                return redirect()->intended(route('users.userDashboard'));
            }
        } else {
            session()->flash('sweetAlertIcon', 'warning');
            return redirect()->route('index')->with('error', 'Wrong credentials');
        }
    }


    public function showRegistrationForm()
    {
        return view('auth.register');
    }


    public function register(Request $request)
    {

        $credentials = $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:5', 'max:15'],
            'cpassword' => ['required', 'min:5', 'max:15', 'same:password'],
        ], [
            'cpassword.same' => 'Confirm password field must be the same as password field',
        ]);

        $user = new User();
        $user->name = $credentials['name'];
        $user->email = $credentials['email'];
        $user->password = Hash::make($credentials['password']);
        $registered = $user->save();

        return redirect()->route('showRegistrationForm')->with($registered ? 'success' : 'error', $registered ? 'You have successfully registered' : 'Failed to register');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }
}
