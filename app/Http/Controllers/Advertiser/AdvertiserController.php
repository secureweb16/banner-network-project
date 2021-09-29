<?php

namespace App\Http\Controllers\Advertiser;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdvertiserController extends Controller
{
	public function index()
	{
		return view('advertiser.dashboard');
	}
}
