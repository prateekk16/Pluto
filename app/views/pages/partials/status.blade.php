 {{ Form::open(['route' => 'statuses_path']) }}

  <p>Post</p>

    <!-- Status Field -->
            <div class="form-group">
                {{ Form::label('body', 'Status:') }}
                {{ Form::textarea('body',null, ['class' => 'form-control', 'required' => 'required']) }}
            </div>
        
            <!-- Post Status Field -->
            <div class="form-group">
                {{ Form::submit('Post Status', ['class' => 'btn btn-primary']) }}
            </div>

{{ Form::close() }}