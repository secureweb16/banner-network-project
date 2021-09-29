<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\Controller as Controller;
use Auth;
use Webpatser\Uuid\Uuid;
use App\Models\Appraisal;
use App\Models\User;
use App\Models\Pdfs;


class HomeController extends Controller
{

    private $data;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        if (!empty(Auth::user())) {

            if (Auth::user()->user_role == '1') {
                return redirect('/admin/dashboard');
            } elseif (Auth::user()->user_role == '2') {
                return redirect('/publisher/dashboard');
            }elseif (Auth::user()->user_role == '3') {
                return redirect('/advertiser/dashboard');
            }
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }

    /**
     * Download the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($uuid)
    {
        if (!empty(Auth::user())) {

            $pdf = Pdfs::where('uuid', $uuid)->firstOrFail();
            $this->data = $pdf;
            // print_r($pdf->appriasal->user->company->company_id);exit;
            if (Auth::user()->user_role == '2') {
                $user = User::findOrFail(Auth::user()->id);
                if ($pdf->appraisal->company_id == Auth::user()->company_id) {
                    return $this->downloadPdf();
                }
            } elseif (Auth::user()->user_role == '1') {
                return $this->downloadPdf();
            } else {
                abort(404);
            }
        }

        abort(404);
    }



    protected function downloadPdf()
    {
        $pdf = $this->data;
        $pathToFile = storage_path('app' . $pdf->pdf_path);
        // $str = str_replace('/', '\\', $pathToFile);
        return response()->file($pathToFile);
    }
}
