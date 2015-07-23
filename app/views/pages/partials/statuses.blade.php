<div class="col-md-12">
    @foreach($currentUser->statuses as $status)
       
          <div class="media status-media">
              <div class="media-left">
                <a href="#">
                  <img class="media-object" src="..." alt="...">
                </a>
              </div>
              <div class="media-body">
                <h5 class="media-heading">{{ $status->user->username }}</h5>
                <p> <small>{{ $status->created_at->diffForHumans() }}</small> </p>
                    {{ $status->body }}
              </div>
          </div>

    @endforeach
</div>