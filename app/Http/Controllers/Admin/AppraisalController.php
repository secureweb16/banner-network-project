<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use Webpatser\Uuid\Uuid;
use URL;
use App\Models\Appraisal;
use App\Models\User;
use App\Models\Company;
use App\Models\JewelryType;
use App\Models\UserCompany;
use App\Models\Pdfs;
use App\Mail\AppraisalStatus as Email;
use App\Notifications\SendNotification as Notify;



class AppraisalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appraisals = Appraisal::all();
        return view('admin.appraisals.index', compact('appraisals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        // print_r((string)Uuid::generate());exit;

        $users = User::select('id', 'name', 'email')->whereRaw('user_role = "2"')->get();
        $jewelryTypes = JewelryType::all();
        $companies = Company::all();
        return view('admin.appraisals.create', compact('users', 'jewelryTypes', 'companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'appraisal_no' => 'required_if:status,==,2|max:30',
                'company_id' => 'required',
                'jewelry_type' => 'required',
                'description' => 'nullable|min:4|max:100',
                'owner_name' => 'nullable|min:4|max:40',
                'owner_address' => 'nullable|min:4|max:400',
                'status' => 'required',
                'pdf_path' => 'required_if:status,==,2|mimes:doc,docx,pdf',
            ],
            [
                'pdf_path.required_if' => 'The pdf path field is required when status is completed!',
                'appraisal_no.required_if' => 'The appraisal no field is required when status is completed!',
            ]
        );


        $Appraisal = new  Appraisal();
        $Appraisal->appraisal_no = $request->get('appraisal_no');
        $Appraisal->company_id = $request->get('company_id');
        $Appraisal->jewelry_type = $request->get('jewelry_type');
        $Appraisal->description = $request->get('description');
        $Appraisal->owner_name = $request->get('owner_name');
        $Appraisal->owner_address = $request->get('owner_address');
        $Appraisal->status = $request->get('status');
        $book = $request->all();

        $Appraisal->save();

        if (null !== $request->file('pdf_path')) $file = $request->file('pdf_path');

        if (isset($file) && $file->isValid()) {
            $this->uploadPDF($Appraisal, $request->pdf_path);
        }

        $this->notifyStatus($Appraisal->id, $Appraisal->company_id, true, $Appraisal->status);

        return redirect()->route('admin.appraisals.index')->with('message', 'Appraisal created!');;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $appraisal = Appraisal::findOrFail($id);
        $companies = Company::all();
        $jewelryTypes = JewelryType::all();
        return view('admin.appraisals.edit', compact('appraisal', 'companies', 'jewelryTypes'));
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
        $validated = $request->validate(
            [
                'appraisal_no' => 'max:30',
                'company_id' => 'required',
                'jewelry_type' => 'required',
                'status' => 'required',
                'pdf_path' => 'required_if:status,==,2|mimes:doc,docx,pdf',
            ],
            [
                'pdf_path.required_if' => 'The pdf path field is required when status is completed!',
                'appraisal_no.required_if' => 'The appraisal no field is required when status is completed!',
            ]
        );

        $Appraisal = Appraisal::find($id);
        $old_status = $Appraisal->status;

        $Appraisal->appraisal_no = $request->get('appraisal_no');
        $Appraisal->company_id = $request->get('company_id');
        $Appraisal->jewelry_type = $request->get('jewelry_type');
        $Appraisal->description = $request->get('description');
        $Appraisal->owner_name = $request->get('owner_name');
        $Appraisal->owner_address = $request->get('owner_address');
        $Appraisal->status = $request->get('status');
        $Appraisal->save();

        if (null !== $request->file('pdf_path')) $file = $request->file('pdf_path');

        if (isset($file) && $file->isValid()) {
            $this->uploadPDF($Appraisal, $request->pdf_path);
        }

        $this->notifyStatus($Appraisal->id, $Appraisal->company_id, false, $old_status, $Appraisal->status);


        return redirect()->route('admin.appraisals.index')->with('message', 'Appraisal updated!');;
    }

    public function notifyStatus($appraisal_id, $company_id, $is_new, ...$args)
    {
        if ($is_new) {
            if ($args[0] != 0) {
                if ($args[0] === '1') {
                    $this->loopUsers($company_id, 'in progress', null);
                } else {
                    $pdf = Pdfs::where('appraisal_id', $appraisal_id)->first();
                    $this->loopUsers($company_id, 'complete', $pdf->uuid);
                }
            }

            return;
        } else {
            if ($args[1] != 0 && $args[1] != $args[0]) {
                if ($args[1] === '1') {
                    $this->loopUsers($company_id, 'in progress', null);
                } else {
                    $pdf = Pdfs::where('appraisal_id', $appraisal_id)->first();
                    $this->loopUsers($company_id, 'complete', $pdf->uuid);
                }
            }
        }

        return;
    }

    public function loopUsers($company_id, $status, ...$args)
    {
        $users = Company::find($company_id)->users()->get();

        foreach ($users as $user) {
            $details = [
                'name' => $user->name,
                'email' => $user->email,
                'phonenum' => $user->mobile_phone,
                'status' => $status,
                'uuid' => $args[0] ? $args[0] : null
            ];

            if ($user->notification_preference == 'Email') {
                (new Notify())->toMailAppraisal($details);
            } elseif ($user->notification_preference == 'Sms') {
                (new Notify())->toSmsAppraisal($details);
            } else {
                (new Notify())->toMailAppraisal($details);
                (new Notify())->toSmsAppraisal($details);
            }
        }
    }

    public function uploadPDF($Appraisal, $pdf_path)
    {
        $name = uniqid() . '-' . $pdf_path->getClientOriginalName();
        $path = "//pdf/" . $Appraisal->company_id;
        $pdf_path->storeAs($path, $name);
        if (Pdfs::where('appraisal_id', $Appraisal->id)->count() != 0) {
            $pdf = Pdfs::where('appraisal_id', $Appraisal->id)->first();
            $pdf->pdf_path = $path . '/' . $name;
            $pdf->save();
        } else {
            $Pdfs =  new Pdfs();
            $Pdfs->uuid =  (string)Uuid::generate();
            $Pdfs->appraisal_id  =  $Appraisal->id;
            $Pdfs->pdf_path  =  $path . '/' . $name;
            $Pdfs->save();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $Appraisal = Appraisal::findOrFail($id);
        $Appraisal->delete();
        return redirect()->route('admin.appraisals.index')->with('message', 'Appraisal deleted!');
    }

    /**
     * Download the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($uuid)
    {

        $pdf = Pdfs::where('uuid', $uuid)->firstOrFail();
        $pathToFile = storage_path('app' . $pdf->pdf_path);
        // $str = str_replace('/', '\\', $pathToFile);
        return response()->download($pathToFile);
    }


    public function trashAppraisals(){  

        $appraisals = Appraisal::onlyTrashed()->get();     
        return view('admin.appraisals.trash',compact('appraisals'));        
    }

    public function restoreAppraisals($id)
    {
        Appraisal::withTrashed()->find($id)->restore();
        return Redirect::back()->with('message', 'Restore Successfully!');
    }

}
