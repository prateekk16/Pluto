<ul class="nav">
    <li><a href="#" data-toggle="offcanvas" class="visible-xs text-center"><i class="glyphicon glyphicon-chevron-right"></i></a></li>
</ul>

<ul class="nav hidden-xs" id="lg-menu">
    <li class="active">
        <div class="profile-pic-sidebar">
            <a href="{{ URL::to('/'.$currentUser->username ) }}">
            {{ HTML::image(checkUserAvatar($currentUser->email,'med'),'avatar',  array('class' => 'avatar_sidebar avatar_filter')) }}
            </a>
             <a href="#" data-toggle="modal" data-target=".change-dp-modal">
            <button class="btn btn-default change_dp_sidebar avatar_sidebar" style="display:none;" type="submit">
            Change Profile Picture
            </button>
            </a>

             <div class="status-sidebar avatar_sidebar">
               <span class="user_nav_status">
                 @if(getLatestStatus()) {{ getLatestStatus()->body }} @endif
               </span>  
             </div>

           

           
        </div>


    </li>
    <li><a href="#stories"><i class="glyphicon glyphicon-list"></i> Stories</a></li>
    <li>
     <a href="javascript:;" data-toggle="collapse" data-target="#status"><i class="fa fa-fw fa-quote-left"></i> Status <i class="fa fa-fw fa-caret-down"></i></a>
      <ul id="status" class="collapse sidebar-ul">
        <li>
              {{ Form::open(['route' => 'statuses_path', 'id' => 'postStatus']) }} 
                                <!-- Status Field -->
                                       
                                         <div class="publishStatusArea">
                                            <div class="form-group">
                                               <div class="col-md-12">                                                     
                                                    {{ Form::textarea('body',null, ['maxlength'=>'65',  'class' => 'form-control status-body',  'rows' => '3', 'cols' => '80', 'placeholder'=> 'Share What you are doing... (65 chars max)']) }}
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
        </li>
      </ul>


     </li>

    <li><a href="#"><i class="glyphicon glyphicon-paperclip"></i> Saved</a></li>
    <li><a href="#"><i class="glyphicon glyphicon-refresh"></i> Refresh</a></li>
</ul>


<!-- tiny only nav-->
<ul class="nav visible-xs" id="xs-menu">
    <li><a href="#featured" class="text-center"><i class="glyphicon glyphicon-list-alt"></i></a></li>
    <li><a href="#stories" class="text-center"><i class="glyphicon glyphicon-list"></i></a></li>
    <li><a href="#stories" class="text-center"><i class="fa fa-fw fa-quote-left"></i></a></li>
    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-paperclip"></i></a></li>
    <li><a href="#" class="text-center"><i class="glyphicon glyphicon-refresh"></i></a></li>
</ul>