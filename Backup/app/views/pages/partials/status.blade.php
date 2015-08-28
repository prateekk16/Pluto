 {{ Form::open(['route' => 'statuses_path', 'id' => 'postStatus']) }} 


    <!-- Status Field -->
           <div class="col-md-12">
                <div class="form-group">
                    
                    {{ Form::textarea('body',null, ['class' => 'form-control status-body',  'rows' => '2', 'cols' => '80']) }}
                    {{ $errors->first('body', '<span class="error">:message</span>') }}
                </div>
            </div>
        
            <!-- Post Status Field -->
            <div class="col-md-4 col-md-offset-3">
                <div class="form-group">
                    {{ Form::submit('Post Status', ['class' => 'btn btn-primary', 'id'=>'postStatusBtn']) }}
                    
                </div>
            </div>

{{ Form::close() }}

