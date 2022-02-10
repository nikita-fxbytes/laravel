@if(count($errors) > 0)
    <div class="alert alert-danger alert-dismissible show" role="alert">
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

        <ul class="mb-0">
        @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
@endif

@foreach (['danger', 'warning', 'success', 'info'] as $msg)
    @if(Session::has($msg))
        <div class="alert alert-{{ $msg }} alert-dismissible show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>

            @if($msg == 'danger')
                <strong>
                Oops! 
                </strong>
            @elseif($msg == 'warning')
                <strong>
                Warning! 
                </strong>
            @elseif($msg == 'success')
                <strong>
                Success! 
                </strong>
            @elseif($msg == 'info')
                <strong>
                Info! 
                </strong>
            @endif
            {{ Session::get($msg) }}
        </div>
    @endif 
@endforeach