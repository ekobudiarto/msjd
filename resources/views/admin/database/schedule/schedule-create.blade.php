@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Add Schedule</h3>
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
			
			{!! Form::open(array('url' => 'admin/schedule', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Title</label>
					<div class="controls">
						<textarea class="span8" rows="5" placeholder="text" name="schedule_title"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type</label>
					<div class="controls">
						<select class="span8" name="schedule_type_id">
							<option value="">---pilih type---</option>
						 	@foreach($data['schedule_type'] as $key => $value)
						 	<option value="{{ $value->schedule_type_id }}">{{ $value->schedule_type_name }}</option>
						 	@endforeach
						</select>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Creator</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="integer" class="span8" name="schedule_users_creator">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Source</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="integer" class="span8" name="schedule_users_source">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date Start</label>
					<div class="controls">
						<input type="date" id="basicinput" placeholder="datetime" class="span8" name="schedule_date_start">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date End</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="datetime" class="span8" name="schedule_date_end">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" placeholder="text" name="schedule_description"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Headline</label>
					<div class="controls">
						<textarea class="span8" rows="5" placeholder="text" name="schedule_headline"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Media ID</label>
					<div class="controls">
						<textarea class="span8" rows="5" placeholder="text" name="schedule_media_id"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Publish</label>
					<div class="controls">
						{!! Form::select('schedule_publish', ['0' => 'No','1' => 'Yes']) !!}
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/schedule', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
	</div>
</div>

@endsection