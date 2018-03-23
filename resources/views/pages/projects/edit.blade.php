@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
    <div class="jumbotron">
        
        <div class="container">
          <h2>Project Edit form</h2>
          <form class="form-horizontal" method="post" action="{{ route('projects.update',[$project->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
              <label class="control-label col-sm-2" for="projectname">Project name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="projectname" placeholder="Enter company name" name="name" value="{{ $project->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="description">Description:</label>
              <div class="col-sm-10">          
                <textarea type="text" class="form-control" id="description" placeholder="Enter description" name="description">{{ $project->description }}</textarea>
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
</div>


<div class="col-sm-3 col-md-3 col-lg-3 pull-right">
      <div class="sidebar-module">
        <h4>Actions</h4>
        <ol class="list-unstyled">
          <li><a href="/projects/{{ $project->id }}">Back To Project</a></li>
          <li><a href="/projects">All Projects</a></li>
        </ol>
      </div>
</div>


@endsection