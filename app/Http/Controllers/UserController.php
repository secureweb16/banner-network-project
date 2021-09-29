<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\RegistrationToken;
use App\Notifications\SendNotification as Notify;
use Hash;

class UserController extends Controller
{
	public function register(Request $request)
	{
		$validated = $request->validate(
			[
				'first_name' 		=> 'required',				
				'email' 				=> 'required',
				'password' 			=> 'required|min:6',
				'password_confirm' => 'required|same:password',
				'user_role'			=> 'required',
				'phone_number'	=> 'required|min:10|max:10',
				'telegram_link'	=> 'required_if:user_role,==,2',
			],
			[
				'telegram_link.required_if' 			=> 'The telegram link is required when user type is Publishers!',
			]
		);

		$user = new  User();

    $user->first_name = $request->get('first_name');
    $user->last_name = $request->get('last_name');
    $user->email = $request->get('email');
    $user->password = Hash::make($request->get('password'));
    $user->user_role = $request->get('user_role');
    $user->telegram_link = $request->get('telegram_link');
    $user->phone_number = $request->get('phone_number');
    $user->user_status = 0;
    $user->save();

    $userid = $user->id;
    $token = time();

    $registrationToken = new  RegistrationToken();
    $registrationToken->user_id = $userid;
    $registrationToken->token = $token;
    $registrationToken->save();
    // if (null !== $request->file('pdf_path')) $file = $request->file('pdf_path');

    // if (isset($file) && $file->isValid()) {
    //     $this->uploadPDF($Appraisal, $request->pdf_path);
    // }

		$details = [
			'name' => $request->get('first_name'),
			'email' => $request->get('email'),	
			'usertoken' => 'http://localhost/banner-project/public/verify-email/'.$token,
		];

     (new Notify())->toMail($details);
   

    return redirect()->back()->with('message', 'User Register Please verify your email!');

	}

	public function verify_email($token){

		$checktoken = RegistrationToken::Where('token',$token)->first();
		if(!empty($checktoken)){
				$id = $checktoken->id;
				$user_id = $checktoken->user_id;
				$registrationtoken = RegistrationToken::find($id);
				$registrationtoken->save();

				$user = User::find($user_id);
				$user->user_status = 1;
				$user->save();

			return redirect()->route('login')->with('message', 'Account Activate');;
		}

	}
 
    
}
