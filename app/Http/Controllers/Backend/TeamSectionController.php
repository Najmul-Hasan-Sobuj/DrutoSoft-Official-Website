<?php

namespace App\Http\Controllers\Backend;

use Helper;
use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TeamSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['teams'] = Team::get(); 
        return view('Backend.Team.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Backend.Team.create');
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
            'skills'      => 'required',
            'designation' => 'required',
            'facebook'    => 'required',
            'linkedin'    => 'required',
            'twitter'     => 'required',
            'github'      => 'required',
            'image'       => 'required',
        ]);

        if ($validation->passes()) {
            $mainFile = $request->image;
           $globalFunImg=  Helper::imageUpload($mainFile);

           if ($globalFunImg['status'] == 1) {
               Team::create([
                   'name'        => $request->name,
                   'skills'      => $request->skills,
                   'designation' => $request->designation,
                   'facebook'    => $request->facebook,
                   'linkedin'    => $request->linkedin,
                   'twitter'     => $request->twitter,
                   'github'      => $request->github,
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
        $data['teams'] = Team::find($id); 
        return view('Backend.Team.view', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['teams'] = Team::find($id); 
        return view('Backend.Team.update', $data);
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
            'skills'      => 'required',
            'designation' => 'required',
            'facebook'    => 'required',
            'linkedin'    => 'required',
            'twitter'     => 'required',
            'github'      => 'required',
            // 'image'       => 'required',
        ]);

        if ($validation->passes()) {
            $insertData = [
                'name'        => $request->name,
                   'skills'      => $request->skills,
                   'designation' => $request->designation,
                   'facebook'    => $request->facebook,
                   'linkedin'    => $request->linkedin,
                   'twitter'     => $request->twitter,
                   'github'      => $request->github,
                //    'image'       => $globalFunImg['filaName'],
            ];

            $teamInfo = Team::find($id);
            if (isset($request->image) && $teamInfo->image != $request->image) {
                $mainFile = $request->image;
                $globalFunImg=  Helper::imageUpload($mainFile);
                
                if ($globalFunImg['status'] == 1) {
                    File::delete(public_path('uploads/').$teamInfo->image);
                    File::delete(public_path('uploads/thumb/').$teamInfo->image);

                    $insertData['image'] = $globalFunImg['filaName'];
                    $teamInfo->update($insertData);
                    Toastr::success('Post update successfully');
                    return redirect()->back(); 
                } else {
                    Toastr::warning('File extention not matching');
                    return redirect()->back();  
               }
            } else {
                $teamInfo->update($insertData);
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
        Team::find($id)->delete();
    }
}
