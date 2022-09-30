<?php

namespace App\Http\Controllers\Home;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function Contact(){
        return view('frontend.contact');
    }//end methode

    public function StoreContact(Request $request){
        Contact::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'phone' => $request->phone,
            'message' => $request->message,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Your message sent Successfully', 
            'alert-type' => 'success'
        );
       
        return redirect()->back()->with($notification);
    }//end methode

    public function ContactMessage(){
        $contacts = Contact::latest()->get();
        return view('admin.contact.contact_all',compact('contacts'));
    }//end methode

    public function DeleteContact($id){
        Contact::find($id)->delete();
        $notification = array(
            'message' => 'Your message deleted Successfully', 
            'alert-type' => 'success'
        );
       
        return redirect()->back()->with($notification);
    }//end methode

    public function ShowMessage($id){
        $message = Contact::findOrFail($id);
        return view('admin.contact.contact_show_message',compact('message'));
    }
}
