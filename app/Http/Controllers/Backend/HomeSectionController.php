<?php

namespace App\Http\Controllers\Backend;

use App\Models\Home;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class HomeSectionController extends Controller
{
    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $data['homes'] = Home::find(1); 
        return view('Backend.Home.update', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        
        $request->validate([
            'title_one'   => 'required',
            'title_two'   => 'required',
            'description' => 'required',
            'quote'       => 'required',
        ]);


        $homes = Home::find(1);
        $homes_image = $request->file('image');


        if ($homes == null){

            if ($homes_image){
                $homes = new Home();

                $imageName = $homes_image->getClientOriginalName();
                $directory = 'Backend/dist/img/homes/';
                $imageUrl = $directory . $imageName;
                Image::make($homes_image)->resize(512, 512)->save($imageUrl);

                $homes->id = 1;
                $homes->title_1 = $request->title_one;
                $homes->title_2 = $request->title_two;
                $homes->description = $request->description;
                $homes->image = $imageUrl;
                $homes->footer = $request->quote;
                $homes->save();
            }else{
                $homes = new Home();
                $homes->id = 1;
                $homes->title_1 = $request->title_one;
                $homes->title_2 = $request->title_two;
                $homes->description = $request->description;
//                $homes->image = $imageUrl;
                $homes->footer = $request->quote;
                $homes->save();
            }


        }else{
            if ($homes_image){
            File::delete($homes->image);
                $imageName = date('mdYHis') . uniqid() . $homes_image->getClientOriginalName();
                $directory = 'Backend/dist/img/homes/';
                $imageUrl = $directory . $imageName;
                Image::make($homes_image)->resize(512, 512)->save($imageUrl);

//              $homes->id = 1;
                $homes->title_1 = $request->title_one;
                $homes->title_2 = $request->title_two;
                $homes->description = $request->description;
                $homes->image = $imageUrl;
                $homes->footer = $request->quote;
                $homes->save();

            }else{
                $homes->title_1 = $request->title_one;
                $homes->title_2 = $request->title_two;
                $homes->description = $request->description;
//              $homes->image = $imageUrl;
                $homes->footer = $request->quote;
                $homes->save();
            }
        }

        // return redirect()->route('homes.update')->with('message','Home Updated Successfully');
        Toastr::success('Post update successfully');
        return redirect()->back(); 

    }
}