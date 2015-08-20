top nav -->
<div class="navbar navbar-blue navbar-static-top">
    <div class="navbar-header">
        <button class="navbar-toggle" type="button" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        </button>
        <a href="/" class="navbar-brand logo">b</a>
    </div>
    <nav class="collapse navbar-collapse" role="navigation">
        <form class="navbar-form navbar-left">
            <div class="input-group input-group-sm" style="max-width:360px;">
                <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">
                <div class="input-group-btn">
                    <button class="btn btn-default" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                </div>
            </div>
        </form>
        <ul class="nav navbar-nav">
            <li>
                <a href="#"><i class="glyphicon glyphicon-home"></i> Home</a>
            </li>
            <li>
                <a href="#postModal" role="button" data-toggle="modal"><i class="glyphicon glyphicon-plus"></i> Post</a>
            </li>
            <li>
                <a href="#"><span class="badge">badge</span></a>
            </li>
        </ul>
        <ul class="nav navbar-nav navbar-right left-10">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="glyphicon glyphicon-user"></i></a>
                <ul class="dropdown-menu">
                    <li><a href="#"><i class="fa fa-cog"> Settings </i> </a></li> 
                    <li>
                      <a href="#" data-toggle="modal" data-target=".change-dp-modal">
                         @if(file_exists('img/users/'.$currentUser->email.'/avatar_small.jpg'))            
                           {{ HTML::image('img/users/'.$currentUser->email.'/avatar_small.jpg','avatar',  array('class' => 'avatar_tiny')) }}
                         @else
                           {{ HTML::image('img/blank_small.jpg','avatar',  array('class' => 'avatar_tiny')) }}
                         @endif
                         Change DP
                       </a>
                    </li>

                    <li class="divider"></li> 
                    <li> <a href="{{ URL::to('logout') }}"> <i class="fa fa-power-off"> Sign out </i></a></li> 
                    
                </ul>
            </li>
        </ul>
    </nav>
</div>
<!-- /top nav -->



                  {{-- MODAL WINDOW FOR PROFILE PICTURE --}}



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
                     {{ Form::open(array('route' => 'profile_picture', 'files' => true, 'id'=>'uploadAvatar')) }} 
                     {{ Form::file('avatar', array('id' => 'choose-avatar', 'class'=> 'hidden')) }}
                    
                     <label for="choose-avatar">
                        <span class="choose-avatar-btn btn btn-primary fileinput-new" style="width :155px;"> Choose a Picture </span>
                     </label>
                     

                     <a href="#" class="btn btn-primary fileinput-exists" style="width :155px;" data-dismiss="fileinput">Remove</a>

                     <div id="progressbox" style="display: none;"><div id="progressbar"></div ><div id="statustxt">0%</div></div>

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
</div><!-- /.modal