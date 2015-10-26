@extends('/admin/include/admin-header-footer')

@section('content')

<style>


</style>
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

			{!! Form::open(array('url' => 'admin/banned-report', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}

				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Users by</label>
					<div class="controls">
						<input type="text" id="autouser1"  onchange="getid(this)" placeholder="it should user id" class="autouser" name="users_by" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content ID</label>
					<div class="controls">
						<input type="text" id="basicinput" onchange="getid(this)" placeholder="number" class="autocontent" name="content_id" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Destination</label>
					<div class="controls">
						<input type="text" id="autouser2" onchange="getuserid(this)" placeholder="it should user id" class="autouser" name="users_dest" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Banned Report Message</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="banned_report_message"></textarea>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/banned-report', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
	</div>
</div>

<!-- autocomplete. why use this? because the system will be slow if dropdown for user has too many or large database -->
<script type="text/javascript">
	$(document).ready(function(){
		$('input:text').bind({

		});
	
		$(".autouser").autocomplete({
			minLength:2,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getusername") }}',
		});
		$(".autocontent").autocomplete({
			minLength:3,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getcontenttitle") }}',
		});

	});
	function getid(obj){
    
		var valuee = obj.value;
		var res = valuee.split(" ");
		obj.value = res[0];
	}


</script>
@endsection