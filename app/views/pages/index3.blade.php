@extends('layouts.default')
@section('content')

<style>
.selectize-dropdown-content
{
	overflow-y: auto;
	max-height: none;
}
</style>

<div class="padding-70">

						{{-- CENTER GRID --}}
	<div class="col-sm-8 center-height-85 box-shadow">
		<div class="well custom-center-well">
			<div class="tab-content">
				<!-- ************************GLOBAL CHAT TAB********************************* -->
	            <div id="global" class="tab-pane fade in active">
	              <h5>Global Channel</h5>
	            	<div class="global-window">
	            	   @if(getGlobalMessages(1)->count() > 0)
	            	    @foreach(getGlobalMessages(1) as $message)
	            	     @if($message->user->id == $currentUser->id)
	            	     	{{-- MY MESSAGE --}}	
	            	     	<div class="row">
			                  <div class="col-md-1 pull-right chat_img_pos" style="padding:0px;">
			                  <a href="{{ URL::to('/'.$currentUser->username ) }}">  
			                   <img src="{{ checkUserAvatar($currentUser->email,'small') }}" class="chat_img img-responsive"/>
			                      <div class="tooltip">
			                      </div>
			                    </a>
			                  </div>
			                  <div class="col-md-5 pull-right Area">
			                    <div class="col-md-12" style="padding:0px;">
			                      <div class="col-md-8 pull-right text-right chat_username"> Me
			                      </div>
			                      <div class="col-md-2" style="font-size: 8px;">                        
			                      </div>
			                      <div class="col-md-8 col-md-offset-4 pull-right text-right chat_time">  {{$message->created_at->diffForHumans()}}
			                      </div>
			                      <div class="col-md-12 pull-left text-center chat_text chat_text_right">
			                        {{ decryptMessage($message->body) }}
			                      </div>
			                    </div>
			                  </div>
			                </div>
			             			   {{-- USER MESSAGE --}}
			                @else
			                <div class="row">
			                  <div class="pull-left chat_img_pos_left" style="padding:0px;">
			                     <a href="{{ URL::to('/'.$message->user->username ) }}">
			                      <img src="{{ checkUserAvatar($message->user->email,'small') }}" class="chat_img img-responsive"/>
			                      <div class="tooltip">
			                      </div>
			                    </a>
			                  </div>
			                  <div class="col-md-6 pull-left Area-left">
			                    
			                    <div class="col-md-12" style="padding:0px;">
			                      <div class="col-md-8 pull-left text-left chat_username"> {{$message->user->info->firstname}} {{$message->user->info->lastname}} 
			                      </div>
			                      <div class="col-md-2" style="font-size: 8px;">
			                        {{'@'.$message->user->username}}
			                      </div>
			                      <div class="col-md-8 col-md-offset-1 pull-left text-left chat_time">
			                       {{$message->created_at->diffForHumans()}}
			                      </div>
			                      <div class="col-md-12 pull-right text-center chat_text">
			                        {{ decryptMessage($message->body) }}
			                      </div>
			                    </div>
			                  </div>
			                </div>
			                @endif
			                @endforeach
			                   {{-- NO ACTIVITY --}}
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
                   <h5>My Group Channel</h5>
                   <div class="group-window">

                   </div>
                 
                </div>
                <!-- ************************PRIVATE CHAT TAB********************************* -->
                <div id="friends" class="tab-pane fade">
                  <h5>My Friends Channel</h5>
					<div class="friends-window">
						@if(getGlobalMessages(2)->count() > 0)
	            	    @foreach(getGlobalMessages(2) as $message)
	            	    @if(checkFriendship($currentUser->id,$message->user->id))
	            	     @if(checkIncognitoPost($message))

							<div class="row">								
									 <div class="pull-left chat_img_pos_left" style="padding:0px;">
					                     <i class="fa fa-user-secret fa-2x" style="color:#5A5A5A;"></i>
					                  </div>

					                  <div class="col-md-6 pull-left Area-left" style="background-color: rgba(0, 0, 0, 0.08);">
					                    <div class="col-md-12" style="padding:0px;">
					                      <div class="col-md-8 pull-left text-left chat_username">Unknown
					                      </div>			                      
					                      <div class="col-md-8 col-md-offset-1 pull-left text-left chat_time">
					                       {{$message->created_at->diffForHumans()}}
					                      </div>
					                      <div class="col-md-12 pull-right text-center chat_text" style="border: 1px solid #F3E8E8;">
					                        {{ decryptMessage($message->body) }}
					                      </div>
					                    </div>
					                  </div>								
							 </div>
			             			  
			               @else

			                {{-- Friend MESSAGE --}}
			                <div class="row">
			                  <div class="pull-left chat_img_pos_left" style="padding:0px;">
			                     <a href="{{ URL::to('/'.$message->user->username ) }}">
			                      <img src="{{ checkUserAvatar($message->user->email,'small') }}" class="chat_img img-responsive"/>
			                      <div class="tooltip">
			                      </div>
			                    </a>
			                  </div>
			                  <div class="col-md-6 pull-left Area-left">
			                    
			                    <div class="col-md-12" style="padding:0px;">
			                      <div class="col-md-8 pull-left text-left chat_username"> {{$message->user->info->firstname}} {{$message->user->info->lastname}} 
			                      </div>
			                      <div class="col-md-2" style="font-size: 8px;">
			                        {{'@'.$message->user->username}}
			                      </div>
			                      <div class="col-md-8 col-md-offset-1 pull-left text-left chat_time">
			                       {{$message->created_at->diffForHumans()}}
			                      </div>
			                      <div class="col-md-12 pull-right text-center chat_text">
			                        {{ decryptMessage($message->body) }}
			                      </div>
			                    </div>
			                  </div>
			                </div>

			               @endif
			            @endif <!-- /check if friendship -->

			            @if($message->user->id == $currentUser->id)
			            	{{-- MY MESSAGE --}}
			            	<div class="row">
			                  <div class="col-md-1 pull-right chat_img_pos" style="padding:0px;">
			                  <a href="{{ URL::to('/'.$currentUser->username ) }}">  
			                   <img src="{{ checkUserAvatar($currentUser->email,'small') }}" class="chat_img img-responsive"/>
			                      <div class="tooltip">
			                      </div>
			                    </a>
			                  </div>
			                  <div class="col-md-5 pull-right Area">
			                    <div class="col-md-12" style="padding:0px;">
			                      <div class="col-md-8 pull-right text-right chat_username"> Me
			                      </div>
			                      <div class="col-md-2" style="font-size: 8px;">    
			                        @if(checkIncognitoPost($message))   As incognito   @endif             
			                      </div>
			                      <div class="col-md-8 col-md-offset-4 pull-right text-right chat_time">  {{$message->created_at->diffForHumans()}}
			                      </div>
			                      <div class="col-md-12 pull-left text-center chat_text chat_text_right">
			                        {{ decryptMessage($message->body) }}
			                      </div>
			                    </div>
			                  </div>
			                </div>
			            @endif<!-- /check my message -->
			            @endforeach
			                   {{-- NO ACTIVITY --}}
			                @else
			                <div class="row">
			                  <div class="global-inactive col-md-12">
			                    <p>Hmmm, Global seems to be inactive at the moment...</p>
			                  </div>
			                </div>
			                @endif
					</div><!-- /friends-window -->

                  
                </div>
			</div><!-- /tab-content -->
		</div><!-- /custom-center-well -->
	</div><!-- /center-height-85 -->
	


					{{-- RIGHT GRID --}}
	<div class="col-sm-4 ">
	  	 <div id="v-nav">
	  	 	 <ul class="nav nav-tabs">
                              <li class="active"><a data-toggle="tab" href="#global">
                                 <i class="fa fa-globe fa-2x" style="position: absolute;"> </i></a>
                              </li>           

                              <li><a data-toggle="tab" href="#friends">
                               <i class="fa fa-user fa-2x" style="position: absolute;"></i>
                               <i class="fa fa-check" style="position: absolute;top: 30px;left: 22px;"></i></a></li>

                              <li><a data-toggle="tab" href="#groups">
                                <i class="fa fa-users fa-2x" style="position: absolute;"></i></a></li>

                             
                          </ul><!--/ul nav-tabs-->
	  	 	
	  	 </div>
		
		  <div class="right-fixed">

			 <div class="right-height-55">
			 	<div class="tab-content">
			 		<h4> Global </h4>

			 		<div class="scrollable">
			 			
			 			  <?php  for($i=0;$i<100;$i++){ echo '<p>'.$i.'</p>' ; }  ?>
			 		
			 		</div>
			 	</div>

			 	<div class="tab-content">
			 		<h4> Friends </h4>
			 	</div>

			 	<div class="tab-content">
			 		<h4> Group </h4>
			 	</div>
			 </div>	<!--/right-height-55-->



			
				 <div class="right-height-45">
				 	<div class="tab-content">
				 		<h4> Recent Updates </h4>
				 		<div class="scrollable" style="padding:0;">
				 			 <div class="row">
				 			 	<div class="col-md-12" style="height:100%;padding-right:0;padding-left:0;">
				 			 	 
				 			 	   <?php  $updates = getMyFriendsUpdatesRecent();  ?>
				 			 	    @if(!$updates)
		                                 No Updates 		                               
	                                @else
					 			 		<div class="news-items-sidebar">
					 			 			 @foreach( $updates as $update)
					 			 			  <?php  $user = getUser($update->user_id); ?>
					 			 			   @if(checkFriendship($currentUser->id, $user->id))
					 			 			    <div class="sidebar-news-update">
												  <div class="row" style="position:relative;">

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

												 	{{ $updates->links() }}
												 </div><!--/row-->
												</div><!--/sidebar-news-update-->

					 			 			   @endif
					 			 			 @endforeach
					 			 		</div><!--/news-item-sidebar-->
				 			 		@endif
				 			 	 
				 			 	</div><!--/col-md-12-->
				 			 </div><!--/row-->
				 		</div><!--/scrollable-->
				 	</div><!--/tab-content-->
			     </div><!--/right-height-45-->
			

		  </div><!--/right-fixed-->
		

		
		   
	

		
		
			
	</div><!-- /col-sm-4 -->


