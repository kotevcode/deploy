@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  Repositories
                  <a href="{{route('repos.create')}}" class="btn btn-default btn-xs pull-right">
                    Create
                  </a>
                </div>

                <div class="panel-body">

                  <table class="table">
                    <thead>
                      <tr>
                        <th>#</th>
                        <th>Url</th>
                        <th>Bitbucket path</th>
                        <th>Account</th>
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
                          <td>{{$repo->id}}</td>
                          <td><a href="{{$repo->url}}" target="_blank"></a>{{$repo->url}}</td>
                          <td>{{$repo->bitbucket}}</td>
                          <td>{{$repo->account}}</td>
                          <td>{{$repo->directory}}</td>
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
