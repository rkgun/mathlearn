<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Setting;
use Illuminate\Support\Str;
use Spatie\Sitemap\SitemapGenerator;

class SettingsController extends Controller
{
    //
    public function list(){
        $data['settings']=Setting::all();
        $data['set']=Setting::list();
        return view('admin.views.setting.list',$data);
    }
    public function create(){
        $data['set']=Setting::list();
        return view('admin.views.setting.create',$data);
    }
    public function store(Request $request){
        $validated = $request->validate(
            [
                'name' => 'required|max:255|unique:settings',
                'value' => 'required',
            ],
            [
                'name.required'=> 'Ayar ismi gerekli!',
                'name.unique'=>'Ayar ismi özgün olmalı',
                'value.required'=> 'Ayar için değer gerekli!',
                'name.max:255'=> 'Ayar ismi 255 karakterden az olmalı!',
            ]
        );
        $setting=new Setting;
        $setting->name=$request->input('name');
        $setting->value=$request->input('value');
        $setting->locked=false;
        $setting->save();
        return redirect()->back();
    }
    public function view($id){
        $data['setting']=Setting::where('id',$id)->first();
        $data['set']=Setting::list();
        return view('admin.views.setting.view',$data);
    }
    public function update($id,Request $request){
        $setting=Setting::where('id',$id)->first();
        $setting->name=$setting->name;
        $value=$request->input('value');
        if($setting->name=='logo'){
            $validate=$request->validate(['value' => 'image|mimes:jpg,png,jpeg,gif,svg|max:2048']);
            $name = $request->file('value')->getClientOriginalName();
            $destinationPath = public_path().'/images' ;
            $request->file('value')->move($destinationPath,$name);
            $value='images/'.$name;
        }else if($setting->name=='icon'){
            $ext=$request->file('value')->getClientOriginalExtension();
            if($ext=='ico'){
                $name = $request->file('value')->getClientOriginalName();
                $destinationPath = public_path().'/images' ;
                $request->file('value')->move($destinationPath,$name);
                $value='images/'.$name;
            }else{
                $error='İcon ayarı için bir ico dosyası eklemelisin.';
                return redirect()->back();
            }
        }
        $setting->value=$value;
        $setting->save();
        return redirect('settings/');
    }
    public function delete($id){
        $setting=Setting::where('id',$id)->first();
        if($setting!==null && !$setting->locked){
            $setting->delete();
        }
        return redirect()->back();
    }
    public function sitemap(){
        $setting=Setting::where('name','site_url')->first();

        SitemapGenerator::create($setting->value)->writeToFile(public_path('sitemap.xml'));
        return redirect()->back();
    }
}
