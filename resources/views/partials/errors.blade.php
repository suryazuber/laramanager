
@if (isset($errors)&&count($errors) > 0)
    <div class="alert alert-dismissable alert-danger">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
        @if(is_array($errors))
        {
            @foreach($errors as $error)
            <li>{{ $error }}</li>
            @endforeach
        }
        @else
            <li>{{ $errors }}</li>
        @endif
    </div>
@endif

