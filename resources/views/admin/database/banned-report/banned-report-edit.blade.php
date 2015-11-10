@extends('/admin/include/admin-header-footer')

@section('content')
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input-facebook.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/css-js/scripts/jquery.tokeninput.js') }}" type="text/javascript"></script>

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
						<!--<input type="text" id="basicinput" placeholder="number" class="span8" name="users_by" value="{{ $value->users_by }}">-->
						<input type="text" id="usrBy" placeholder="it should user id, but you can search by name" style="width: 65.812%;" />
						<input type="hidden" name="users_by" id="usrByValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content ID</label>
					<div class="controls">
						<!--<input type="text" id="basicinput" placeholder="number" class="span8" name="content_id" value="{{ $value->content_id }}">-->
						<input type="text" id="contentId" placeholder="it should content id, but you can search by name" style="width: 65.812%;" />
						<input type="hidden" name="content_id" id="contentIdValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Users Destination</label>
					<div class="controls">
						<!--<input type="text" id="basicinput" placeholder="number" class="span8" name="users_dest" value="{{ $value->users_dest }}">-->
						<input type="text" id="usrDest" placeholder="it should user id, but you can search by name" style="width: 65.812%;" />
						<input type="hidden" name="users_dest" id="usrDestValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Banned Report Message</label>
					<div class="controls">
						<textarea class="span8" rows="5" id="editor" name="banned_report_message">{{ $value->banned_report_message }}</textarea>
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
<script type="text/javascript">
	$(document).ready(function(){
		
		var dataUser= <?php echo $data['users_detail'];?>;
		$( "#usrBy" )
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
				$( "#usrBy" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
			console.log(ui.item);
				$( "#usrBy" ).val( ui.item.label );
				$("#usrByValue").val(ui.item.id);  
				return false;
			}
		});
		$( "#usrBy" ).val('<?php echo $data["dataUsers"]->value;?>');
		$("#usrByValue").val('<?php echo $data["dataUsers"]->id;?>');
		
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
		$( "#usrDest" ).val('<?php echo $data["dataUsers2"]->value;?>');
		$("#usrDestValue").val('<?php echo $data["dataUsers2"]->id;?>');
		
		var dataContent= <?php echo $data['content'];?>;
		$( "#contentId" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: dataContent,
			focus: function( event, ui ) {
				$( "#contentId" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
			console.log(ui.item);
				$( "#contentId" ).val( ui.item.label );
				$("#contentIdValue").val(ui.item.id);  
				return false;
			}
		});
		$( "#contentId" ).val('<?php echo $data["contentId"]->value;?>');
		$("#contentIdValue").val('<?php echo $data["contentId"]->id;?>');

	});

</script>
@endsection