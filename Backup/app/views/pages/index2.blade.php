@extends('layouts.default')
@section('content')
<!-- content -->

<style>
.selectize-dropdown-content{
       overflow-y: auto;
       max-height: none; 
}

</style>


<div class="full col-sm-9" id="content-holder">

<div class="row">
  
  <!-- main col left -->
  <div class="col-sm-7">    
    
    <div class="well">
      <!-- <form class="form-horizontal" role="form">
        <h4>What's New</h4>
        <div class="form-group" style="padding:14px;">
          <textarea class="form-control" placeholder="Update your status"></textarea>
        </div>
        <button class="btn btn-primary pull-right" type="button">Post</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
      </form> -->
     <div class="col-md-12 main-content">

      <ul class="nav nav-tabs">
        <li class="active"><a data-toggle="tab" href="#global">Global</a></li>
        <li><a data-toggle="tab" href="#groups">Groups</a></li>
        <li><a data-toggle="tab" href="#private">Private</a></li>        
      </ul>

      <div class="tab-content">
        <input type="text" id="decrypt-message" style="display:none;" value="{{URL::to('messages/decrypt-message')}}"/>

   <!-- ************************GLOBAL CHAT TAB********************************* -->

        <div id="global" class="tab-pane fade in active">
          <div class="global-window">
            @if(getGlobalMessages()->count() > 0)
            @foreach(getGlobalMessages() as $message)
            
            @if($message->user->id != $currentUser->id)
            <div class="row">
                 <div class="col-md-1 pull-right chat_img_pos" style="padding:0px;">
                  <a href="{{ URL::to('/'.$currentUser->username ) }}">
                    <img src="{{ checkUserAvatar($currentUser->email,'small') }}" class="chat_img img-responsive"/>
                    <div class="tooltip">  </div>
                  </a>
                 </div>

              <div class="col-md-7 pull-right Area">
                
                <div class="col-md-12" style="padding:0px;">
                  <div class="col-md-10 col-md-offset-2 pull-right text-left chat_username">  {{$message->user->username}}
                  </div>
                   <div class="col-md-8 col-md-offset-4 pull-right text-right chat_time">  {{$message->created_at->diffForHumans()}}
                  </div>
                   <div class="col-md-12 pull-left text-center chat_text">
                     {{ decryptMessage($message->body) }}
                   </div>
                
             
                </div>
               
              </div>

            </div>
            @else
            <div class="row">
              <div class="col-md-1 pull-left chat_img_pos_left" style="padding:0px;">
                  <a href="{{ URL::to('/'.$currentUser->username ) }}">
                    <img src="{{ checkUserAvatar($currentUser->email,'small') }}" class="chat_img img-responsive"/>
                    <div class="tooltip">  </div>
                  </a>
              </div>

              <div class="col-md-7 pull-left Area-left">
                
                <div class="col-md-12" style="padding:0px;">
                  <div class="col-md-10 col-md-offset-2 pull-left text-left chat_username">  Me
                  </div>
                   <div class="col-md-8 col-md-offset-4 pull-left text-left chat_time">  {{$message->created_at->diffForHumans()}}
                  </div>
                   <div class="col-md-12 pull-right text-center chat_text_left">
                     {{ decryptMessage($message->body) }}
                   </div>
                
             
                </div>
               
              </div>
             
            </div>
            @endif
            @endforeach
            @else
            <div class="row">
              <div class="global-inactive col-md-12">
                <p>Hmmm, Global seems to be inactive at the moment...</p>
              </div>
            </div>
            @endif
          </div><!-- /global-window -->

        </div><!-- /global -->


   <!-- ************************GROUP CHAT TAB********************************* -->

                <div id="groups" class="tab-pane fade">
                  <h3>group</h3>
                  <p>how are you</p>
                </div>


   <!-- ************************PRIVATE CHAT TAB********************************* -->

                <div id="private" class="tab-pane fade">
                  <h3>private</h3>
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
                
              </div>
              
            </div><!--/main-content-->
            
           </div> <!--/well-->
     </div><!--/col-sm-7-->
            <!-- main col right -->
     <div class="col-sm-5">
            <div class="fixed">  

    <!-- ************************SEND FRIEND REQUEST********************************* -->

            <div class="well">
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
                          <div class="col-md-offset-9 col-md-3">
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
            </div>

       <!-- ************************RECENT UPDATES********************************* -->
              
              <div class="well" style="max-height: 240px;">
                <div class="row">
                  <div class="col-md-12">
                    <div class="NavRecentUpdates">
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
              </div>

  <!-- ************************FAVOURITE Friends********************************* -->
              
         <div class="well" >
            Favourites
                <div class="row">                                     
                      <ul class="list-inline col-md-12" style="padding-top: 15px;;">
                        <?php  $favs = getMyFavourites(5);  ?>
                         @if(count($favs) !=0)

                          
                         @else                         

                         <li class="col-md-3">
                           <a href="#fav1" data-toggle="modal">
                            <div class="favourite-box">                           
                              <i class="fa fa-plus-square fa-lg" style="position: relative;top: 6px;"></i>                           
                            </div>  
                           </a>                         
                         </li>

                          <li class="col-md-3">
                           <a href="#fav1" data-toggle="modal">
                            <div class="favourite-box">                           
                              <i class="fa fa-plus-square fa-lg" style="position: relative;top: 6px;"></i>                           
                            </div>  
                           </a>                         
                         </li>

                          <li class="col-md-3">
                           <a href="#fav1" data-toggle="modal">
                            <div class="favourite-box">                           
                              <i class="fa fa-plus-square fa-lg" style="position: relative;top: 6px;"></i>                           
                            </div>  
                           </a>                         
                         </li>

                          <li class="col-md-3">
                           <a href="#fav1" data-toggle="modal">
                            <div class="favourite-box">                           
                              <i class="fa fa-plus-square fa-lg" style="position: relative;top: 6px;"></i>                           
                            </div>  
                           </a>                         
                         </li>

                         @endif                        
                      </ul>                 
                </div><!--/row-->
        </div><!--/well-->
              
              </div><!--/col-sm-5-->
            </div>
              
              
              </div><!--/row-->
              
             </div><!--/full col-sm-9-->

              
      <!-- ************************STATIC FOOTER********************************* -->
              
