<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmazonAPI;
use App\User;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller
{
    // product List
   public function ProductList(){
    return view('product/product-list');
   }

   public function showLogin(){
    // show the form
    return view('login');
   }
   public function doLogin()
   {
   // validate the info, create rules for the inputs
   $rules = array(
       'email'    => 'required|email', // make sure the email is an actual email
       'password' => 'required|alphaNum|min:3' // password can only be alphanumeric and has to be greater than 3 characters
   );
   
   // run the validation rules on the inputs from the form
   $validator = Validator::make(Input::all(), $rules);
   
   // if the validator fails, redirect back to the form
   if ($validator->fails()) {
       return Redirect::to('login')
           ->withErrors($validator) // send back all errors to the login form
           ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
   } else {
   
       // create our user data for the authentication
       $userdata = array(
           'email'     => Input::get('email'),
           'password'  => Input::get('password')
       );
   
       // attempt to do the login
       if (Auth::attempt($userdata)) {
   
           // validation successful!
           // redirect them to the secure section or whatever
           // return Redirect::to('secure');
           // for now we'll just echo success (even though echoing in a controller is bad)
           echo 'SUCCESS!';
   
       } else {        
   
           // validation not successful, send back to form 
           return Redirect::to('login');
   
       }
   
   }
   }
    public function doLogout()
    {
        Auth::logout(); // log the user out of our application
        return Redirect::to('login'); // redirect the user to the login screen
    }
    public function register(){
        // show the form
        return view('auth/register');
    }
    public function signup()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        $user = User::create(request(['name', 'email', 'password']));
        
        auth()->login($user);
        
        return redirect()->to('/games');
    }

    
}
