<?php

namespace App\Http\Controllers\Home;
use App\Models\Footer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FooterController extends Controller
{
    public function SetupFooter(){
        $footer = Footer::find(1);
        return view('admin.footer.footer_all',compact('footer'));
    }//end methode

    public function UpdateFooter(Request $request){

        $footer_id = $request->id;
            
        Footer::findOrFail($footer_id)->update([
            'number' => $request->number,
            'short_description' => $request->short_description,
            'adress' => $request->adress,
            'email' => $request->email,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'instagram' => $request->instagram,
            'youtube' => $request->youtube,
            'linkdin' => $request->linkdin,
            'pinterest' => $request->pinterest,
            'copyright' => $request->copyright,
        ]);

        $notification = array(
            'message' => 'Footer Updated Successfully', 
            'alert-type' => 'info'
        );
        
        return redirect()->back()->with($notification);
        
    }
}