<div class="navbar navbar-blue-bottom navbar-static-top">

  <div class="padding-footer">
    <div class="row">  
      <!-- main col left -->
      <div class="col-sm-7">
          <div class="submit-text-area">
            <div class="row">
              <div class="col-md-2" style="padding-top:10px;">
                <div class="send-global">
                  <i class="fa fa-globe fa-lg"></i>
                </div>
                <div class="send-group" style="display:none;">
                  
                </div>
                <div class="send-private" style="display:none;">
                  
                </div>
                
              </div><!-- /.col-md-2 -->

              <div class="col-md-3" style="padding-top:10px;">
                <a href="#" class="send-attachments"> <i class="fa fa-picture-o fa-lg"></i> </a>
                <a href="#" class="send-attachments"> <i class="fa fa-video-camera fa-lg"></i> </a>
                <a href="#" class="send-attachments"> <i class="fa fa-picture-o fa-lg"></i> </a>

              </div>
              
<!-- ************************SEND MESSAGE BOX********************************* -->
             
              <div class="col-md-7">
                  {{Form::open(['route' => 'messages.storeGlobal', 'id'=>'sendGlobal' ])}}
                  <div class="input-group">
                    <input type="text" name="message" class="form-control global_message_body" placeholder="Type..." required="required">
                    <span class="input-group-btn">
                      {{ Form::submit('Send!', ['class' => 'btn btn-primary form-control global_send_button']) }}
                      {{Form::close()}}                     
                    </span>
                  </div><!-- /input-group -->   
              </div><!-- /.col-lg-6 -->
            </div><!-- /.row -->
          </div><!-- /.submit-text-area -->
      </div><!-- /.col-sm-7 -->


<!-- ************************COPYRIGHT************************** -->

      <div class="col-sm-5">
         <div class="navbar-text pull-right">
           <h6 class="text-center">
                  ©Copyright {{ date('Y') }}                 
                  </h6>
         </div>
      </div>


    </div><!-- /.row -->
  </div><!-- /.padding-footer -->
</div><!-- /.navbar -->              
             

<!-- ************************  MODAL WINDOW FOR FAVOURITE FRIEND  ************************** -->


<div class="modal" id="fav1">
  <div class="modal-dialog">
      <div class="modal-content">      
         <select autofocus id="favourite-friend"  placeholder="Type a Friend's name..." class="form-control">  
      </div>
  </div>
</div>


<!-- ************************ EOF  ************************** -->

@stop