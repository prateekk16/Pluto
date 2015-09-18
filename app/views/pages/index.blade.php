@extends('layouts.index')
    @section('content')

	 <header class="intro">
        <div class="intro-body">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2">
                        <!--login modal-->
                         @if($errors) {{ $errors->first() }} @endif
                           <div class="form-top">
                                <div class="form-top-left">
                                     {{ HTML::image('img/logo.png','Logo',  array('class' => 'logo_small')) }}                                  
                                </div>
                                <div class="form-top-right">
                                    <i class="fa fa-lock"></i>
                                </div>
                            </div>
                            <div class="form-bottom">
                               {{ Form::open(['route' => 'login_path']) }}
                                    <div class="form-group">
                                        <label class="sr-only" for="email">Email</label>
                                        <input type="text" name="email" placeholder="Email..." class="form-username form-control" id="form-username">

                                    </div>
                                    <div class="form-group">
                                        <label class="sr-only" for="password">Password</label>
                                        <input type="password" name="password" placeholder="Password..." class="form-password form-control" id="form-password">
                                    </div>
                                    <button type="submit" class="btn">Sign in!</button>
                                {{ Form::close() }}

                                <div class="row" style="padding-top: 20px;">
                                    <div class="com-md-6" style="text-align: center;">
                                        Dont Have an Account? <a href="{{URL::to('/register')}}">Sign Up</a>
                                    </div>
                                </div>
                            </div>
                     </div>                         
                 </div>
             </div>
         </div>     
    </header>


    @stop