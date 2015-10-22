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

			<form class="form-horizontal row-fluid" role="form" method="POST" action="/admin/users-group">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<div class="control-group">
					<label class="control-label" for="basicinput">User Group Name</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="users_group_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">User Group Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="users_group_description"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">User Group Is Public</label>
					<div class="controls">
						{!! Form::select('users_group_is_public', ['0' => 'No','1' => 'Yes']) !!}
					</div>
				</div>		
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						<a class="btn btn-small btn-info" href="<?php echo url('admin/users-group');?>">Back</a>
					</div>
				</div>
			</form>
	</div>
</div>

@endsection