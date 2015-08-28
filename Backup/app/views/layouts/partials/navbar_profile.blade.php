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
      <a class="navbar-brand" href="index.html">Cliqoid</a>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-right">
        <li><a href="/">Home</a></li>
        @if (Auth::guest())
        <li><a href="/">Register</a></li>
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
  
  {{-- <button type="button" id="left-sidebar-notify" class="navbar-toggle toggle-left" data-toggle="offcanvas" data-recalc="false" data-target=".navmenu" data-canvas=".canvas">
  @if(  getFriendRequests()->count()  )
  
  <span class="icon-bar icon-bar-notify" ></span>
  <span class="icon-bar icon-bar-notify"></span>
  <span class="icon-bar icon-bar-notify"></span>
  
  @else
  
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  <span class="icon-bar"></span>
  
  @endif
  </button> --}}
  
  <div class="container">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      </button>
      
      <div class="col-sm-12 col-md-12 nav-left-header">
        <a class="navbar-brand" rel="home" href="/" style="padding: 0;">
          <div style="display: inline-block;">
            @if($currentUser)
            @if(file_exists('img/users/'.$currentUser->email.'/avatar_small.jpg'))
            {{ HTML::image('img/users/'.$currentUser->email.'/avatar_small.jpg','avatar',  array('class' => 'avatar')) }}
            @else
            {{ HTML::image('img/blank_small.jpg','avatar',  array('class' => 'avatar')) }}
            @endif
            <span class="userinfo_name">
              {{ $currentUser->userinfo->firstname }} {{ $currentUser->userinfo->lastname }}
            </span>
            <span class="user_nav_status">
              @if(getLatestStatus()) {{ getLatestStatus()->body }} @endif
            </span>
            @else
            Alias
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
{{-- SideBar --}}
<div class="navmenu navmenu-default navmenu-fixed-left" style="top: 50px;">
  
  <ul class="nav navmenu-nav">
    <li style="padding-top: 10px;">
      <div class="row">
        <div class="col-md-12">
          
          <ul class="nav navbar-nav">
            <li>
              <a href="#"><i class="fa fa-bell"></i></a>
            </li>

            <li class="dropdown">
              @if(  getFriendRequests()->count()  )

              <span class="badge freq badge-freq" style="background-color:rgb(255, 102, 102);">{{ getFriendRequests()->count() }} </span>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="cursor: pointer;" >
                <i class="fa fa-users fa-users-freq" style="color: #FF6666"></i>
              </a>
             
              <ul class="dropdown-menu total-friend-requests" style="width: 245px;">
                <div class="friend-requests-append">
                  @foreach( getFriendRequests() as $req)
                  <div class="friend-request-{{ $req->sender_id }}">
                    <li>
                      <div class="freq-panel ">
                        @if(file_exists('img/users/'.getUserObject($req->sender_id)->email.'/avatar_small.jpg'))
                        {{ HTML::image('img/users/'.getUserObject($req->sender_id)->email.'/avatar_small.jpg','avatar',  array('class' => 'avatar_small')) }}
                        @else
                        {{ HTML::image('img/blank_small.jpg','avatar',  array('class' => 'avatar_small')) }}
                        @endif
                        
                        {{ getUserObject($req->sender_id)->info->firstname }} {{ getUserObject($req->sender_id)->info->lastname }}
                        
                        <div class="new-friend-request-info">
                          {{ getUserObject($req->sender_id)->info->gender }}
                          
                          <div class="accept-reject-friend-button ">
                            <div class="replace-friends-button-{{ $req->sender_id }}">
                              {{ Form::open(['route' => 'respond_to_friend_request', 'id' => 'respondToFriendRequest']) }}
                              <button type="submit" class="btn btn-success btn-xs respond-friend-request" id="1-{{ $req->sender_id }}">
                              <span class="glyphicon glyphicon-ok-sign" aria-hidden="true"></span>
                              </button>
                              <button type="submit" class="btn btn-danger btn-xs respond-friend-request" id="0-{{ $req->sender_id }}">
                              <span class="glyphicon glyphicon-remove-sign" aria-hidden="true"></span>
                              </button>
                              {{ Form::close() }}
                            </div>
                          </div>
                          
                        </div>
                        
                      </div>
                    </li>
                    <li class="divider"></li>
                  </div>
                  @endforeach
                </div>
              </ul><!-- /.total-friend-requests -->

              @else

              <span class="badge freq badge-freq" style="background-color:rgb(255, 102, 102);"></span>
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <i class="fa fa-users fa-users-freq"></i>
            </a>
            <ul class="dropdown-menu">
              <div class="friend-requests-append">
              </div>
              <li style="padding:5px;">No new requests</li>
              <li class="divider"></li>
            </ul>
            @endif


          </li> <!-- /.dropdown -->


        </ul><!-- /.nav navbar-nav -->
      </div><!-- /.col-md-12 -->
    </div><!-- /.row -->
  </li>
  <li>
    
    <div class="row">
      <div class="col-md-12">
        
        {{ Form::open(['route' => 'statuses_path', 'id' => 'postStatus']) }}
        <!-- Status Field -->
        
        <div class="publishStatusArea">
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('shareStatus', 'Share Your Status...') }}
              {{ Form::textarea('body',null, ['class' => 'form-control status-body',  'rows' => '2', 'cols' => '80', 'placeholder'=> 'Share What you are doing...']) }}
              {{ $errors->first('body', '<span class="error">:message</span>') }}
            </div>
            <!-- Post Status Field -->
            <div class="col-md-offset-8">
              <div class="postStatusBtnArea">
                <button type="submit" class="btn btn-primary btn-xs" id="postStatusBtn">
                Post</button>
                
              </div>
            </div>
            
          </div>
        </div>
        
        {{ Form::close() }}
        
        
      </div>
    </div>
  </li>
  <li>
    <div class="row">
      <div class="col-md-12">
        {{ Form::open(['route' => 'sendFriendEmailRequest', 'id' => 'sendFriendEmailRequest']) }}
        <div class="addFriendArea">
          <div class="form-group">
            <input type="textbox" style="display: none;" id="userEmail" value="{{ $currentUser->email }}"/>
            <div class="col-md-12">
              {{ Form::label('addFriend', 'Send a Friend Request...') }}
              {{ Form::email('email', null, ['class' => 'form-control add-friend-email', 'required' => 'required','placeholder'=> 'Friend\'s email address']) }}
              {{ $errors->first('body', '<span class="error">:message</span>') }}
            </div>
            <div class="col-md-offset-8">
              <div class="postStatusBtnArea">
                <button type="submit" class="btn btn-primary btn-xs"
                id="addFriendsEmail">
                Send
                </button>
              </div>
            </div>
          </div>
        </div>
        {{ Form::close() }}
      </div>
    </div>
  </li>
  {{-- FRIEND LIST --}}
  <li>
    <div class="row">
      <div class="col-md-12">
        <div class="myFriendsArea">
          <div class="form-group">
            <div class="col-md-12">
              <label> Friends: &nbsp; <span class="count-total-friends-sidebar">  {{ count(getMyFriends()) }} </span> </label>
            </div>
            <div class="col-md-12 total-friends-list-sidebar" style="position: relative; top:-15px;">
              @foreach( getMyFriends() as $friend)
              <div class="my-friends-list-sidebar">
                {{ HTML::image(checkUserAvatar($friend->email,'small'),'avatar',  array('class' => 'avatar_tiny img-circle')) }}
                <a href="{{ URL::to('/'.$friend->username ) }}">
                  {{ $friend->info->firstname.' '.$friend->info->lastname }}
                </a>
              </div>
              @endforeach
            </div>
          </div>
        </div>
      </div>
    </div>
  </li>
  {{-- RECENT UPDATES --}}
  <li>
    <div class="row">
      <div class="col-md-12">
        <div class="NavRecentUpdates" style="position : relative; top: 80px;">
          <div class="form-group">
            <div class="col-md-12">
              {{ Form::label('', 'Recent Updates: (last one hour) &nbsp; ') }}
            </div>
            <?php  $updates = getMyFriendsUpdatesRecent();  ?>
            @if(sizeof($updates) == 0)
            <div class="col-md-6 col-md-offset-3 sidebar-no-updates"> No Updates </div>
            @else
            <div class="col-md-12 news-items-sidebar">
              @foreach( $updates as $update)
              <?php  $user = getUser($update->user_id); ?>
              @if(checkFriendship(Auth::user()->id, $user->id))
              <div class="sidebar-news-update">
                {{-- STATUS --}}
                @if($update->type="status")
                {{ HTML::image(checkUserAvatar($user->email,'small'),'avatar',  array('class' => 'avatar_tiny img-circle')) }}
                <a href="{{ URL::to('/'.$user->username ) }}">
                  {{ $user->info['firstname'].' '.$user->info['lastname'] }}
                </a>
                <small style="float:right;"> {{ $update->created_at->diffForHumans() }} </small>
                <div class=" col-md-offset-2 recent-updates-body-sidebar">
                  @if(strlen(getStatusById($update->post_id)->body) > 90 )
                  {{ substr(getStatusById($update->post_id)->body, 0, 90) }}... <small>Click to See More</small>
                  @else
                  {{ getStatusById($update->post_id)->body }}
                  @endif
                </div>
                <hr style="height:1px;">
                @endif
                {{ $updates->links() }}
              </div>
              @endif
              @endforeach
            </div>
            @endif
          </div>
        </div>
      </div>
    </div>
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
    </div><!-- /.modal -->
    @endif