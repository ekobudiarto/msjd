@extends('/admin/include/admin-header-footer')

@section('content')

<style>


</style>
<div class="module">
	<div class="module-head">
		<h3>Forms Notification</h3>
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

			{!! Form::open(array('url' => 'admin/notification', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}

				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Users</label>
					<div class="controls">
						<input type="text" id="autouser"  onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" name="users_id" style="width: 65.812%;" required>
					</div>
				</div>
				<div class="control-group" >
					<label class="control-label" for="basicinput">Datetime</label>
					<div class="controls">
						<input type="text" id="datetime" value="<?PHP echo date('Y-m-d H:i:s');?>" onchange="getid(this)" placeholder="Datetime" class="autocontent" style="width: 65.812%;" name="datetime" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Status</label>
					<div class="controls">
						<select name="status" >
							<option value="send">Send</option>
							<option value="read">Read</option>
						</select>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/notification', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
	</div>
</div>

<!-- autocomplete. why use this? because the system will be slow if dropdown for user has too many or large database -->
<script type="text/javascript">
	$(document).ready(function(){
		//DATETIME
		$('#datetime').datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm",
		});
	
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
		var nilai = res[0].replace('[','');
		var nilai = nilai.replace(']','');
		obj.value = nilai;
	}


</script>
@endsection