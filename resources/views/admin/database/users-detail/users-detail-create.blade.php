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
						<select name="users_group_id" required>
						<option value=''>--select--</option>

						@foreach($data['group'] as $row=>$value)
								<option value="{{ $value->users_group_id }}">{{ $value->users_group_name}}</option>
						@endforeach
						</select>
						
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
						<input type="text" onchange="getidAll(this)" placeholder="it should user id, but you can search by name" class="span8 getFollow">
						<input type="text" class="tempJsonFollow" name="users_json_following" style="width: 65.812%;margin-top:10px;" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Description</label>
					<div class="controls">
						<textarea class="span8" id="editor" rows="5" name="users_description"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media ID</label>
					<div class="controls">
						<input type="text" id="basicinput" onchange="getid(this)" placeholder="it should media id, but you can search by name" class="span8 getMedia" name="media_manager_id">
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
						<select name="users_status_id" required>
						<option value=''>--select--</option>

						@foreach($data['status'] as $row=>$value)
								<option value="{{ $value->users_status_id }}">{{ $value->users_status_title}}</option>
						@endforeach
						</select>
						<!-- <input type="text" id="basicinput" onchange="getid(this)" placeholder="it should status id, but you can search by title" class="span8 getStatus" name="users_status_id">-->
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
<script type="text/javascript">
	$(document).ready(function(){
		$(".getFollow").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getusername") }}',
		});
		$(".getMedia").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getmediaid") }}',
		});
		$(".getStatus").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getstatusid") }}',
		});
	});
	function getid(obj){
    
		var valuee = obj.value;
		var res = valuee.split(" ");
		var nilai = res[0].replace('[','');
		var nilai = nilai.replace(']','');
		obj.value = nilai;
	}
	
	function getidAll(obj){
		var valuee = obj.value;
		var res = valuee.split(" ");
		var nilai = res[0].replace('[','');
		var nilai = nilai.replace(']','');
		var temp = $(".tempJsonFollow").val();
		if (temp == "") {
            $(".tempJsonFollow").val(nilai);
        }
		else{
			$(".tempJsonFollow").val(temp+","+nilai);
		}
		obj.value = "";
	}


</script>

@endsection