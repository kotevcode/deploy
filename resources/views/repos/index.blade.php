@extends('layouts.app')

@section('content')
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="panel panel-default">
          <div class="panel-heading">
            Latest Repositories
          </div>

          <div class="panel-body">

            <table class="table">
              <thead>
                <tr>
                  <th>Account</th>
                  <th>Url</th>
                  <th>Bitbucket path</th>
                  <th>Directory</th>
                  <th>Remote</th>
                  <th>Branch</th>
                  <th class="text-center">Actions</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($latest_repos as $repo)
                  <tr @if ($repo->auto_deploy)
                    class="success"
                  @else
                    class="danger"
                  @endif>
                  <td>{{$repo->account}}</td>
                  <td><a href="{{$repo->url}}" target="_blank">{{str_limit($repo->url,20)}}</a></td>
                  <td>{{str_limit($repo->bitbucket,20)}}</td>
                  <td>{{str_limit($repo->directory,20)}}</td>
                  <td>{{$repo->remote}}</td>
                  <td>{{$repo->branch}}</td>
                  <td>
                    <div class="row">
                      <div class="col-xs-4">
                        <a class="btn btn-info btn-block btn-xs" href="{{route('repos.show',$repo->id)}}">Show</a>
                      </div>
                      <div class="col-xs-4">
                        <a class="btn btn-warning btn-block btn-xs" href="{{route('repos.edit',$repo->id)}}">Edit</a>
                      </div>
                      <div class="col-xs-4">
                        {{ Form::open(['method' => 'DELETE', 'route' => ['repos.destroy', $repo->id]]) }}
                        {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block btn-xs']) }}
                        {{ Form::close() }}
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>

  <div class="row">
    <div class="col-md-12">
      <div class="panel panel-default">
        <div class="panel-heading">
          All Repositories
          <a href="{{route('repos.create')}}" class="btn btn-primary btn-xs pull-right">
            Create
          </a>
        </div>

        <div class="panel-body">

          <table class="table">
            <thead>
              <tr>
                <th>Account</th>
                <th>Url</th>
                <th>Bitbucket path</th>
                <th>Directory</th>
                <th>Remote</th>
                <th>Branch</th>
                <th class="text-center">Actions</th>
              </tr>
            </thead>
            <tbody>
              @foreach ($repos as $repo)
                <tr @if ($repo->auto_deploy)
                  class="success"
                @else
                  class="danger"
                @endif>
                <td>{{$repo->account}}</td>
                <td><a href="{{$repo->url}}" target="_blank">{{str_limit($repo->url,20)}}</a></td>
                <td>{{str_limit($repo->bitbucket,20)}}</td>
                <td>{{str_limit($repo->directory,20)}}</td>
                <td>{{$repo->remote}}</td>
                <td>{{$repo->branch}}</td>
                <td>
                  <div class="row">
                    <div class="col-xs-4">
                      <a class="btn btn-info btn-block btn-xs" href="{{route('repos.show',$repo->id)}}">Show</a>
                    </div>
                    <div class="col-xs-4">
                      <a class="btn btn-warning btn-block btn-xs" href="{{route('repos.edit',$repo->id)}}">Edit</a>
                    </div>
                    <div class="col-xs-4">
                      {{ Form::open(['method' => 'DELETE', 'route' => ['repos.destroy', $repo->id]]) }}
                      {{ Form::submit('Delete', ['class' => 'btn btn-danger btn-block btn-xs']) }}
                      {{ Form::close() }}
                    </div>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

      </div>
    </div>
  </div>
</div>
</div>
@endsection
