<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use App\Models\Course;
use App\Models\Contact;

class ContactController extends Controller
{
    //
    public function index(){
        visitor()->visit();
        $data['settings']=Setting::list();
        $data['courses']=Course::active();
        return view('visitor.views.contact',$data);
    }

    public function store(Request $request) {
        // Form validation
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $message=new Contact([
            'name' =>$request->get('name'),
            'email'=>$request->get('email'),
            'message'=>$request->get('message'),
            'contact_ip' => $request->visitor()->ip()
        ]);
        $message->save();
        return back()->with('success', 'Mesajını aldık. Kısa bir inceleme sonucunda en kısa sürede sana dönüş yapacağız.');
    }

    public function list(){
        $data['contacts']=Contact::list();
        $data['set']=Setting::list();
        return view('admin.views.contact.list',$data);
    }
    public function view($id){
        $data['contact']=Contact::read($id);
        $data['set']=Setting::list();
        return view('admin.views.contact.read',$data);
    }
    public function answered($id){
        $contact=Contact::where('id',$id)->first();
        $contact->answered=true;
        $contact->save();
        return redirect()->route('contact.list');
    }
}
