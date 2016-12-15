<h1>LOGIN FORM</h1>
<div class="login-form">



 @if(Session::has('success'))
   
    successful
    
  @endif
   
 @if(Session::has('error'))
    
    {{Session::get('error')}}
    
 @endif
 


        {!! Form::open(array('url'=>'admin_loginme')) !!}

        
        {!! Form::text('email','',array('class'=>'formtext','id'=>'email','placeholder'=>'Email Id')) !!}
        {!! Form::password('password','',array('class'=>'formtext','id'=>'pass','placeholder'=>'Password')) !!}
       
        {!! Form::submit('login') !!}

        {!! Form::close() !!}


        @if(Auth::check())
        
              the admin is logged in!!!!
        @endif

         {!! Html::link('admin_back','HOME PAGE') !!}
 </div>