<?php

namespace App\Http\Controllers\Backend;

use Helper;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class WorkSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['works'] = Work::get(); 
        return view('Backend.Work.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Work.create');
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
            'link'        => 'required',
        ]);

        if ($validation->passes()) {
            $mainFile = $request->image;
           $globalFunImg=  Helper::imageUpload($mainFile);

           if ($globalFunImg['status'] == 1) {
               Work::create([
                   'title'       => $request->title,
                   'description' => $request->description,
                   'image'       => $globalFunImg['filaName'],
                   'link'        => $request->link,
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
        $data['works'] = Work::find($id); 
        return view('Backend.Work.update', $data);
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
            'link'        => 'required',
        ]);

        if ($validation->passes()) {
            $insertData = [
                'title'       => $request->title,
                'description' => $request->description,
                'link'        => $request->link,
            ];

            $workInfo = Work::find($id);
            if (isset($request->image) && $workInfo->image != $request->image) {
                $mainFile = $request->image;
                $globalFunImg=  Helper::imageUpload($mainFile);
                
                if ($globalFunImg['status'] == 1) {
                    File::delete(public_path('uploads/').$workInfo->image);
                    File::delete(public_path('uploads/thumb/').$workInfo->image);

                    $insertData['image'] = $globalFunImg['filaName'];
                    $workInfo->update($insertData);
                    Toastr::success('Post update successfully');
                    return redirect()->back(); 
                } else {
                    Toastr::warning('File extention not matching');
                    return redirect()->back();  
               }
            } else {
                $workInfo->update($insertData);
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
        Work::find($id)->delete();
    }
}
