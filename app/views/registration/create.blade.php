@extends('layouts.index')
    @section('content')
   

     <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!--login modal-->
                         
                           <div class="form-top">
                                <div class="form-top-left">
                                     {{ HTML::image('img/logo.png','Logo',  array('class' => 'logo_small')) }}                                  
                                </div>
                                <div class="form-top-right-text">
                                   <a href="{{ URL::to('/') }}">Login</a>
                                </div>
                            </div>

                            <div class="form-bottom">
                               {{ Form::open(['route' => 'registration.store']) }}
                                <!-- Username Field -->

                                   <div class="col-md-8 col-md-offset-2">
                                    <div class="form-group">

                                      
                                                                            
                                        {{ Form::label('username', 'Username:') }}
                                         <div class="input-group">
                                          <span class="input-group-addon" id="basic-addon1">@</span>
                                             {{ Form::text('username', null, ['class' => 'input-elements form-control', 'required' => 'required','placeholder'=> 'Username', 'aria-describedby'=>'basic-addon1' ]) }}
                                        </div>
                                        {{ $errors->first('username', '<div class="alert alert-danger" role="alert"> <i class="fa fa-exclamation-circle"> </i> <span class="error">:message</span></div>') }}   
                                      </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                         <!-- Name Field -->
                                    <div class="form-group">


                                      <div class="col-md-6">
                                         {{ Form::label('firstname', 'Firstname:') }}
                                        {{ Form::text('firstname', null, ['class' => 'input-elements form-control', 'required' => 'required','placeholder'=> 'Firstname']) }}
                                        {{ $errors->first('firstname', '<div class="alert alert-danger" role="alert"> <i class="fa fa-exclamation-circle"> </i> <span class="error">:message</span></div>') }}   
                                      </div>

                                      <div class="col-md-6">
                                          {{ Form::label('lastname', 'Lastname:') }}
                                        {{ Form::text('lastname', null, ['class' => 'input-elements form-control', 'required' => 'required','placeholder'=> 'Lastname']) }}
                                        {{ $errors->first('lastname', '<div class="alert alert-danger" role="alert"> <i class="fa fa-exclamation-circle"> </i> <span class="error">:message</span></div>') }}    
                                      </div>
                                      </div>  
                                    </div> 
                                    </div>


                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                
                                    <!-- Email Field -->
                                    <div class="form-group">
                                      <div class="col-md-12">

                                          {{ Form::label('email', 'Email:') }}
                                          {{ Form::text('email', null, ['class' => 'input-elements form-control', 'required' => 'required','placeholder'=> 'Email']) }}
                                          {{ $errors->first('email', '<div class="alert alert-danger" role="alert"> <i class="fa fa-exclamation-circle"> </i> <span class="error">:message</span> </div') }}
                                      </div>
                                    </div>
                                    </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                            <!-- Password Field -->
                                          <div class="form-group">
                                            <div class="col-md-6">
                                             {{ Form::label('password', 'Password:') }}
                                                {{ Form::password('password', ['class' => 'input-elements form-control', 'required' => 'required','placeholder'=> 'Password']) }}
                                            </div>

                                            <div class="col-md-6">
                                                 {{ Form::label('password_confirmation', 'Confirm Password:') }}
                                            {{ Form::password('password_confirmation', ['class' => 'input-elements form-control', 'required' => 'required','placeholder'=> 'Confirm Password']) }}
                                            </div> 
                                          </div>
                                        </div>
                                    </div>

                                    <div class="row" style="padding-top: 2px;">
                                      <div class="col-md-8 col-md-offset-2">
                                         <div class="col-md-12">
                                               {{ $errors->first('password', ' <div class="alert alert-danger" role="alert"> <i class="fa fa-exclamation-circle"> </i> <span class="error">:message</span></div>') }}
                                            </div> 
                                      </div>
                                    </div>

                                    <div class="row" style="padding-top: 20px;;">
                                        <div class="col-md-8 col-md-offset-2">

                                         <!-- Password Field -->
                                    <div class="form-group">
                                    <div class="col-md-12">
                                         {{ Form::label('gender', 'Gender:') }}     
                                        &nbsp; {{ Form::radio('gender', 'Male', [ 'class' => 'input-elements form-control', 'required' => 'required' ]) }} Male
                                        &nbsp; {{ Form::radio('gender', 'Female') }} Female                                        
                                    </div>
                                       
                                    </div>
                                            
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-8 col-md-offset-2">
                                         <!-- Create Account Field -->
                                    <div class="form-group">
                                    <div class="col-md-12">
                                         {{ Form::submit('Create Account', ['class' => 'btn btn-primary','style'=>'width:100%;']) }}
                                    </div>
                                       
                                    </div>
                                            
                                        </div>
                                    </div>

                                   
                                
                                   
                                    
                               {{ Form::close() }}
                            </div>
                     </div>                         
                 </div>
             </div>
         </div>     
    </header>


    @stop



