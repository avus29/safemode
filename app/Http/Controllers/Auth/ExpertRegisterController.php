<?php

namespace GistMed\Http\Controllers\Auth;


use Illuminate\Http\Request;
use GistMed\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use GistMed\Expert;

class ExpertRegisterController extends Controller
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
    protected $redirectTo = '/expert';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:expert');
    }

    
    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showExpertRegistrationForm()
    {
        return view('auth.register_expert');
    }

     /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function expertRegister(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        $this->guard()->login($user);

        return $this->registered($request, $user)
                        ?: redirect($this->redirectPath());
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('expert');
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
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:experts'],
            'phone' => ['required', 'regex:/(0)[0-9]{10}/', 'unique:experts'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'gender' =>['required','string'],
            'birthday' => ['required','date'],
            'profession'=>['required','string','max:50'],
            'employer'=>['required','string','max:50'],
            'designation'=>['required','string','max:50'],
    
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \GistMed\Expert
     */
    protected function create(array $data)
    {
        return Expert::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone'=>$data['phone'],
            'gender'=>$data['gender'],
            'birthday'=>$data['birthday'],
            'avatar'=> 'none.png',
            'profession' => $data['profession'],
            'designation' => $data['designation'],
            'employer' => $data['employer'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