</div><!-- /padding-70 -->

<!-- ************************STATIC FOOTER********************************* -->
                  
                  <div class="navbar navbar-blue-bottom navbar-static-top">
                    <div class="padding-footer">
                      <div class="row">
                        <!-- main col left -->
                        <div class="col-sm-8">
                          <div class="submit-text-area">
                            <div class="row">
                              
                                <div class="col-md-3" style="padding-top:10px;">
                                  <a href="#" class="send-attachments"> <i class="fa fa-picture-o fa-lg"></i> </a>
                                  <a href="#" class="send-attachments"> <i class="fa fa-video-camera fa-lg"></i> </a>
                                  <a href="#" class="send-attachments"> <i class="fa fa-picture-o fa-lg"></i> </a>
                                </div>

                                <div class="col-md-3">
                                   
                                	 
                                	
                                </div>
                                
                                <!-- ************************SEND MESSAGE BOX********************************* -->
                                
                                <div class="col-sm-9">
                                  {{Form::open(['route' => 'messages.storeGlobal', 'id'=>'sendGlobal' ])}}
                                  <div class="input-group">
                                    <input type="text" name="message" class="form-control global_message_body" placeholder="Type..." required="required">
                                    <input type="text" name="incognito" id="incognito" value="" style="display:none"/>
                                    <span class="input-group-btn">
                                      {{ Form::submit('Send!', ['class' => 'btn btn-primary form-control global_send_button']) }}
                                      {{Form::close()}}
                                    </span>
                                  </div><!-- /input-group -->
                                </div><!-- /.col-md-7 -->
                            </div><!-- /.row -->
                          </div><!-- /.submit-text-area -->
                        </div><!-- /.col-md-9 -->
                                    <!-- ************************COPYRIGHT************************** -->
                                    <div class="col-sm-4">
                                      
                                         <div class="col-md-3" style="padding-top: 14px;padding-right:0;">
	                                    	<i class="fa fa-user-secret fa-lg pull-right incognito-color"></i>
	                                    </div>
	                                    <div class="col-md-9 toggle-incognito">	                                	   
											<input type="checkbox" value="incognito" id="toggle-incognito-check" name="check" />
											<label for="toggle-incognito-check"></label>
										</div>
                                        
                                      
                                    </div>
                      </div><!-- /.row -->
                    </div><!-- /.padding-footer -->
                  </div><!-- /.navbar -->



  <!-- ************************ EOF  ************************** -->


@stop