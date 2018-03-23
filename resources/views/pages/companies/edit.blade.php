@extends('layouts.app')

@section('content')
<div class="col-md-9 col-lg-9 col-sm-9 pull-left">
    <div class="jumbotron">
        
        <div class="container">
          <h2>Company Edit form</h2>
          <form class="form-horizontal" method="post" action="{{ route('companies.update',[$company->id]) }}">
            {{ csrf_field() }}
            <input type="hidden" name="_method" value="put">
            <div class="form-group">
              <label class="control-label col-sm-2" for="companyname">Company name:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="companyname" placeholder="Enter company name" name="name" value="{{ $company->name }}">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="description">Description:</label>
              <div class="col-sm-10">          
                <textarea type="text" class="form-control" id="description" placeholder="Enter description" name="description">{{ $company->description }}</textarea>
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
          <li><a href="/companies/{{ $company->id }}">Back To Company</a></li>
          <li><a href="/companies">All Companies</a></li>
        </ol>
      </div>
</div>


@endsection