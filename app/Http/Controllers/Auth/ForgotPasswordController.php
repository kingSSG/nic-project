<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Carbon\Carbon;
use App\Models\User;
use Exception;
use Mail;
use Hash;
use Illuminate\Support\Str;


class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('auth.forgot_password_page');
    }
    public function submitForgotPasswordForm(Request $request)
    {

        $request->validate(
            [
                'email' => ['required', 'email', 'exists:users,email'],
            ],
            [
                'email.exists' => 'The entered email is not registered in the database',
            ]
        );

        $token = Str::random(64);



        DB::table('password_resets')->insert([

            'email' => $request->email,

            'token' => $token,

            'created_at' => Carbon::now()

        ]);


        try {
            Mail::send('email.forgetPassword', compact('token'), function ($message) use ($request) {

                $message->to($request->email);

                $message->subject('Reset Password');
            });
            return redirect()->back()->with('success', 'We have e-mailed your password reset link!');
        } catch (Exception $exception) {
            echo "<h2>$exception</h2>";
        }
    }


    public function showResetPasswordForm($token)
    {
        return view('auth.reset_password_page', compact('token'));
    }


    public function submitResetPasswordForm(Request $request)
    {

        $request->validate(
            [
                'email' => ['required', 'email', 'exists:users,email'],
                'newpassword' => ['required', 'min:5', 'max:15'],
                'cpassword' => ['required', 'min:5', 'max:15', 'same:newpassword'],
            ],
            [
                'cpassword.same' => 'Confirm password field must be the same as new password field',
                'email.exists' => 'The entered email is not registered in the database',
            ]
        );
        $updatePassword = DB::table('password_resets')
            ->where([

                'email' => $request->email,

                'token' => $request->token

            ])
            ->first();

        if (!$updatePassword) {

            return redirect()->back()->withInput()->with('error', 'Invalid token!');
        }
        $user = User::where('email', $request->email)

            ->update(['password' => Hash::make($request->password)]);


        DB::table('password_resets')->where(['email' => $request->email])->delete();


        return redirect()->route('index')->with('success', 'Your password has been changed!');
    }
}
