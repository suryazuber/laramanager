@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
    <div class="jumbotron">
      <div class="container">
        <h1>{{ $company->name }}</h1>
        <p>{{ $company->description }}</p>
    </div>
    </div>
    <div class="row" style="background-color: #fff;">
      <!-- Example row of columns -->
      <!-- <a class="btn btn-primary btn-sm pull-right" href="{{ route('projects.create',['company_id'=>$company->id]) }}" role="button">Add New</a> -->
      <a class="btn btn-primary btn-sm pull-right" href="/projects/create/{{ $company->id }}" role="button">Add New</a>
        
        @foreach($company->projects as $project)
        <div class="col-md-4">
          <h2>{{ $project->name }}</h2>
          <p>{{ $project->description }}</p>
          <p><a class="btn btn-default" href="/projects/{{ $project->id }}" role="button">View details »</a></p>
        </div>
        @endforeach
        
    </div>
</div>


    <div class="col-sm-3 col-md-3 col-lg-3 pull-right">
          <!-- <div class="sidebar-module sidebar-module-inset">
            <h4>About</h4>
            <p>Etiam porta <em>sem malesuada magna</em> mollis euismod. Cras mattis consectetur purus sit amet fermentum. Aenean lacinia bibendum nulla sed consectetur.</p>
          </div> -->
          <div class="sidebar-module">
            <h4>Actions</h4>
            <ol class="list-unstyled">
              <li><a href="/companies/{{ $company->id }}/edit">Edit</a></li>
              <li>
                  <a href="#" onclick="
                          var result = confirm('Are you sure you wish to delete this Company?');
                              if( result ){
                                      event.preventDefault();
                                      document.getElementById('delete-form').submit();
                              }
                      "> Delete </a>

                      <form id="delete-form" action="{{ route('companies.destroy',[$company->id]) }}" 
                        method="POST" style="display: none;">
                                <input type="hidden" name="_method" value="delete">
                                {{ csrf_field() }}
                      </form>
              </li>
              <li><a href="#">Add new member</a></li>
            </ol>
          </div>
          <div class="sidebar-module">
            <h4>Members</h4>
            <ol class="list-unstyled">
                {{-- 
                @foreach($company->users as $user)
                <li><a href="#">{{$user->name}}</a></li>
                @endforeach
                --}}
            </ol>
          </div>          
        </div>


@endsection