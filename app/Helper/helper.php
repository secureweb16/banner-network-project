<?php

use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\UserCompany;

if(!function_exists('GetUserName')){
	
	function GetUserName() {
		$userData = User::where('id',session()->get('user_id'))->first();
		return $userData;
	}

}

