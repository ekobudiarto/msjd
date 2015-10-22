@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Banned Report</h3>
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

			@foreach($data['databanned'] as $key => $value)
			
			{!! Form::open(array('url' => 'admin/banned-report/'.$value->banned_report_id, 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Users by</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="number" class="span8" name="users_by" value="{{ $value->users_by }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content ID</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="number" class="span8" name="content_id" value="{{ $value->content_id }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Destination</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="number" class="span8" name="users_dest" value="{{ $value->users_dest }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Banned Report Message</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="banned_report_message">{{ $value->banned_report_message }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/banned-report', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
			
			@endforeach
	</div>
</div>

@endsection