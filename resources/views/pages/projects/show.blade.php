@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
    <div class="jumbotron">
        <div class="container">
            <h1>{{ $project->name }}</h1>
            <p>{{ $project->description }}</p>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-body">
            <form class="form-horizontal" method="post" action="{{ route('comments.store') }}">
                {{ csrf_field() }}
                <input type="hidden" name="commentable_type" value="App\Models\Project"/>
                <input type="hidden" name="commentable_id" value="{{$project->id}}"/>
                
                <div class="form-group">
                  <label class="control-label col-sm-2" for="body">Comment:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="body" placeholder="Enter Comment" name="body" value="">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="url">Proof/Photos:</label>
                  <div class="col-sm-10">          
                    <textarea type="text" class="form-control" id="url" placeholder="Enter Details" name="url"></textarea>
                  </div>
                </div>
                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-default">Submit</button>
                  </div>
                </div>
            </form>
        </div>
    </div>
    @if(isset($project) )
    @include('partials.comments')    
    @endif
</div>
<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
    <div class="sidebar-module">
        <h4>Actions</h4>
        <ol class="list-unstyled">
            <li><a href="/projects/{{ $project->company_id }}/edit">Edit</a></li>
            <li><a href="/projects/create/{{ $project->company_id }}">Add Project</a></li>
            <li><a href="/projects/index/{{ $project->company_id }}">List All Projects</a></li>
            <li>
                <a href="#" onclick="
                    var result = confirm('Are you sure you wish to delete this Project?');
                    if( result ){
                    event.preventDefault();
                    document.getElementById('delete-form').submit();
                    }
                "> Delete </a>

                <form id="delete-form" action="{{ route('projects.destroy',[$project->id]) }}" 
                method="POST" style="display: none;">
                <input type="hidden" name="_method" value="delete">
                {{ csrf_field() }}
                </form>
            </li>
        </ol>
    </div>         
</div>

@endsection