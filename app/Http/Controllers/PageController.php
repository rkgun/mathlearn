<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Page;
use App\Models\Course;
use App\Models\Setting;
use Illuminate\Support\Str;
use App\Models\Meta;
class PageController extends Controller
{
    public function view($slug='index'){
        visitor()->visit(); 
        $data['page']=Page::where('slug',$slug)->first();
        $data['settings']=Setting::list();
        $data['courses']=Course::active();
        if($data['page']==null){
            $data['page']=Page::where('slug','error')->first();
        }
        return view('visitor.views.page',$data);  
    }
    public function list(){
        $data['pages']=Page::all();
        $data['set']=Setting::list();
        return view('admin.views.page.list',$data);
    }
    public function delete($id){
        $page=Page::where('id',$id)->first();
        if($page!==null && !$page->locked){
            foreach($page->meta as $meta){
                $meta->delete();
            }
            $page->delete();
        }
        return redirect()->back();
    }
    public function read($id){
        $data['page']=Page::where('id',$id)->first();
        $data['set']=Setting::list();
        return view('admin.views.page.view',$data);
    }
    public function update($id,Request $request){
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'meta-title' => 'required',
                'meta-desc' => 'required',
                'meta-keys' => 'required',
            ],
            [
                'name.required'=> 'Sayfa ismi gerekli!',
                'name.max:255'=> 'Sayfa ismi 255 karakterden az olmalı!',
                'active.required'=> 'Sayfa aktiflik durumu gerekli!',
                'meta-title.required'=> 'Meta başlığı boş olmamalı!',
                'meta-desc.required'=> 'Meta açıklaması boş olmamalı!',
                'meta-keys.required'=> 'Meta kelimeler boş olmamalı!',
            ]
        );
        if($request->hasFile('image')){
            $validate=$request->validate(['image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048']);
            $name = $request->file('image')->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $request->file('image')->move($destinationPath,$name);
            $path='images/'.$name;
        }else{
            $path=null;
        }

        $page=Page::where('id',$id)->first();
        $page->name=$request->input('name');
        $page->slug=($page->locked ? $page->slug : Str::slug($request->input('name')));
        
        $page->active=($request->has('active') ? true : false);

        $page->parallax_content=$request->input('parallax-editor');
        $page->parallax_path=($path==null ? $page->parallax_path : $path);
        $page->content=$request->input('content-editor');
        $page->save();
        
        $page->meta->where('name','title')->first()->update(['value'=>$request->input('meta-title')]);
        $page->meta->where('name','description')->first()->update(['value'=>$request->input('meta-desc')]);
        $page->meta->where('name','keywords')->first()->update(['value'=>$request->input('meta-keys')]);

        return redirect()->back();
    }
    public function create(){
        $data['set']=Setting::list();
        return view('admin.views.page.create',$data);
    }

    public function store(Request $request){
        $validated = $request->validate(
            [
                'name' => 'required|max:255',
                'meta-title' => 'required',
                'meta-desc' => 'required',
                'meta-keys' => 'required',
                'image'=>'required'
            ],
            [
                'name.required'=> 'Sayfa ismi gerekli!',
                'image.required'=> 'Sayfa parallax resmi gerekli!',
                'name.max:255'=> 'Sayfa ismi 255 karakterden az olmalı!',
                'active.required'=> 'Sayfa aktiflik durumu gerekli!',
                'meta-title.required'=> 'Meta başlığı boş olmamalı!',
                'meta-desc.required'=> 'Meta açıklaması boş olmamalı!',
                'meta-keys.required'=> 'Meta kelimeler boş olmamalı!',
            ]
        );
        
        $validate=$request->validate(['image' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048']);
        $name = $request->file('image')->getClientOriginalName();
        $destinationPath = public_path().'/images' ;
        $request->file('image')->move($destinationPath,$name);
        $path='images/'.$name;
        

        $page=new Page;
        $page->name=$request->input('name');
        $page->slug=Str::slug($request->input('name'));
        
        $page->active=($request->has('active') ? true : false);

        $page->parallax_content=$request->input('parallax-editor');
        $page->parallax_path= $path;
        $page->content=$request->input('content-editor');
        $page->save();
        
        $meta = new Meta;
        $meta->name='title';
        $meta->value=$request->input('meta-title');
        $meta->metable_type='page';
        $meta->metable_id=$page->id;
        $meta->save();

        $meta = new Meta;
        $meta->name='description';
        $meta->value=$request->input('meta-desc');
        $meta->metable_type='page';
        $meta->metable_id=$page->id;
        $meta->save();

        $meta = new Meta;
        $meta->name='keywords';
        $meta->value=$request->input('meta-keys');
        $meta->metable_type='page';
        $meta->metable_id=$page->id;
        $meta->save();

        return redirect()->back();
    }
}
