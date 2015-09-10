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
    <div class="col-sm-9">
      
      <div class="well">
        <!-- <form class="form-horizontal" role="form">
          <h4>What's New</h4>
          <div class="form-group" style="padding:14px;">
            <textarea class="form-control" placeholder="Update your status"></textarea>
          </div>
          <button class="btn btn-primary pull-right" type="button">Post</button><ul class="list-inline"><li><a href=""><i class="glyphicon glyphicon-upload"></i></a></li><li><a href=""><i class="glyphicon glyphicon-camera"></i></a></li><li><a href=""><i class="glyphicon glyphicon-map-marker"></i></a></li></ul>
        </form> -->
        <div class="col-md-12 main-content">
          
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
                    <a href="{{ URL::to('/'.$message->user->username ) }}">
                      <img src="{{ checkUserAvatar($message->user->email,'small') }}" class="chat_img img-responsive"/>
                      <div class="tooltip">  </div>
                    </a>
                  </div>
                  <div class="col-md-5 pull-right Area">
                    
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
                  <div class="col-md-5 pull-left Area-left">
                    
                    <div class="col-md-12" style="padding:0px;">
                      <div class="col-md-10 col-md-offset-2 pull-left text-left chat_username">  <p></p>
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
                  <h3>Group Tab</h3>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil commodi quaerat eius ipsam, error necessitatibus unde deleniti facere repellat, recusandae, nesciunt repellendus pariatur sint accusantium excepturi, magni odit expedita ipsa.</p>
                </div>
                <!-- ************************PRIVATE CHAT TAB********************************* -->
                <div id="friends" class="tab-pane fade">
                  <h3>Friends Tab</h3>
                  <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
                </div>
                
              </div>
              
              </div><!--/main-content-->
              
      </div> <!--/well-->
    </div><!--/col-sm-9-->

              <!-- main col right -->
              <div class="col-sm-3">
                <div class="fixed">
                    <!-- ************************SEND FRIEND REQUEST********************************* -->
                  
                  <!-- ************************RECENT UPDATES********************************* -->
                 
                    <section class="sidebar-wrapper" id="sidebar-wrapper">
                       
                      <div id="v-nav">
                          <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#global">
                                 <i class="fa fa-globe fa-2x"> </i></a>
                              </li>           

                              <li><a data-toggle="tab" href="#friends">
                               <i class="fa fa-user fa-2x" style="position: absolute;left: 10px;top: 7px;"></i><i class="fa fa-check" style="position: absolute;top: 28px;left: 21px;"></i></a></li>

                              <li><a data-toggle="tab" href="#groups">
                                <i class="fa fa-users fa-2x"></i></a></li>

                             
                          </ul>
                          
                          <div class="tab-content">
                           <h4>Global</h4>
                              <div class="scrollable">
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                                <p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p><p>sdfsdf</p>
                              </div>
                              
                          </div>
                          
                          <div class="tab-content">
                              <h4>Friends</h4>
                                <div class="scrollable">
                                  @foreach(getMyFriends() as $friend)
                                    <div class="row rightside-inner-div">
                                      <div class="col-md-2 pull-right chat_img_pos" style="padding:0px;">
                                        <a href="{{ URL::to('/'.$friend->username ) }}">
                                          <img src="{{ checkUserAvatar($friend->email,'small') }}" class="chat_img img-responsive"/>
                                          <div class="tooltip">  </div>
                                        </a>
                                      </div>
                                      
                                      <div class="col-md-10 pull-right Area">
                                        
                                        <div class="col-md-12" style="padding:0px;">
                                          <div class="col-md-10 col-md-offset-2 pull-right text-left chat_username">  {{$friend->username}}
                                          </div>
                                          <div class="col-md-8 col-md-offset-4 pull-right text-right chat_time">  
                                          </div>
                                          <div class="col-md-12 pull-left text-center chat_text" style="background-color:#ECF2F5;">
                                            
                                          </div>
                                        </div>
                                      </div>
                                     </div><!--/row-->
                                  @endforeach
                                </div>                       
                          </div>

                          <div class="tab-content">
                            <h4>Groups</h4>
                              <div class="scrollable">
                              </div>
                          </div>
                          
                          <div class="tab-content">
                              <h4>Favs</h4>
                               <div class="scrollable">
                               </div>
                          </div>
                      </div>
                    </section>

                    <div class="well" style="padding:1px; margin-top: 10px;">
                       <span style="font-size: 10px; font-weight:bold;">  Recent Updates</span>
                        <div class="row">                          
                          <div class="col-md-12 full-div">
                            <div class="NavRecentUpdates">                          

                                <?php  $updates = getMyFriendsUpdatesRecent();  ?>
                                @if(!$updates)
                                <div class="col-md-6 col-md-offset-3 sidebar-no-updates">   No Updates 
                                </div>
                                @else

                                 <div class="news-items-sidebar">
                                  @foreach( $updates as $update)
                                   <?php  $user = getUser($update->user_id); ?>
                                    @if(checkFriendship($currentUser->id, $user->id))
                                    

                                            {{-- STATUS --}}
                                      <div class="sidebar-news-update">
                                       <div class="row" style="position:relative;">
                                         @if($update->type="status")

                                          {{-- Profile Picture --}}
                                          <div class=" pull-left chat_img_pos_left" style="padding:0px;position:absolute;left:0px;">
                                             <a href="{{ URL::to('/'.$user->username ) }}">
                                              <img src="{{ checkUserAvatar($user->email,'small') }}" class="chat_img img-responsive" style="width:45px;" />
                                              <div class="tooltip">  </div>
                                            </a>
                                          </div>

                                          <div class="col-md-10 col-md-offset-1 pull-left Area">
                                            <div class="col-md-12" style="padding:0px;">
                                           
                                            {{-- User Name --}}
                                          <div class="col-md-10 col-md-offset-2 pull-left text-left chat_username"> 
                                           {{ $user->info['firstname'].' '.$user->info['lastname'] }} 
                                             @if($user->info['gender'] == "Male")
                                              changed his status
                                             @else
                                             changed her status
                                             @endif
                                           </div>

                                           {{-- Display Time --}}

                                           <div class="col-md-8 col-md-offset-4 pull-left text-left chat_time"> 
                                               {{ $update->created_at->diffForHumans() }}
                                           </div>

                                               {{-- Display Update --}}

                                            <div class="col-md-12 pull-right update_text_sidebar">
                                              @if(strlen(getStatusById($update->post_id)->body) > 90 )
                                                  {{ substr(getStatusById($update->post_id)->body, 0, 90) }}...<small>Click to See More</small>
                                              @else
                                                  {{ getStatusById($update->post_id)->body }}
                                              @endif
                                            </div>
                                         </div><!--/col-md-12-->

                                          </div><!--/Area-left-->



                                         @endif <!--/if update type == status-->
                                         {{ $updates->links() }}
                                      </div><!--/sidebar-news-update-->
                                    </div><!--/row-->
                                    @endif
                                  @endforeach
                                 </div><!--/news-items-sidebar-->  
                                            

                                  
                               
                                @endif <!--/ if !updates -->
                              
                            </div><!--/NavRecentUpdates-->
                          </div><!--/col-md-12-->
                        </div><!--/row-->
                      </div><!--/well-->
                  
                </div><!--/fixed-->
              </div><!--/col-sm-3-->
                  
                  
       </div><!--/row-->                  
   </div><!--/full col-sm-9-->
                  
                  <!-- ************************STATIC FOOTER********************************* -->
                  
                  <div class="navbar navbar-blue-bottom navbar-static-top">
                    <div class="padding-footer">
                      <div class="row">
                        <!-- main col left -->
                        <div class="col-sm-9">
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
                                </div><!-- /.col-md-7 -->
                            </div><!-- /.row -->
                          </div><!-- /.submit-text-area -->
                        </div><!-- /.col-sm-7 -->
                                    <!-- ************************COPYRIGHT************************** -->
                                    <div class="col-sm-3">
                                      <div class="navbar-text pull-right">
                                        <h6 class="text-center">
                                        
                                        </h6>
                                      </div>
                                    </div>
                      </div><!-- /.row -->
                    </div><!-- /.padding-footer -->
                  </div><!-- /.navbar -->
                                    
                                    <!-- ************************  MODAL WINDOW FOR FAVOURITE FRIEND  ************************** -->
                                    <div class="modal fav-modal" id="fav1">
                                      <div class="modal-dialog">
                                        <div class="modal-content">
                                          <select autofocus id="favourite-friend"  placeholder="Type a Friend's name..." class="form-control Friends">
                                          </div>
                                        </div>
                                      </div>


                                      <!-- ************************ EOF  ************************** -->
                                      @stop