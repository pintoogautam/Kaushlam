<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\AmazonAPI;
use App\User;
use App\Models\Education;
use App\Models\Job;
use App\Models\UserProfile;
use App\Models\UserWorkDetail;
use App\Models\Country;
use App\Models\State;
use App\Models\City;
use Illuminate\Support\Facades\Auth;
class UserController extends Controller
{
    public function myHome()
    {
        if (Auth::check())
        {
            $data  = Auth::user();
            return view('home/myhome', ['name'=>$data->name,
            'email'=>$data->email,
            'phone'=>$data->phone,
            'address'=>$data->address]);
        }
        else{
            return redirect()->to('/');
        }
       
    }

    public function editProfile()
    {
        $countries = [];
        $states = [];
        $cities = [];
        $educations = [];
        $jobs = [];
        $user_profiles = [];
        $user_work_details = [];

        if (Auth::check())
        {
            $data  = Auth::user();
            $countries  = Country :: select('country_id','title')->where('status',1)->get();
            $states     = State :: select('state_id','title')->where('status',1)->get();
            $cities     = City :: select('city_id','title')->where('status',1)->get();
            $educations = Education :: select('id','title')->where('status',1)->get();
            $jobs = Job :: select('id','title')->where('status',1)->get();
            $user_profiles = UserProfile :: select('*')->where('user_id',$data->id)->get();
            $user_work_details = UserWorkDetail :: select('*')->where('user_id',$data->id)->get();

            return view('user/update-profile',
             ['name' => $data->name,
            'email' => $data->email,
            'phone' => $data->phone,
            'dob' => $data->dob,
            'countries' => $countries,
            'states' => $states,
            'cities' => $cities,
            'educations' => $educations,
            'jobs' => $jobs,
            'user_profiles' => $user_profiles,
            'user_work_details' => $user_work_details,
            ]);
        }
        else{
            return redirect()->to('/login');
        }
    }
    /**
     * update main users table data related to account
     */
    public function updateAccount(array $data) {

        // validate the info, create rules for the inputs
        $rules = array(
            'email'    => 'email', 
            'phone' => 'alphaNum|min:7|max:12',
            'name' => 'required|max:100',
            'fname' => 'max:100', 
            'lname' => 'max:100',
        );

        $validator = Validator::make(request(), $rules);

        if ($validator->fails()) {

                return response()->json( array( 'status' => false, 'error' => $validator));
        } else {
            $user  = Auth::user();
            

            // attempt to do the login
            if (isset($user->id)) {
                $user = User::where('id', $user->id)
            ->update([
                'name' => $data['name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'fname' => $data['fname'],
                'lname' => $data['lname'],
            ]);
            return response()->json( array( 'status' => true, 'error' => "Account updated sucessfully."));
            } else {        

                // validation not successful, send back to form 
                return Redirect::to('login');

            }

        }
        
       
    }
    /**
     * update user_profiles table data related to users
     * basic inforation
     */
    public function updateProfile(array $data) {

        // validate the info, create rules for the inputs

        $rules = array(
            'photo'  => 'max:150', 
            'country_id' => '', 
            'state_id' => '', 
            'city_id' => '', 
            'address' => 'max:100'
        );

        $validator = Validator::make(request(), $rules);

        if ($validator->fails()) {

                return response()->json( array( 'status' => false, 'error' => $validator));
        } else {
            $user  = Auth::user();
            

            // attempt to do the login
            if (isset($user->id)) {
                $user = UserProfile::where('id', $user->id)
            ->update([
                'photo' => $data['photo'],
                'country_id' => $data['country_id'],
                'state_id' => $data['state_id'],
                'city' => $data['city'],
                'address' => $data['address'],
            ]);
            return response()->json( array( 'status' => true, 'error' => "Your profile updated successfully."));
            } else {        

                // validation not successful, send back to form 
                return Redirect::to('login');

            }

        }
        
       
    }

    /**
     * update user password data related to account
     */
    public function updatePaasword(array $data) {

        // validate the info, create rules for the inputs
        $rules = array(
            'old_password' => 'required', 
            'password'     => 'required|alphaNum|max:20', 
            'confirm_password' => 'required|alphaNum|max:20', 
        );

        $validator = Validator::make(request(), $rules);
        if (!(bcrypt($data['old_password'], Auth::user()->password))) {
            // The passwords matches
            return response()->json( array( 'status' => false, 'error' => 'Your current password is not valid. Please try again.'));
        }
        if ($validator->fails()) {

                return response()->json( array( 'status' => false, 'error' => $validator));
        } else {
            $user  = Auth::user();
            

            // attempt to do the login
            if (isset($user->id)) {
                $user = User::where(['id'=> $user->id, 'password'=> $data['old_password']])
            ->update([
                'password' => bcrypt($data['password'])
            ]);
            return response()->json( array( 'status' => true, 'error' => "Password changed successfully."));
            } else {        

                // validation not successful, send back to form 
                return response()->json( array( 'status' => false, 'error' => "Your request could not process."));

            }

        }
        
       
    }

}