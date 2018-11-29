<?php

namespace GistMed\Http\Controllers\Auth;

use Illuminate\Http\Request;
use GistMed\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpertLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:expert',['except'=>['logout']]);        
    }

    //Display the Expert Login Form
    public function showLoginForm(){
        return view('auth.expert_login');
    }

    //Log in the Expert
    public function login(Request $request){
        //Validate the form data
        $this->validate($request, [
            'email'=>'required|email',
            'password' => 'required|min:6'
        ]);

        //Attempt to log the EXPERT in
        if (Auth::guard('expert')->attempt(['email'=>$request->email,'password'=>$request->password],$request->remember)){
            //IF successful, then redirect to theier intended location
            return redirect()->intended(route('expert.dashboard'));
        }
        //If unsuccessful, then redirect back to the login with the form data
        return redirect()->back()->withInput($request->only('email','remember'));
    }

    /**
     * Log the EXPERT out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::guard('expert')->logout();

        return redirect('/');
    }

}
