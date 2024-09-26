<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Mail\VerificationCodeMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    public function getLogin(){
        return view('admin.auth.login');
    }
    public function login(Request $request)
    {
        // Validate the incoming request
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Get the login credentials
        $data = $request->only('email', 'password');

        $remember = $request->has('remember');

        // Attempt to authenticate the user
        if (Auth::attempt($data, $remember)) {
            // Get the authenticated user
            $user = Auth::user();

            // Check if the user is not an admin
            if ($user->role && $user->role->name !== 'admin') {
                // Define the allowed IP address
                $allowedIp = '127.0.0.1'; // Replace with the actual allowed IP

                // Get the user's current IP address
                $userIp = $request->ip();

                // Check if the IP address does not match the allowed IP
                if ($userIp !== $allowedIp) {
                    // Logout the user and redirect them back with an error message
                    Auth::logout();
                    return redirect(route('login'))->with('error', 'Login not allowed from this IP address.');
                }
            }
   // Generate a verification code
           $verificationCode = Str::random(6); // or any desired length
          $user->update(['verification_code' => $verificationCode]);

       // Send verification code to user email
       Mail::to($user->email)->send(new VerificationCodeMail($user));
       Auth::logout();

   // Redirect to code verification page
   return redirect()->route('verification.code.form',$user->id)->with('message', 'A verification code has been sent to your email.');

        } else {
            // Redirect back with an error message if authentication fails
            return redirect(route('login'))->with('error', 'Your Email or Password is incorrect.');
        }
    }


    public function logout(){
        Auth::logout();
        return redirect(route('login'));
    }

    public function verifyCode($id){
        $user= User::whereId($id)->firstOrFail();
        return view('admin.auth.cofirm_password',compact('user'));
    }
    public function confirmCode(Request $request){
        $code= implode($request->code);
        $user= User::where('verification_code', $code)->first();
        if($user){
            $user->verification_code= null;
            $user->save();
            Auth::login($user);
            return redirect(route('dashboard'));
        }else{
            return redirect()->back()->with('error', 'Your Code is incorrect Please Type Correct Code.');
        }
    }
}
