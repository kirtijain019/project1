<?php

namespace App\Http\Controllers;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\View\Middleware\ErrorBinder;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Http\Controllers\UserController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use DB;
use Log;
use Auth;

class UserController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function signupform()
    {
        return view('user/signup_form');
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
            return redirect('user_signup')->withErrors($validator)->withInput();
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
               return redirect('user_signup')->with('success','successfully sign');
              
           }
           else
           {
               return redirect('user_signup')->with('error','failed');
           }

      }        
        
   }

  
    public function loginform()
   {
        return view('user/user_login');
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
            return redirect('user_login')->with('error',' :Pleaseee provide valid email and password');
          }
   }

    public function getprofile()
   {
        return view('user/user_profile');
   }

    public function logout()
   {
        Auth::logout();
        return redirect('user_login');
   }

public function backfunction()
{
    return redirect('/user'); // redirect the user to the login screen
}

 public function checkgrade(Request $request)
   {  

            $answer1 = $request->question-1-answers;
            $answer2 = $request->question-2-answers;
            $answer3 = $request->question-3-answers;
            $answer4 = $request->question-4-answers;
            $answer5 = $request->question-5-answers;
        
            $totalCorrect = 0;
            
            if ($answer1 == "B") { $totalCorrect++; }
            if ($answer2 == "A") { $totalCorrect++; }
            if ($answer3 == "C") { $totalCorrect++; }
            if ($answer4 == "D") { $totalCorrect++; }
            if ($answer5) { $totalCorrect++; }
            
            $results=$totalCorrect / 5;
            print_r(($results));
            //echo "<div id='results'>$totalCorrect / 5 correct</div>";
        

}
}