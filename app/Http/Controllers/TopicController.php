<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Course;
use App\Models\Topic;
use App\Models\Meta;
use App\Models\Setting;
use Illuminate\Support\Str;

class TopicController extends Controller
{
    //
    public function index($slug){
        visitor()->visit();
        $data['topic']=Topic::where('slug',$slug)->first();
        $data['courses']=Course::active();
        $data['settings']=Setting::list();
        if($data['topic']==null){
            return redirect('/error');
        }
        return view('visitor.views.topic',$data);
    }

    public function questions($slug){
        $data['topic']=Topic::where('slug',$slug)->first();
        $data['courses']=Course::active();
        $data['settings']=Setting::list();
        return view('visitor.views.subpages.questions',$data);
        visitor()->visit();
    }

    public function view($id){
        $data['topic']=Topic::where('id',$id)->first();
        $data['set']=Setting::list();
        $data['topics']=Topic::where('course_id',$data['topic']->course_id)->get(['id','title']);
        return view('admin.views.topic.view',$data);
    }

    public function update($id,Request $request){

        $validated = $request->validate(
            [
                'title' => 'required|max:255',
                'meta-title' => 'required',
                'meta-desc' => 'required',
                'meta-keys' => 'required'
            ],
            [
                'title.required'=> 'Konu ismi gerekli!',
                'title.max:255'=> 'Konu ismi 255 karakterden az olmalı!',
                'meta-title.required'=> 'Meta başlığı boş olmamalı!',
                'meta-desc.required'=> 'Meta açıklaması boş olmamalı!',
                'meta-keys.required'=> 'Meta kelimeler boş olmamalı!',
            ]
        );

        $topic=Topic::where('id',$id)->first();
        $topic->title=$request->input('title');
        $topic->parent_id=$request->input('parent-title');
        $topic->content=$request->input('editor');
        $topic->active=($request->has('active') ? true : false);
        $topic->slug=Str::slug($request->input('title'));
        $topic->save();

        $topic->meta->where('name','title')->first()->update(['value'=>$request->input('meta-title')]);
        $topic->meta->where('name','description')->first()->update(['value'=>$request->input('meta-desc')]);
        $topic->meta->where('name','keywords')->first()->update(['value'=>$request->input('meta-keys')]);

        return redirect()->back();
    }

    public function list(){
        $data['topics']=Topic::nonDeleted();
        $data['set']=Setting::list();
        return view('admin.views.topic.list',$data);
    }
    
    public function delete($id){
        $data['topic']=Topic::where('id',$id)->first();
        foreach($data['topic']->childs as $topic){
                $topic->deleted=true;
                $topic->save();
        }
        $data['topic']->deleted=true;
        $data['topic']->save();
        return redirect()->route('topic.list');
    }

    public function courseWithTopic($id){
        $course=Course::find($id);
        $topics=array();
        foreach($course->topics as $topic){
            $topics[$topic['id']]=$topic['title'];
        }  
        print_r(json_encode($topics));
    }

    public function create(){
        $data['courses']=Course::all();
        $data['topics']=Topic::all();
        $data['set']=Setting::list();
        return view('admin.views.topic.create',$data);
    }
    public function store(Request $request){
        print($request->input('editor'));
        $validated = $request->validate(
            [
                'title' => 'required|max:255|unique:topics',
                'editor' => 'required|min:200',
                'course_id' => 'required',
                'meta-title' => 'required',
                'meta-desc' => 'required',
                'meta-keys' => 'required'
            ],
            [
                'title.required'=> 'Konu ismi gerekli!',
                'editor.required'=> 'Konu içeriği yeterli değil :((',
                'title.unique'=> 'Konu ismi özgün olmalı! Benzer isimde bir ders daha var.',
                'title.max:255'=> 'Konu ismi 255 karakterden az olmalı!',
                'course_id.required'=> 'Konu hangi derse ait? Lütfen bir ders seç.',
                'active.required'=> 'Konu aktiflik durumu gerekli!',
                'meta-title.required'=> 'Meta başlığı boş olmamalı!',
                'meta-desc.required'=> 'Meta açıklaması boş olmamalı!',
                'meta-keys.required'=> 'Meta kelimeler boş olmamalı!',
            ]
        );
        $topic = new Topic;
        $topic->title = $request->input('title');
        $topic->content= $request->input('editor');
        $topic->slug = Str::slug($request->input('title'));
        $topic->active = ($request->has('active') ? true : false);
        $topic->course_id= $request->input('course_id');
        $topic->parent_id= $request->input('parent_id');
        $topic->save();

        $meta = new Meta;

        $meta->name='title';
        $meta->value=$request->input('meta-title');
        $meta->metable_type='topic';
        $meta->metable_id=$topic->id;
        $meta->save();

        $meta = new Meta;
        $meta->name='description';
        $meta->value=$request->input('meta-desc');
        $meta->metable_type='topic';
        $meta->metable_id=$topic->id;
        $meta->save();

        $meta = new Meta;
        $meta->name='keywords';
        $meta->value=$request->input('meta-keys');
        $meta->metable_type='topic';
        $meta->metable_id=$topic->id;
        $meta->save();

        return redirect()->back();
    }
}
