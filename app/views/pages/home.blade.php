@extends('layouts.profile')
    @section('content')

 
        {{-- <div class="page-header">
          <h1>Welcome to Cliqoid!</h1> 
        </div>
        <p class="lead">Designed n Developed By: </p>
        <p>Prateek Singh</p>
        <p></p>

        <p>
         

                 
        </p>   --}}
       

         {{--  <div>
            <button id="btnInit" >Find my location</button>
          </div>

          <div id="newMap"></div> --}}

        <div class="col-md-12 main-content">
          <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#global">Global</a></li>
            <li><a data-toggle="tab" href="#menu1">Tab 1</a></li>
            <li><a data-toggle="tab" href="#menu2">Tab 2</a></li>
            <li><a data-toggle="tab" href="#menu3">Tab 3</a></li>
          </ul>

           <div class="tab-content">
              <input type="text" id="decrypt-message" style="display:none;" value="{{URL::to('messages/decrypt-message')}}"/>
              <div id="global" class="tab-pane fade in active">
               <div class="global-window">
                  @if(getGlobalMessages()->count() > 0)
                      @foreach(getGlobalMessages() as $message)                      
                         
                           @if($message->user->id == $currentUser->id)
                              <div class="row"> 

                                  <div class="col-md-7 pull-right Area">                                      
                                      <div class="col-md-2 pull-right chat_img_pos">                                     
                                        <a href="{{ URL::to('/'.$currentUser->username ) }}">
                                          <img src="{{ checkUserAvatar($currentUser->email,'small') }}" class="chat_img"/>
                                          <div class="tooltip">  </div>
                                        </a>
                                      </div>

                                      <div class="col-md-3 chat_time pull-right">
                                         <span class="chat_username"> {{$message->user->username}} </span> <br/>
                                          {{$message->created_at->diffForHumans()}}
                                      </div>

                                    <div class="col-md-10 chat_text">
                                      {{ decryptMessage($message->body) }}      
                                    </div>

                                  </div> 
                              </div>                             

                           @else

                                <div class="row"> 
                                  <div class="col-md-7 pull-left Area">
                                    <div class="col-md-2 pull-left">
                                      <a href="{{ URL::to('/'.$message->user->username ) }}">
                                        <img src="{{ checkUserAvatar($message->user->email,'small') }}" class="chat_img"/>
                                        <div class="tooltip">  </div>
                                      </a>
                                    </div>

                                    <div class="col-md-10 chat_text">
                                      {{ decryptMessage($message->body) }}      
                                    </div>
                                  </div>
                                </div>

                           @endif                           
                      @endforeach
                    @else

                      <div class="row">
                          <div class="global-inactive col-md-6 col-md-offset-3">
                             <p>Hmmm, Global seems to be inactive at the moment...</p>
                          </div>
                      </div>
                    @endif
                </div>

                  <div class="submit-text-area">
                    <div class="row">
                         <div class="col-lg-6 col-md-offset-3">                            
                            {{Form::open(['route' => 'messages.storeGlobal', 'id'=>'sendGlobal' ])}}
                            <div class="input-group">
                              {{ Form::text('message', null, ['class' => 'form-control global_message_body', 'placeholder' => '.......', 'required' => 'required']) }}
                              <span class="input-group-btn">
                                {{ Form::submit('Send!', ['class' => 'btn btn-primary form-control global_send_button']) }}
                              </span>
                            </div><!-- /input-group -->
                          </div><!-- /.col-lg-6 -->
                    </div><!-- /.row -->
                  </div><!-- /.submit-text-area -->
              </div>

              <div id="menu1" class="tab-pane fade">
                <h3>Menu 1</h3>
                <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
              </div>

              <div id="menu2" class="tab-pane fade">
                <h3>Menu 2</h3>
                <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
              </div>

              <div id="menu3" class="tab-pane fade">
                <h3>Menu 3</h3>
                <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
              </div>

            </div>

          
        </div>

        
      
@stop

