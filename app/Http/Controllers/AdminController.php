<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\View\Middleware\ErrorBinder;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\AdminController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Log;
use Auth;

class AdminController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    

  
    public function loginform()
   {
        return view('admin/admin_login');
   }

    public function checklogin(Request $request)
   {
        $e =$request->email;
       $p =$request->password;
       $remember_token=$request->_token;
        
       /*$users = array('myemail'=>$e,'mypassword'=>$p,'remember_token'=>$remember_token);
        
        if(Auth::attempt($users))
        {
          return redirect('profile');
        }
        else
         { return redirect('login')->with('error',' :Pleaseee provide valid email and password');
         }
       */
          $results = DB::select('select count(*) c 
                         from admin 
                         where ((email = ?) && (password = ?)  )', 
                         array($e,$p)
                         );
          //print_r(($results[0]->c));
          if(($results[0]->c)>0)
          {
            return redirect('admin_profile');
          }
          else
          {
            return redirect('admin_login')->with('error',' :Pleaseee provide valid email and password');
          }
   }

    public function getprofile()
   {
        return view('admin/admin_profile');
   }

    public function logout()
   {
        Auth::logout();
        return redirect('admin_login');
   }

public function backfunction()
{
    return redirect('/admin'); // redirect the user to the login screen
}



}
