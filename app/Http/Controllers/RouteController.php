<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class RouteController extends Controller
{
    public function index_view(Request $req){
        return view("index");
    }

    public function signin_view(Request $req){
        if(Auth::check()){
            return redirect('/');
        }else{
            return view("auth.signin");
        }
    }

    public function signup_view(Request $req){
        if(Auth::check()){
            return redirect('/');
        }else{
            return view("auth.signup");
        }
    }

    public function email_verification(Request $req){
        return view("info.emailverification");
    }

    public function email_verification_faild(Request $req){
        return view("info.emailverificationfaild");
    }
    public function email_verified(Request $req){
        return view("info.emailverified");
    }
    
    public function forgot_password_view(Request $req){
        return view("auth.forgotpwd");
    }
    
    public function dashboard_view(Request $req){
        return view("dashboard")->with("page","Home");
    }

    public function noaccess_view(Request $req){
        return view("errors.noaccess");
    }

    public function reset_password_view(Request $req){
        if(Auth::check()){
            return redirect()->back();
        }else{
            return view("auth.resetpassword")->with("user_id",$req->id);
        }
    }

    public function dashboard_reports_view(Request $req){
        return view("dashboard")->with("page","Reports");
    }

    public function dashboard_reports_add_view(Request $req){
        return view("dashboard")->with("page","ReportsAdd");
    }

    public function dashboard_reports_edit_view(Request $req){
        return view("dashboard")->with("page","ReportsEdit")->with("reportID",$req->id);
    }

    

    


    
}