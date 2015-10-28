@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Media manager</h3>
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
			
			{!! Form::open(array('url' => 'admin/media-manager', 'files' => false, 'class' => 'form-horizontal row-fluid', 'enctype' => 'multipart/form-data')) !!}
			
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">

				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager Title</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="media_manager_title" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Upload File</label>
					<div class="controls">
						<select id="type_upload" onchange="javascript:typeUpload()">
							<option value="file">Upload</option>
							<option value="link">Link</option>
						</select>
						<br/><br/>
						<input type="file" style="display:block" id="inputfile" placeholder="text" class="span8" name="file">
						<input type="text" style="display:none" id="inputlink" placeholder="http://linkyourfile.com/yourfile.extension" class="span8" name="media_manager_link">
					</div>
				</div>
				<!-- <div class="control-group">
					<label class="control-label" for="basicinput">Media Manager Type</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="text" class="span8" name="media_manager_type">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager Filename</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="media_manager_filename"></textarea>
					</div>
				</div> -->
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager publish</label>
					<div class="controls">
						{!! Form::select('media_manager_publish', ['0' => 'No','1' => 'Yes']) !!}
					</div>
				</div>
				
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/media-manager', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
	</div>
</div>

<script type="text/javascript">
	function typeUpload(){
		var choose = $('#type_upload').val();

		if(choose == 'file'){
			$('#inputlink').val('');
			document.getElementById('inputlink').style.display = 'none';
			document.getElementById('inputfile').style.display = 'block';
		}
		else{
			$('#inputfile').val('');
			document.getElementById('inputfile').style.display = 'none';
			document.getElementById('inputlink').style.display = 'block';
		}
		
	}
</script>

@endsection