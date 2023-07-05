<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feedback;
use Intervention\Image\Facades\Image;

class FeedbackController extends Controller
{
    public function AllFeedback(){
        $feedback = Feedback::latest()->get();
        return view('admin.feedback.feedback_all',compact('feedback'));
    }

    public function AddFeedback(){
        return view('admin.feedback.feedback_add');
    }

    public function StoreFeedback(Request $request){
        
        $request->validate([
            'nom' => 'required',
            'message' => 'required',
            'image' => 'required',
        ],[
           
            'nom.required' => 'Le nom est obligatoire !!!',
            'message.required' => 'Le message est obligatoire !!!',
            'image.required' => 'Limage est obligatoire !!!'
        ]);


        if(Feedback::count() >= 7){
            $notification = array
            (
                'message' => 'il ne peux y avoir que 7 Feedback maximum', 
                'alert-type' => 'warning'
            );

            return redirect()->route('all.feedback')->with($notification);

        }

        $images = $request->file('image');
            
        $image_name = hexdec(uniqid()).'.'.$images->getClientOriginalExtension();

        Image::make($images)->resize(120,120)->save('upload/feedback_image/'.$image_name);        
                
        $save_url = 'upload/feedback_image/'.$image_name;    
                
        Feedback::insert([
            'nom' => $request->nom,
            'message' => $request->message,
            'image' => $save_url,
        ]);        
            
        $notification = array(
            'message' => 'Your Feedback Added Successfully', 
            'alert-type' => 'success'
        );
       
        return redirect()->route('all.feedback')->with($notification);
    }

    public function EditFeedback($id){
        $feedback = Feedback::findOrFail($id);
        return view('admin.feedback.feedback_update',compact('feedback'));
    }

    public function UpdateFeedback(Request $request){
        
        $request->validate([
            'nom' => 'required',
            'message' => 'required',
        ],[
            
            'nom.required' => 'Le nom est obligatoire !!!',
            'message.required' => 'Le message est obligatoire !!!',
        ]);

        $feedback_id = $request->id;
        $image = $request->file('image');

        if($image){

            $del_image = Feedback::findOrFail($feedback_id)->image;

            unlink($del_image);

            $name_image = hexdec(uniqid()).'.'.$image->getClientOriginalExtension();
    
            Image::make($image)->resize(120,120)->save('upload/feedback_image/'.$name_image);
            
            $save_url = 'upload/feedback_image/'.$name_image;
            
            Feedback::findOrFail($feedback_id)->update([
                'nom' => $request->nom,
                'message' => $request->message,
                'image' => $save_url,
            ]);
        }
        else{

            Feedback::findOrFail($feedback_id)->update([
                'nom' => $request->nom,
                'message' => $request->message,
            ]);
        }

        $notification = array(
            'message' => 'Feed Back Updated Successfully', 
            'alert-type' => 'success'
        );
        return redirect()->route('all.feedback')->with($notification);
    }

    public function DeleteFeedback($id){

        $feedback = Feedback::findOrFail($id);

        $img = $feedback->image;

        unlink($img);

        Feedback::findOrFail($id)->delete();

        $notification = array(
            'message' => 'FeedBack Deleted Successfully', 
            'alert-type' => 'info'
        );
        return redirect()->back()->with($notification);

    }
}