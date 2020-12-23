<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Mail;

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
    protected $redirectTo = '/myhome';

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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {

        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $activation_key = $this->getToken();
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'activation_key' => $activation_key,
            'status' => 1
        ]);
        $this->guard()->login($user);

        //write a code for send email to a user with activation link
        $data['activation_link'] = url('/activation/' . $activation_key);

        // Mail::send('emails.mail', $data, function($message) use ($data) {
        //     $message->to($data['email'])
        //             ->subject('Activate Your Account');
        //     $message->from('s.sajid@artisansweb.net');
        // });
        return $user;
        return $this->registered(request(), $user)?: redirect($this->redirectPath())->with('success', 'We have sent an activation link on your email id. Please verify your account.');
        
    }
     /**
    * Generate a unique token
    *
    * @return unique token
    */
    public function getToken() {
        return hash_hmac('sha256', str_random(40), config('app.key'));
    }
}
