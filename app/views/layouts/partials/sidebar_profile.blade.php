<ul class="nav">
    <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
</ul>

<ul class="nav hidden-xs" id="lg-menu">
    <li class="active">
        <div class="profile-pic-sidebar">
          
            <a href="{{ URL::to('/'.$user->username ) }}">
            {{ HTML::image(checkUserAvatar($user->email,'med'),'avatar',  array('class' => 'avatar_sidebar avatar_filter')) }}
            </a> 

            <div class="status-sidebar" style="margin:auto;">
            	{{ $user->info->firstname }} {{ $user->info->lastname }} <br/>
            	@ {{ $user->username }}
            </div>        

             <div class="status-sidebar avatar_sidebar" style="padding-top: 10px;">
               <span class="user_nav_status">
                 @if(getUserStatus($user)) {{ getUserStatus($user)->body }} @endif
               </span>  
             </div>
           
        </div>


    </li>
    

    @if($currentUser)
                               
                <li>                  
                  @if(isPending($user->id,$currentUser->id))
                  <button type="submit" class="btn btn-primary btn-xs avatar_sidebar"
                                  id="sendFriendRequest" disabled>
                                  <span  id="AddFriendSpanButton"> Friend Request Sent</span>
                                  </button>
                   @else

                    @if( (!checkFriendship($user->id,$currentUser->id)) && ($user->id != $currentUser->id) ) 

                   <input type="text" id="userEmail" value="{{ $user->email }}" style="display:none;"/>
                    <button type="submit" class="btn btn-primary btn-xs avatar_sidebar"
                                  id="sendFriendRequest">
                                  <span  id="AddFriendSpanButton"> Add Friend </span>
                                  </button>
                    @else

                     <button type="submit" class="btn btn-primary btn-xs avatar_sidebar" disabled>
                     Friends Since {{ getFriendshipDate($user->id) }}
                     </button>

                   @endif 
                @endif



                </li>
                @endif
            


 </ul>