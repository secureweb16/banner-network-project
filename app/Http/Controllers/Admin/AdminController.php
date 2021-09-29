<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as Controller;
use App\Models\User;
use Hash;
use Auth;

use App\Models\Appraisal;
use App\Models\JewelryType;
use App\Models\Company;
use App\Models\Pdfs;

class AdminController extends Controller
{
    public function index(){
    	$totalappraisals = Appraisal::count();
    	$notstartedappraisals = Appraisal::where('status','0')->count();
    	$inprogressappraisals = Appraisal::where('status','1')->count();
    	$compeateappraisals = Appraisal::where('status','2')->count();
    	$companies = Company::count();
    	$jewelryTypes = JewelryType::count();
    	$users = User::whereRaw('user_role = "2"')->count(); 
    	return view('admin.dashboard',compact('totalappraisals','notstartedappraisals','inprogressappraisals','compeateappraisals','companies','jewelryTypes','users'));
    }

    public function ChangePasswordView(){    	
    	return view('admin.profile.changepassword');
    }

    public function updatePassword(Request $request){

		$user = User::findOrFail(session()->get('user_id'));

		$request->validate([
		    'oldpassword' => 'required',		    
		    'newpassword' => 'required|same:confirmpassword|min:6',
		]);

		if (Hash::check($request->get('oldpassword'), $user->password)) { 
		   $user->fill([
		    'password' => Hash::make($request->get('newpassword'))
		    ])->save();

		   $credentials = array(
				'email' 	=> $user->email,
				'password' 	=> $request->get('newpassword'),
			);

	        if (Auth::attempt($credentials)) {
	            return Redirect::back()->with('message_success', 'Password changed');
	        }

		} else {
		    
		    return Redirect::back()->with('message', 'Old Password does not match');
		}

    }


   /* public function getUser(User $user){


    	print_r($user);exit;
    }*/

}
