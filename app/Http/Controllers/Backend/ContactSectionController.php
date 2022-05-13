<?php

namespace App\Http\Controllers\Backend;

use Helper;
use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Validator;

class ContactSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['contacts'] = Contact::get(); 
        return view('Backend.Contact.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Contact.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'        => 'required',
            'email'       => 'required',
            'description' => 'required',
        ]);

        if ($validation->passes()) {
               Contact::create([
                   'name'        => $request->name,
                   'email'       => $request->email,
                   'description' => $request->description,
               ]);
               Toastr::success('Post added successfully');
               return redirect()->back();
        }else {
            $messages = $validation->messages();
            foreach ($messages->all() as $message)
            {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
            return redirect()->back()->withErrors($validation);
        }
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
        $data['contacts'] = Contact::find($id); 
        return view('Backend.Contact.update', $data);
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
        $validation = Validator::make($request->all(), [
            'name'        => 'required',
            'email'       => 'required',
            'description' => 'required',
        ]);

        if ($validation->passes()) {
            $insertData = [
                'name'        => $request->name,
                'email'       => $request->email,
                'description' => $request->description,
            ];

            $contactInfo = Contact::find($id);
            $contactInfo->update($insertData);
            Toastr::success('Post update successfully');
            return redirect()->back(); 
        }else {
            $messages = $validation->messages();
            foreach ($messages->all() as $message)
            {
                Toastr::error($message, 'Failed', ['timeOut' => 10000]);
            }
            return redirect()->back()->withErrors($validation);
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
        Contact::find($id)->delete();
    }
}
