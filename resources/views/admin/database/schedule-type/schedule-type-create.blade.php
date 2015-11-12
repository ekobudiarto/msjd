@extends('/admin/include/admin-header-footer')

@section('content')
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input-facebook.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/css-js/scripts/jquery.tokeninput.js') }}" type="text/javascript"></script>

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
			
			{!! Form::open(array('url' => 'admin/schedule-type', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type Name</label>
					<div class="controls">
						<input type="text" required id="basicinput" placeholder="text" class="span8" name="schedule_type_name">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type Description</label>
					<div class="controls">
						<textarea class="span8" id="editor" rows="5" name="schedule_type_desc"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager ID</label>
					<div class="controls">
						<!--<textarea class="span8" id="editor2" rows="5" name="media_manager_id"></textarea>-->
						<input type="text" required id="mediaId" style="width: 65.812%;" />
						<input type="hidden" class="mediaIdValue" name="media_manager_id" />
					</div>
				</div>				
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/schedule-type', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			
			{!! Form::close() !!}
	</div>
</div>
<script>
	$(document).ready(function(){
		//MULTI AUTOCOMPLETE
		var data = <?php echo $data['media_manager'];?>;
		$("#mediaId").tokenInput(data, {
			preventDuplicates: true,
			theme: "facebook"
		});
		$("#mediaId").on('change',function(){
			$(".mediaIdValue").val($('#mediaId').val());
		});
	});
</script>
@endsection