@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Edit Schedule</h3>
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

			@foreach($data['dataschedule'] as $key => $value)

			<form class="form-horizontal row-fluid" role="form" method="POST" action="/admin/schedule/{{ $value->schedule_id }}">
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Title</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="number" class="span8" name="schedule_title" value="{{ $value->schedule_title }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type ID</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Type ID" class="span8" name="schedule_type_id" value="{{ $value->schedule_type_id }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Creator</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Users Creator" class="span8" name="schedule_users_creator" value="{{ $value->schedule_users_creator }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Source</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Users Source" class="span8" name="schedule_users_source" value="{{ $value->schedule_users_source }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date Start</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Date Start" class="span8" name="schedule_date_start" value="{{ $value->schedule_date_start }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date End</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Date End" class="span8" name="schedule_date_end" value="{{ $value->schedule_date_end }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" placeholder="Schedule Description" name="schedule_description">{{ $value->schedule_description }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Headline</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Headline" class="span8" name="schedule_headline" value="{{ $value->schedule_headline }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Media ID</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Media ID" class="span8" name="schedule_media_id" value="{{ $value->schedule_media_id }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Publish</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Schedule Publish" class="span8" name="schedule_publish" value="{{ $value->schedule_publish }}">
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						<a class="btn btn-small btn-info" href="<?php echo url('/admin/schedule');?>">Back</a>
					</div>
				</div>
			</form>
			@endforeach
	</div>
</div>

@endsection