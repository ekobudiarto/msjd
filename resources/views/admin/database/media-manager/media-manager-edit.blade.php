@extends('/admin/include/admin-header-footer')

@section('content')
<div class="module">
	<div class="module-head">
		<h3>Forms Media Manager</h3>
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

			@foreach($data['media-manager'] as $key => $value)
			
			{!! Form::open(array('url' => 'admin/media-manager/'.$value->media_manager_id, 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager Title</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="media_manager_title" value="{{ $value->media_manager_title }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager Type</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="media_manager_type" value="{{ $value->media_manager_type }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager Filename</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="media_manager_filename">{{ $value->media_manager_filename }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager publish</label>
					<div class="controls">
						<select class="span8" name="media_manager_publish">
						 		@if( $value->media_manager_publish == 1 )
						 			<option value="1">Yes</option>
						 			<option value="0">No</option>
						 		@else
						 			<option value="0">No</option>
						 			<option value="1">yes</option>
						 		@endif
						 	
						 </select>
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/media-manager', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			
			{!! Form::close() !!}
			
			@endforeach
	</div>
</div>

@endsection