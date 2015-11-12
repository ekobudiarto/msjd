@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Edit Last Login</h3>
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

			@foreach($data['last_login'] as $key => $value)
			
			{!! Form::open(array('url' => 'admin/last-login/'.$value->last_login_id, 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Users</label>
					<div class="controls">
						<input type="text"required  id="usrDest" value="{{ $data['user_name'] }}" placeholder="it should user id, but you can search by name" style="width: 65.812%;" />
						<input type="hidden" name="users_id" value="{{ $value->users_id }}"  id="usrDestValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Datetime</label>
					<div class="controls">
						<input type="text" id="datetime"  value="{{ $value->datetime }}"  class="span8" name="datetime" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Regional</label>
					<div class="controls">
						<input type="text" id="basicinput"  value="{{ $value->regional }}" class="span8" placeholder="Bogor" name="regional" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Longitude</label>
					<div class="controls">
						<input type="text" id="basicinput"  value="{{ $value->long }}" class="span8" placeholder="106.806039" name="long" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Latitude</label>
					<div class="controls">
						<input type="text" id="basicinput"  value="{{ $value->lat }}" class="span8" placeholder="-6.597147" name="lat" required>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/last-login', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
			
			@endforeach
	</div>
</div>
<script>
	$(document).ready(function(){
		//DATETIME
		$('#datetime').datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm",
		});


		var dataUser= <?php echo $data['users_detail'];?>;
		$( "#usrDest" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: dataUser,
			focus: function( event, ui ) {
				$( "#usrDest" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
			console.log(ui.item);
				$( "#usrDest" ).val( ui.item.label );
				$("#usrDestValue").val(ui.item.id);  
				return false;
			}
		});
	});
</script>

@endsection