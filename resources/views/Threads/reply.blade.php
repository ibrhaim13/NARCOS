<div class="col-md-11 col-md-offset-1" id="reply-{{$reply->id}}">
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="level">
                <span class="flax">
            <a class="btn btn-link" href="#">{{$reply->user->name}}</a>
                </span>

            <sub>
                {{  'Since '.$reply->created_at->diffForHumans()}}
            </sub>
            </div>

        </div>

        <div class="panel-body">
             <div class="level">
                <div class="flax">
                    {{$reply->body}}
                 </div>

                @if(auth()->check())
                {!! Form::open(["url"=>"/replies/$reply->id/favorite"]) !!}
              <button class="btn btn-default">
                  {{ $reply->favorite->count()?$reply->favorite->count():'' }}
                  <i class="glyphicon glyphicon-heart" style="color:#d62728"></i>
              </button>
                {!! Form::close() !!}
                @else
                    <span class="btn btn-default">
                        {{ $reply->favorite->count()?$reply->favorite->count():'' }}
                        <i class="glyphicon glyphicon-heart">  </i>
                    </span>

                @endif
            </div>
            <reply-template>

            </reply-template>

        </div>
             @can('update',$reply)
                <div class="panel-footer">
                    <button class="btn btn-xs"><i class=""></i></button>
                    {!! Form::open(["method"=>"delete","url"=>"/replies/$reply->id"])!!}
                    <button class="btn btn-link"><i class="glyphicon glyphicon-remove" style="color: #dd1144;"></i></button>
                    {!! Form::close() !!}
                </div>

            @endcan
     </div>
</div>
