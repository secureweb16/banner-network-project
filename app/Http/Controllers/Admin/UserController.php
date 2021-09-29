<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use App\Mail\UserEmail as Email;
use URL;
use App\Models\Company;
use App\Models\UserCompany;
use App\Notifications\SendNotification as Notify;
use DB;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $users = User::whereRaw('user_role = "2"')->get(); 
        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::select('id','name')->get();        
        return view('admin.user.create',compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',  
            'company_id' => 'required',
            'notification_preference' => 'required',
        ]);
        
        $chars = "0123456789bcdfghjkmnpqrstvwxyzBCDFGHJKLMNPQRSTVWXYZ";
        $password = substr(str_shuffle($chars),0,10);

        $user               = new  User();
        $user->name         = $request->get('name');
        $user->email        = $request->get('email');
        $user->password     = Hash::make($password);
        $user->mobile_phone = $request->get('phoneNumber');
        $user->notification_preference = $request->get('notification_preference');       
        $user->save();        
        
        $usercompany            = new  UserCompany();
        $usercompany->user_id   = $user->id;
        $usercompany->company_id = $request->get('company_id');
        $usercompany->save();
        

        $details = [            
            'name' => $request->get('name'),
            'email' => $request->get('email'),
            'phonenum' => $request->get('phoneNumber'),
            'password' => $password,
            'loginurl' => URL::to('/login'),
        ];

        /*\Mail::to($request->get('email'))->send(new Email($details));*/

        if($request->get('notification_preference') == 'Email'){
            (new Notify())->toMail($details);     
        }else if($request->get('notification_preference') == 'Sms' && !empty($request->get('phoneNumber'))) {
            (new Notify())->toSms($details);
        }else if($request->get('notification_preference') == 'Both' && !empty($request->get('phoneNumber')) && !empty($request->get('phoneNumber'))){
            (new Notify())->toMail($details);
            (new Notify())->toSms($details);
        }
       

        return redirect()->route('admin.users.index')->with('message', 'User created!'); 
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(['company'])->findOrFail(decrypt($id));

        $companies = Company::all();      
        return view('admin.user.edit',compact('user','companies'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,'.decrypt($id),            
            'notification_preference' => 'required',
            'company_id' => 'required',
        ]);

        $user = User::find(decrypt($id));        
        $user->name         = $request->get('name');
        $user->email        = $request->get('email');      
        $user->mobile_phone = $request->get('phoneNumber');        
        $user->notification_preference = $request->get('notification_preference');        
        $user->save();

        $usercompany =  UserCompany::where('user_id',decrypt($id))->firstOrFail();
        $usercompany->company_id = $request->get('company_id');
        $usercompany->save();

        return redirect()->route('admin.users.index')->with('message', 'User updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail(decrypt($id));
        $user->delete();
        return redirect()->route('admin.users.index')->with('message', 'User deleted!');
    }

    public function trashUsers(){  

        $users = User::onlyTrashed()->get();     
        return view('admin.user.trash',compact('users'));        
    }

    public function restoreUsers($id)
    {
        User::onlyTrashed()->find($id)->restore();
        return Redirect::back()->with('message', 'Restore Successfully!');
    }

    public function usersFilterByCompany(Request $request){
        print_r($request->all());
    }
}

