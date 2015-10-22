@extends('/admin/include/admin-header-footer')

@section('content')
<div class="module">
	<div class="module-head">
		<h3>Forms Users Group</h3>
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

			@foreach($data['users-group'] as $key => $value)
			<form class="form-horizontal row-fluid" role="form" method="POST" action="/admin/users-group/{{ $value->users_group_id }}">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<div class="control-group">
					<label class="control-label" for="basicinput">Users Group Name</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="users_group_name" value="{{ $value->users_group_name}}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">User Group Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="users_group_description">{{ $value->users_group_name}}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Group Is Public</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="users_group_is_public" value="{{ $value->users_group_is_public}}">
					</div>
				</div>	
				<div class="control-group">
					<div class="controls">
						{!! Html::link('admin/users-group', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			</form>
			@endforeach
	</div>
</div>

@endsection