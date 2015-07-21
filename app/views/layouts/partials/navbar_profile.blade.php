
<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
  <div class="navbar-header">
        
      <div class="col-sm-12 col-md-12">        
         <a class="navbar-brand" rel="home" href="#" style="padding: 0;">
          <div style="display: inline-block;">
            @if(file_exists('img/users/'.$currentUser->email.'/avatar_small.jpg'))            
               {{ HTML::image('img/users/'.$currentUser->email.'/avatar_small.jpg','avatar',  array('class' => 'avatar')) }}
            @else
             {{ HTML::image('img/blank_small.jpg','avatar',  array('class' => 'avatar')) }}
            @endif

          {{ $currentUser->username }} 
          </div>
        </a>        
      </div>
       
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
  </div>

  <div class="collapse navbar-collapse">  
    <div class="col-sm-2 col-md-2 pull-right">
            <ul class="nav navbar-nav">
            <li class="dropdown">
             <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog"></i> <b class="caret"></b></a>
              <ul class="dropdown-menu">
                  <li><a href="#">Settings</a></li> 
                  <li><a href="#" data-toggle="modal" data-target=".change-dp-modal">Change DP</a></li>                     
                  <li class="divider"></li>                 
              </ul>
            </li>
            <li>
               <a href="{{ URL::to('logout') }}" <i class="fa fa-power-off"></i> </a>
            </li>        
        </ul>       
    </div>   
   
              {{-- Search Input    --}}

      <div class="col-sm-3 col-md-3 pull-right">
            <form class="navbar-form" role="search" style="margin-bottom: 0; margin-top: 5px;">
              <div class="input-group">
                  <input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term" style="height: 40px;line-height: : 0px;;">
                  <div class="input-group-btn">
                      <button class="btn btn-primary" type="submit"><i class="glyphicon glyphicon-search"></i></button>
                  </div>
              </div>
            </form>
      </div>

       {{--   Friend Request Button  --}}

       {{--  <div class="col-sm-2 col-md-2 pull-right">
             <ul class="nav navbar-nav" style="float:right;">
                  
               <li class="dropdown"> 
                 @if($freq == '0')              
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <span class="badge freq" style="background-color:rgb(255, 102, 102); display:none;"> </span><i class="fa fa-users"></i>
                    </a>
                    <ul class="dropdown-menu">
                      <li style="padding:5px;">No new requests</li>                  
                      <li class="divider"></li>                 
                    </ul>
                
                 @else
                  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                      <span class="badge freq" style="background-color:rgb(255, 102, 102);">{{ $freq }} </span><i class="fa fa-users" style="color: #e72c2c"></i>
                  </a>
                  <ul class="dropdown-menu">
                    @foreach($senders as $req)
                      <li>
                        <div class="freq-panel">                       
                          <a href="#">
                           {{ HTML::image('img/users/'.$req->getUser($req->sender_id)->email.'/avatar.jpg','avatar',  array('class' => 'avatar')) }}
                            {{ $req->getUser($req->sender_id)->personalInfo->firstname }}  {{ $req->getUser($req->sender_id)->personalInfo->lastname }}
                          </a>
                         <button type="button" class="btn btn-success" id="addFriend" ng-click="">Accept</button>
                          <button type="button" class="btn btn-danger" id="addFriend" ng-click="">Decline</button>
                        </div>  
                      </li> 
                      <li class="divider"></li> 
                    @endforeach                
                  </ul>

                 @endif
                </li>
                <li><a href="#"><i class="fa fa-bell"></i></a></li> 
            </ul>
        </div>  --}}

  </div>
</nav>


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