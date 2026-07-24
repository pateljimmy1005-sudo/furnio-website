<?php

namespace App\Http\Controllers;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
     

         public function index()
    {
        $about = About::first();
        return view('about', compact('about'));
    }



    public function edit()
    {
        $about=About::first();
        return view('admin.about_edit', compact('about'));
    }

   public function update(Request $request)
   {
       $about = About::first();

       $about->update([
        'title' => $request->title,
        'description' => $request->description,
       ]);
   return redirect()->back()->with('success', 'About updated successfully');

       }


}
