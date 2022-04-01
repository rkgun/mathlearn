<?php
namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Models\Visitors;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Contact;
use App\Models\Admin;
use App\Models\Setting;
class AdminController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $data['totalVisitCount']=Visitors::totalVisitCount();
        $data['monthVisitCount']=Visitors::monthVisitCount();
        $data['onlineVisitCount']=Visitors::onlineVisitCount();
        $data['lastVisit']=Visitors::lastVisit();
        $data['topicVisit']=Visitors::topicVisit();
        $data['lastTopics']=Topic::lastTopics();
        $data['courses']=Course::all();
        $data['topics']=Topic::all();
        $data['contact']=Contact::nonDisplayed()->count();
        $data['set']=Setting::list();
        return view('admin.views.home',$data);
    }
}