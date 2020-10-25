
@if (session()->has('success'))
<div class="alert alert-outline-success fade show" role="alert">
	<div class="alert-icon">
		<i class="flaticon-bell"></i>
	</div>
	<div class="alert-text">
			@foreach(session()->get('success') as $e)
				@if(is_array($e))
					@foreach($e as $error)
						{{$error}}<br>
					@endforeach
				@else
					{{$e}}<br>
				@endif
			@endforeach
	</div>
	<div class="alert-close">
		<span aria-hidden="true"><i class="la la-close"></i></span>
	</div>
</div>
@php
	Session::forget('success');
@endphp
@endif

@if (session()->has('errors'))
<div class="alert alert-outline-danger fade show" role="alert">
	<div class="alert-text">
			@foreach($errors->all() as $e)
				@if(is_array($e))
					@foreach($e as $error)
						{{$error}}<br>
					@endforeach
				@else
					{{$e}}<br>
				@endif
			@endforeach
	</div>
	<div class="alert-close">
		<span aria-hidden="true"><i class="la la-close"></i></span>
	</div>
</div>
@php
	Session::forget('errors');
@endphp
@endif
