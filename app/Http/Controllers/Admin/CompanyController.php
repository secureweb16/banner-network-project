<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Redirect;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index',compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.company.create');
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
            'name' => 'required|unique:companies',
        ],
        [ 'name.unique' => 'The name has already been taken. Please check trash.']);

        $company = new  Company();
        $company->name = $request->get('name');
        $company->description = $request->get('description');
        $company->save();

        return redirect()->route('admin.companies.index')->with('message', 'Company created!');
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
        $company = Company::findOrFail($id);
        return view('admin.company.edit',compact('company'));
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
            'name' => 'required|unique:companies,name,'.$id,            
        ],[ 'name.unique' => 'The name has already been taken. Please check trash.']);

        $company = Company::find($id);
        $company->name = $request->get('name');
        $company->description = $request->get('description');
        $company->save();

        return redirect()->route('admin.companies.index')->with('message', 'Company updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $company = Company::findOrFail($id);
        $company->delete();
        return redirect()->route('admin.companies.index')->with('message', 'Company deleted!');
    }

    public function trashComapines(){       
        $companies = Company::onlyTrashed()->get();     
        return view('admin.company.trash',compact('companies'));        
    }

    public function restoreComapines($id)
    {
        Company::withTrashed()->find($id)->restore();
        return Redirect::back()->with('message', 'Restore Successfully!');
    }
}
