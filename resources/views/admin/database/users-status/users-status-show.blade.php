@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>View Detail Users Status</h3>
	</div>
	<div class="module-body">


			@if(Session::has('success'))
			<div class="alert alert-success">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Well done!</strong> {{ Session::get('success') }} 
			</div>			
			@elseif(Session::has('warning'))
			<div class="alert">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Warning!</strong> Something fishy here!
			</div>
			@elseif(Session::has('failed'))
			<div class="alert alert-error">
				<button type="button" class="close" data-dismiss="alert">×</button>
				<strong>Oh snap!</strong> Whats wrong with you? 
			</div>
			@endif

			@if ($errors->any())
			    <ul class="alert alert-danger">
			        @foreach ($errors->all() as $error)
			            <li>{{ $error }}</li>
			        @endforeach
			    </ul>
			@endif

			@foreach($data['dataUsersStatus'] as $key => $value)

				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Status Title</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="number" class="span8" name="users_status_title" value="{{ $value->users_status_title }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Status Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="users_status_desc">{{ $value->users_status_desc }}</textarea>
					</div>
				</div>
			
			@endforeach
			{!! Html::link('admin/users-group', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
	</div>
</div>

@endsection