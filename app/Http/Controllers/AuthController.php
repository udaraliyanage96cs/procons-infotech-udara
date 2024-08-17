<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;
use App\Mail\EmailVerification;
use App\Mail\ForgotPassword;


class AuthController extends Controller
{

    public function signup(Request $req){

        if(User::where('email',$req->email)->exists()){
            return back()->withErrors(['message' => 'exsists']);
        }else{
            $user = new User;
            $user->name = $req->name;
            $user->email = $req->email;
            $user->password = Hash::make($req->password);
            $user->save();

            $user_id = $user->id;
            $baseUrl = url('/');
            $details = [
                'email' => $req->name,
                'message' => "Please Verify Your Email!",
                'url' => $baseUrl.'/verify/'.$user_id,
            ];

            Mail::to($req->email)->send(new EmailVerification($details));
            return redirect('/email-verification');
        }

        
    }

    public function verify(Request $req){

        $user = User::find($req->id);
        if($user){
            $timestamp = Carbon::now();
            $user->update([
                'email_verified_at' =>$timestamp, 
            ]);
            return redirect('/email-verified');
        }else{
            return redirect('/email-verification-faild');
        }

        
    }
    
    public function signin(Request $req){
        
        $userdata = array(
            'email'     => $req->email,
            'password'  => $req->password
        );
        if (Auth::attempt($userdata)) {
            if (Auth::user()->email_verified_at) {
                return redirect("/dashboard");
            }else{
                Auth::logout();
                return back()->withErrors(['message' => 'not-verified']);
            }
        } else {        
            return back()->withErrors(['message' => 'faild']);
        }
    }

    public function forgot_password(Request $req){

        $status = "";

        if(User::where('email', $req->email)->exists()){
            $token = Str::random(20);
            $user = User::where('email', $req->email)->first();

            $existingToken = DB::table('password_reset_tokens')
            ->where('email', $req->email)
            ->first();

            if ($existingToken) {
                DB::table('password_reset_tokens')
                    ->where('email', $req->email)
                    ->delete();
            }

            DB::table('password_reset_tokens')->insert([
                'email' => $req->email, 
                'token' => $token, 
                'created_at' =>  \Carbon\Carbon::now('Asia/Colombo')
            ]);

            $details = [
                'email' => $req->email,
                'uid' => $user->id,
                'token' => $token,
            ];

            Mail::to($req->email)->send(new ForgotPassword($details));

            $status = "success";
        }else{
            $status = "faild";
        }

        return redirect()->back()->withErrors([$status]);
       
    }
    public function reset_password(Request $req){

        $token = $req->token;
        $password = $req->password;
        $status = '';

        $user = User::find($req->id);

        $pwd_reset = DB::table('password_reset_tokens')->where('email', $user->email)->latest()->first();

        $to = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', \Carbon\Carbon::now('Australia/Sydney'));
        $from = \Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $pwd_reset->created_at);
        $diff_in_seconds = $to->diffInSeconds($from);

        if($diff_in_seconds < 300){
            if($pwd_reset->token == $token){
                $user->update([
                    'password' =>  Hash::make($password),
                ]);
                $status = 'success';
            }else{
                $status = 'faild';
            }
        }else{
            $status = 'expired';
        }
        
        return redirect()->back()->withErrors([$status]);
       
    }
}