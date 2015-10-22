@extends('/admin/include/admin-header-footer')

@section('content')
<div class="module">
	<div class="module-head">
		<h3>Forms Schedule Type</h3>
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

			@foreach($data['schedule-type'] as $key => $value)
			<form class="form-horizontal row-fluid" role="form" method="POST" action="/admin/schedule-type/{{ $value->schedule_type_id }}">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type Name</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="schedule_type_name" value="{{ $value->schedule_type_name}}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="schedule_type_desc" >{{ $value->schedule_type_desc}}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager ID</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="media_manager_id" >{{ $value->media_manager_id}}</textarea>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						<a class="btn btn-small btn-info" href="<?php echo url('admin/schedule-type');?>">Back</a>
					</div>
				</div>
			</form>
			@endforeach
	</div>
</div>

@endsection