<?php

namespace GistMed\Http\Controllers\Auth;

use GistMed\User;
use GistMed\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'alias' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'regex:/(0)[0-9]{10}/', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'gender' =>['required','string'],
            'birthday' => ['required','date'],
    
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \GistMed\User
     */
    protected function create(array $data)
    {
        return User::create([
            'alias' => $data['alias'],
            'email' => $data['email'],
            'phone'=>$data['phone'],
            'gender'=>$data['gender'],
            'birthday'=>$data['birthday'],
            'avatar'=> 'none.png',
            'password' => Hash::make($data['password']),
        ]);
    }
}
