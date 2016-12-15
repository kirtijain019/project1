<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\View\Middleware\ErrorBinder;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Log;
use Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function signupform()
    {
        return view('signup_form');
    }

     public function signme(Request $request )
    {
      $first_name = $request->first_name;
      $last_name = $request->last_name;
      $email = $request->email;
      $password = $request->password;
      $remember_token= $request->_token;
      $date = date('Y-m-d H:i:s');
     
      $validator = Validator::make(array(
                                           'first_name' =>  $request->first_name,
                                           'last_name' =>  $request->last_name,
                                           'email' =>  $request->email,
                                           'password' =>  $request->password,
                                           'c_password' =>  $request->c_password 
                                         ),
                                   array(
                                           'first_name' => 'required',
                                           'last_name' => 'required',
                                           'email' => 'required | email',
                                           'password' => 'required',
                                           'c_password' => 'required | same:password'         
                                        )
                                   );

      if($validator->fails())
      {
            return redirect('signup')->withErrors($validator)->withInput();
      }
      else
      {
           echo "hello this is fine";
           $data=array('name'=>$first_name.' '.$last_name,
                      'email' =>$email,
                      'password'  =>$password,
                       'remember_token' =>$remember_token,
                       'created_at' => $date,
                       'updated_at' => $date
                      );

           if(DB::table('users')->insert($data))
           {
               return redirect('signup')->with('success','successfully sign');
              
           }
           else
           {
               return redirect('signup')->with('error','failed');
           }

      }        
        
   }

  
    public function loginform()
   {
        return view('login');
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
                         from users 
                         where ((email = ?) && (password = ?)  )', 
                         array($e,$p)
                         );
          //print_r(($results[0]->c));
          if(($results[0]->c)>0)
          {
            return redirect('user_profile');
          }
          else
          {
            return redirect('login')->with('error',' :Pleaseee provide valid email and password');
          }
   }

    public function getprofile()
   {
        return view('user_profile');
   }

    public function logout()
   {
        Auth::logout();
        return redirect()->intended('login');
   }

public function backfunction()
{
    return redirect('/'); // redirect the user to the login screen
}



}
