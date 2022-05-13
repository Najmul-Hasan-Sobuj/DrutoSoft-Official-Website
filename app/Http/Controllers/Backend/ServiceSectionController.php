<?php

namespace App\Http\Controllers\Backend;

use Helper;
use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class ServiceSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['services'] = Service::get(); 
        return view('Backend.Service.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Service.create');
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
            'title'       => 'required',
            'image'       => 'required',
            'description' => 'required',
        ]);

        if ($validation->passes()) {
            $mainFile = $request->image;
           $globalFunImg=  Helper::imageUpload($mainFile);

           if ($globalFunImg['status'] == 1) {
               Service::create([
                   'title'       => $request->title,
                   'description' => $request->description,
                   'image'       => $globalFunImg['filaName'],
               ]);
               Toastr::success('Post added successfully');
               return redirect()->back();  
           }else {
               Toastr::warning('File extention not matching');
                return redirect()->back();
           }
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
        $data['services'] = Service::find($id); 
        return view('Backend.Service.update', $data);
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
            'title'       => 'required',
            // 'image'    => 'required',
            'description' => 'required',
        ]);

        if ($validation->passes()) {
            $insertData = [
                'title'       => $request->title,
                'description' => $request->description,
            ];

            $serviceInfo = Service::find($id);
            if (isset($request->image) && $serviceInfo->image != $request->image) {
                $mainFile = $request->image;
                $globalFunImg=  Helper::imageUpload($mainFile);
                
                if ($globalFunImg['status'] == 1) {
                    File::delete(public_path('uploads/').$serviceInfo->image);
                    File::delete(public_path('uploads/thumb/').$serviceInfo->image);

                    $insertData['image'] = $globalFunImg['filaName'];
                    $serviceInfo->update($insertData);
                    Toastr::success('Post update successfully');
                    return redirect()->back(); 
                } else {
                    Toastr::warning('File extention not matching');
                    return redirect()->back();  
               }
            } else {
                $serviceInfo->update($insertData);
                Toastr::success('Post update successfully');
                return redirect()->back(); 
            }
            
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
        Service::find($id)->delete();
    }
}
