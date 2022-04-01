<?php
namespace App\Http\Controllers\Auth; 
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use DB; 
use Carbon\Carbon; 
use App\Models\Admin; 
use Mail; 
use Hash;
use Illuminate\Support\Str;
  
class ForgotPasswordController extends Controller
{

      public function getform(){
            return view('admin.views.pass.forget');
      }
  
      public function submitform(Request $request){
          $request->validate([
              'email' => 'required|email|exists:admins',
          ]);
  
          $token = Str::random(64);
  
          DB::table('password_resets')->insert([
              'email' => $request->email, 
              'token' => $token, 
              'created_at' => Carbon::now()
            ]);
  
          Mail::send('admin.views.pass.email', ['token' => $token], function($message) use($request){
              $message->from('mathlearn22@gmail.com', 'MathLearn');
              $message->to($request->email);
              $message->subject('Şifre Sıfırlama İsteği Hk.');
          });
  
          return back()->with('message', 'Şifre sıfırlama isteğin için e-posta adresine bir mail gönderdik. Lütfen kontrol et!!');
      }

      public function getreset($token) { 
            return view('admin.views.pass.forget_link', ['token' => $token]);
      }
  
      public function submitreset(Request $request)
      {
          $request->validate([
              'email' => 'required|email|exists:admins',
              'password' => 'required|string|min:6|confirmed',
              'password_confirmation' => 'required'
          ]);
  
          $updatePassword = DB::table('password_resets')
                              ->where([
                                'email' => $request->email, 
                                'token' => $request->token
                              ])
                              ->first();
  
          if(!$updatePassword){
              return back()->withInput()->with('error', 'Invalid token!');
          }
  
          $admin = Admin::where('email', $request->email)
                      ->update(['password' => Hash::make($request->password)]);
 
          DB::table('password_resets')->where(['email'=> $request->email])->delete();
  
          return redirect('/admin/login')->with('message', 'Şifreni değiştirildi.');
      }
}