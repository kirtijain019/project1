<h1>SIGNUP FORM</h1>
<div class="signup-form">
   
   @if (count($errors) > 0)
     error aa gayi bhyii!!
      <div class='alert alert-danger'>
        <strong>Whoops!</strong> There were some problems with your input.<br><br>

            <ul>
                @foreach ( $errors->all() as $error )
                     <li>{{ $error }}</li>
                @endforeach
            </ul>  
      </div>
   @endif

 

  @if(Session::has('success'))
   
    successful
    
  @endif
   
 @if(Session::has('error'))
    
    error aa gaya
    
 @endif
 
        {!! Form::open(array('url'=>'user_signme')) !!}

        {!! Form::text('first_name','',array('class'=>'formtext','id'=>'first_name','placeholder'=>'First name')) !!}
        {!! Form::text('last_name','',array('class'=>'formtext','id'=>'last_name','placeholder'=>'Last name')) !!}
        {!! Form::text('email','',array('class'=>'formtext','id'=>'email','placeholder'=>'Email address')) !!}
        {!! Form::password('password','',array('class'=>'formtext','id'=>'pass','placeholder'=>'Password')) !!}
        {!! Form::password('c_password','',array('class'=>'formtext','id'=>'cpass','placeholder'=>'Confirm password')) !!}
        {!! Form::submit('submit') !!}



        {!! Form::close() !!}

         {!! Html::link('user_back','HOME PAGE') !!}
</div>
