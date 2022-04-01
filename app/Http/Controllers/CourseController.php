<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Setting;
use App\Models\Topic;
use App\Models\Meta;
use App\Models\Visitors;
use Illuminate\Support\Str;

class CourseController extends Controller
{
    // page,course,topic için meta lar olacak
    public function index($slug){
        visitor()->visit();
        $data['course']=Course::where('slug', $slug)->first();
        $data['settings']=Setting::list();
        if($data['course']==null || $data['course']->active==false){
            return redirect('/error');
        }
        else if($data['course']->active){
            $data['courses']=Course::active();
            $data['topics']=$data['course']->topics;
            $data['parentTopics'] = $data['topics']->where('parent_id',0);
            $data['metas']=$data['course']->meta;
            return view('visitor.views.course',$data);
        }
    }
    public function list(){
        $data['courses']=Course::where('deleted',false)->get();
        $data['set']=Setting::list();
        return view('admin.views.course.list',$data);
    }
    public function read($id){
        $data['course']=Course::where('id',$id)->first();
        $data['set']=Setting::list();
        $data['visit']=Visitors::courseVisit($data['course']->slug);
        $data['topicVisit']=Visitors::topicVisitCount($data['course']->topics);
        return view('admin.views.course.view',$data);
    }
    public function delete($id){
        $course=Course::where('id',$id)->first();
        $course->deleted=true;
        foreach($course->topics as $topic){
            $topic->deleted=true;
            $topic->save();
        }
        $course->save();
        return redirect()->route('course.list');
    }
    public function update($id,Request $request){

        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'meta-title' => 'required',
                'meta-desc' => 'required',
                'meta-keys' => 'required'
            ],
            [
                'name.required'=> 'Ders ismi gerekli!',
                'name.max:255'=> 'Ders ismi 255 karakterden az olmalı!',
                'active.required'=> 'Ders aktiflik durumu gerekli!',
                'meta-title.required'=> 'Meta başlığı boş olmamalı!',
                'meta-desc.required'=> 'Meta açıklaması boş olmamalı!',
                'meta-keys.required'=> 'Meta kelimeler boş olmamalı!',
            ]
        );

        $course=Course::where('id',$id)->first();
        $course->name=$request->input('name');
        $course->slug=Str::slug($request->input('name'));
        $course->active=($request->has('active') ? true : false);
        $course->save();
        
        $course->meta->where('name','title')->first()->update(['value'=>$request->input('meta-title')]);
        $course->meta->where('name','description')->first()->update(['value'=>$request->input('meta-desc')]);
        $course->meta->where('name','keywords')->first()->update(['value'=>$request->input('meta-keys')]);

        return redirect()->back();
    }
    public function store(Request $request){
        $validated = $request->validate(
            [
                'name' => 'required|max:255|unique:courses',
                'meta-title' => 'required',
                'meta-desc' => 'required',
                'meta-keys' => 'required'
            ],
            [
                'name.required'=> 'Ders ismi gerekli!',
                'name.unique'=> 'Ders ismi özgün olmalı! Benzer isimde bir ders daha var.',
                'name.max:255'=> 'Ders ismi 255 karakterden az olmalı!',
                'active.required'=> 'Ders aktiflik durumu gerekli!',
                'meta-title.required'=> 'Meta başlığı boş olmamalı!',
                'meta-desc.required'=> 'Meta açıklaması boş olmamalı!',
                'meta-keys.required'=> 'Meta kelimeler boş olmamalı!',
            ]
        );
        $course = new Course;
        $course->name = $request->input('name');
        $course->slug = Str::slug($request->input('name'));
        $course->active = ($request->has('active') ? true : false);
        $course->save();

        $meta = new Meta;

        $meta->name='title';
        $meta->value=$request->input('meta-title');
        $meta->metable_type='course';
        $meta->metable_id=$course->id;
        $meta->save();

        $meta = new Meta;
        $meta->name='description';
        $meta->value=$request->input('meta-desc');
        $meta->metable_type='course';
        $meta->metable_id=$course->id;
        $meta->save();

        $meta = new Meta;
        $meta->name='keywords';
        $meta->value=$request->input('meta-keys');
        $meta->metable_type='course';
        $meta->metable_id=$course->id;
        $meta->save();

        return redirect()->back();
    }
}
