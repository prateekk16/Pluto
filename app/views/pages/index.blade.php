
@extends('layouts.default')

@section('content')


 @if(!$currentUser)

	<div class="starter-template">
	    <h1>
	        {{ Auth::check() ? "Welcome, " . $currentUser->username : "Why Don't You Sign Up?" }}
	    </h1>	     

	</div>

	@else


	    <div class="container">
		 	<div class="row">
		 	 
				 <div class="col-md-6">		 	
			   			
			   			 {{ Form::open(['route' => 'statuses_path', 'id' => 'postStatus']) }} 
							    <!-- Status Field -->
							           
							           	 <div class="publishStatusArea">
							                <div class="form-group">
							                   <div class="col-md-8"> 
								                    {{ Form::textarea('body',null, ['class' => 'form-control status-body',  'rows' => '2', 'cols' => '80', 'placeholder'=> 'Share What you are doing...']) }}
								                    {{ $errors->first('body', '<span class="error">:message</span>') }}
							                    </div>						                

							                <!-- Post Status Field -->						            
							                   <div class="col-md-offset-8"> 
								                   <div class="postStatusBtnArea">
								                     {{ Form::submit('Post', ['class' => 'btn btn-primary btn-xs', 'id'=>'postStatusBtn']) }}
								                   </div>
							                   </div>
							                    
							                </div>
							               </div>
							            
						    {{ Form::close() }}	
						 
					  
		     	   </div>
		     </div>

		     <div class="row">  
			     <div class="col-md-12">
				     			@include('pages.partials.statuses')
			     </div>
			  </div>
		 </div>



 




	 

	@endif
@stop

