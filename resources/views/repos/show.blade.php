@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <a href="{{$repo->url}}" target="_blank">{{$repo->url}}</a>
                </div>
                <div class="panel-body">
                  <p>
                    {{$repo->bitbucket}} - {{$repo->remote}} {{$repo->branch}}<br>
                    {{$repo->comments}}
                  </p>
                  <p>
                    <a href="{{route('webhook',$repo)}}" class="btn btn-success pull-right">Deploy</a>
                  </p>
                  <h3>Logs</h3>
                  <ul class="list-group">
                    @forelse ($repo->logs as $element)
                      <li class="list-group-item">
                        <h3>Made by
                          @if ($element->madeBy == 'user')
                            {{$element->user->name}}
                          @else
                            {{$element->madeBy}}
                          @endif
                          | {{$element->created_at->format('d/m/Y H:i:s')}}
                        </h3>
                        <ul>
                          @foreach ($element->content as $line)
                            @if (is_array($line))
                              <ul>
                                @foreach ($line as $li)
                                  <li>{{$li}}</li>
                                @endforeach
                              </ul>
                            @else
                            <li>{{$line}}</li>
                            @endif
                          @endforeach
                        </ul>
                      </li>
                    @empty
                      <li class="list-group-item">
                        No deploys yet..
                      </li>
                    @endforelse
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
