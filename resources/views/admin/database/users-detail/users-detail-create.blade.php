@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Add Users Detail</h3>
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


			{!! Form::open(array('url' => 'admin/users-detail', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Name</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="users_name" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Fullname</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="users_fullname" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Email</label>
					<div class="controls">
						<input type="email" id="basicinput" placeholder="" class="span8" name="users_email" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Password</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="password" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Group ID</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="users_group_id" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Telp</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="users_telp">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Json Follow</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="users_json_following">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="users_description"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media ID</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="media_manager_id">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Avatar</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="users_avatar">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Status ID</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="users_status_id">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Device ID</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="deviceID">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Device Version</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="deviceVersion">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Device Brand</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="deviceBrand">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Provider</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="providerID">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Longitude</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="long">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Latitude</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="" class="span8" name="lat">
					</div>
				</div>

				
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/users-detail', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
	</div>
</div>

@endsection