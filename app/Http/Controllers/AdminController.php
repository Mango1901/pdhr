<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function show_login()
    {
        return view("admin_login");
    }
    public function execute_login(Request $request)
    {
        $requestData = $request->all();
        if(Auth::attempt(["email"=>$requestData["username"],"password"=>$requestData["password"]]) || Auth::attempt(["username"=>$requestData["username"],"password"=>$requestData["password"]])){
                return redirect("user/view")->with("message","login successfully");
        }else{
            return redirect("login")->with("error","username,email or password is not correct");
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect("login")->with("message","logout successfully");
    }
}
