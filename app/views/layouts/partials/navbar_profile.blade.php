

@if(!$currentUser)

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    

           <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html">WasdBox</a>
                </div>

                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/">Home</a></li>
                         @if (Auth::guest())
                            <li><a href="/register">Register</a></li>
                            <li><a href="/login">Login</a></li>
                         @else
                            <li>{{ link_to_profile() }}</li>
                            <li><a href="/logout">Logout</a></li>
                         @endif

                    </ul>
                </div>
          </div>
</nav>



     

@else

<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">

         <button type="button" class="navbar-toggle toggle-left" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
                      <span class="icon-bar"></span>
          </button>
    
          <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                
                <div class="col-sm-12 col-md-12">        
                     <a class="navbar-brand" rel="home" href="#" style="padding: 0;">
                       <div style="display: inline-block;">
                              @if($currentUser)
                                    @if(file_exists('img/users/'.$currentUser->email.'/avatar_small.jpg'))            
                                       {{ HTML::image('img/users/'.$currentUser->email.'/avatar_small.jpg','avatar',  array('class' => 'avatar')) }}
                                    @else
                                     {{ HTML::image('img/blank_small.jpg','avatar',  array('class' => 'avatar')) }}
                                    @endif
                                  {{ $currentUser->username }} 
                              @else
                                Wasdbox
                              @endif                           
                        </div>
                      </a>        
                  </div>

            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav navbar-right">

                     <li>
                        <form class="navbar-form" role="search" style="margin-bottom: 0; margin-top: 5px;">
                              <div class="input-group">
                                  <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" style="height: 40px;line-height: : 0px;;">
                                  <div class="input-group-btn">
                                      <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                                  </div>
                              </div>
                        </form>  
                     </li>   

                    <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <b class="caret"></b></a>
                              <ul class="dropdown-menu">
                                  <li><a href="#">Settings</a></li> 
                                  <li><a href="#" data-toggle="modal" data-target=".change-dp-modal">Change DP</a></li>                     
                                  <li class="divider"></li>                 
                              </ul>
                    </li>

                    <li> <a href="{{ URL::to('logout') }}" <i class="fa fa-power-off"></i></a></li>  
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
</nav>

<div class="navmenu navmenu-default navmenu-fixed-left" style="z-index : 0; top: 50px;">
      <a class="navmenu-brand" href="#">Project name</a>
      <ul class="nav navmenu-nav">
        <li><a href="../navmenu/">Slide in</a></li>
        <li><a href="../navmenu-push/">Push</a></li>
        <li class="active"><a href="./">Reveal</a></li>
        <li><a href="../navbar-offcanvas/">Off canvas navbar</a></li>
      </ul>
      <ul class="nav navmenu-nav">
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li><a href="#">Link</a></li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
          <ul class="dropdown-menu navmenu-nav">
            <li><a href="#">Action</a></li>
            <li><a href="#">Another action</a></li>
            <li><a href="#">Something else here</a></li>
            <li class="divider"></li>
            <li class="dropdown-header">Nav header</li>
            <li><a href="#">Separated link</a></li>
            <li><a href="#">One more separated link</a></li>
          </ul>
        </li>
      </ul>
</div>



<div class="modal fade change-dp-modal" role="dialog" aria-labelledby="gridSystemModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="gridSystemModalLabel">Change Your Profile Picture...</h4>
      </div>
      <div class="modal-body" >
        <div class="container-fluid" data-provides="fileinput">
          <div class="row">
            <div class="col-md-4 col-md-offset-4 fileinput-preview thumbnail" data-trigger="fileinput"> 
                  @if(file_exists('img/users/'.$currentUser->email.'/avatar_med.jpg'))            
                     {{ HTML::image('img/users/'.$currentUser->email.'/avatar_med.jpg','avatar') }}
                  @else
                   {{ HTML::image('img/blank_med.jpg','avatar') }}
                  @endif
                  
            </div>            
          </div>
          <div class="row">
                  <div class="col-md-4 col-md-offset-4">
                     {{ Form::open(array('url' => 'profile/uploadAvatar', 'files' => true, 'id'=>'uploadAvatar')) }}                  
                     <input type="text" name="user" class="hidden" value="{{ $currentUser->email }}"/> 
                     {{ Form::file('avatar', array('id' => 'choose-avatar', 'class'=> 'hidden')) }}
                    
                     <label for="choose-avatar">
                        <span class="choose-avatar-btn btn btn-primary fileinput-new" style="width :155px;"> Choose a Picture </span>
                     </label>
                  </div>
                
          </div>  
        </div>
      </div>
      <div class="modal-footer">
      <button type="submit" class="btn btn-primary" id="uploadAvatar-btn"><span class="uploadAvatar-btn-text"> Upload </span></button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>        
      </div>
      {{ Form::close() }}
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

@endif


