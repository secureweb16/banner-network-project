<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JewelryType;
use Illuminate\Support\Facades\Redirect;

class JewelryTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $jewelryTypes = JewelryType::all();
        return view('admin.jewelry-type.index',compact('jewelryTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.jewelry-type.create');
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
            'name' => 'required|unique:jewelry_types',
        ]);

        $JewelryType = new  JewelryType();
        $JewelryType->name = $request->get('name');
        $JewelryType->save();

        return redirect()->route('admin.jewelry-type.index')->with('message', 'Jewelry type created!');;
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
        $jewelryType = JewelryType::findOrFail($id);
        return view('admin.jewelry-type.edit',compact('jewelryType'));
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
        ]);

        $JewelryType = JewelryType::find($id);
        $JewelryType->name = $request->get('name');
        $JewelryType->save();

        return redirect()->route('admin.jewelry-type.index')->with('message', 'Jewelry type updated!');;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $JewelryType = JewelryType::findOrFail($id);
        $JewelryType->delete();
        return redirect()->route('admin.jewelry-type.index')->with('message', 'Jewelry type deleted!');
    }


    public function trashJewelry(){  

        $jewelryTypes = JewelryType::onlyTrashed()->get();     
        return view('admin.jewelry-type.trash',compact('jewelryTypes'));        
    }

    public function restoreJewelry($id)
    {
        JewelryType::withTrashed()->find($id)->restore();
        return Redirect::back()->with('message', 'Restore Successfully!');
    }
}
