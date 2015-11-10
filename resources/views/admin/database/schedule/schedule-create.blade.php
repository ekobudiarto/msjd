@extends('/admin/include/admin-header-footer')

@section('content')
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input-facebook.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/css-js/scripts/jquery.tokeninput.js') }}" type="text/javascript"></script>

<div class="module">
	<div class="module-head">
		<h3>Forms Add Schedule</h3>
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
			
			{!! Form::open(array('url' => 'admin/schedule', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Title</label>
					<div class="controls">
						<textarea class="span8" id="editor" rows="5" placeholder="text" name="schedule_title"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type</label>
					<div class="controls">
						<!--<input type="text" id="autoscheduletype" name="schedule_type_id" class="autoscheduletype" onchange="getid(this)" placeholder="it should schedule type id, but you can search by name" style="width: 65.812%;" required>-->
						<input type="text" id="sType" style="width: 65.812%;" />
						<input type="hidden" name="schedule_type_id" id="sTypeValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Creator</label>
					<div class="controls">
						<!--<input type="text" id="autouser" name="schedule_users_creator" onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" style="width: 65.812%;" required>-->
						<input type="text" id="usrCreator" style="width: 65.812%;" />
						<input type="hidden" name="schedule_users_creator" id="usrCreatorValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Source</label>
					<div class="controls">
						<!--<input type="text" id="autouser2" name="schedule_users_source" onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" style="width: 65.812%;" required>-->
						<input type="text" id="usrSource" style="width: 65.812%;" />
						<input type="hidden" name="schedule_users_source" id="usrSourceValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date Start</label>
					<div class="controls">
						<input type="date" id="datestart" placeholder="Datetime" class="span8" name="schedule_date_start">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date End</label>
					<div class="controls">
						<input type="text" id="dateend" placeholder="Datetime" class="span8" name="schedule_date_end">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Description</label>
					<div class="controls">
						<textarea class="span8" id="editor1" rows="5" placeholder="text" name="schedule_description"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Headline</label>
					<div class="controls">
						<textarea class="span8" rows="5"  id="editor2" placeholder="text" name="schedule_headline"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Media ID</label>
					<div class="controls">
						<input type="text" id="mediaId" style="width: 65.812%;" />
						<input type="hidden" class="mediaIdValue" name="schedule_media_id" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Repeat</label>
					<div class="controls">
						<input type="text" class="span8" name="schedule_repeat">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Publish</label>
					<div class="controls">
						{!! Form::select('schedule_publish', ['0' => 'No','1' => 'Yes']) !!}
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/schedule', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
	</div>
</div>
<script type="text/javascript">
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
		
		
		//SINGLE AUTOCOMPLETE
		var datasType= <?php echo $data['schedule_typeAuto'];?>;
		$( "#sType" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: datasType,
			focus: function( event, ui ) {
				$( "#sType" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
			console.log(ui.item);
				$( "#sType" ).val( ui.item.label );
				$("#sTypeValue").val(ui.item.id);  
				return false;
			}
		});
		
		var datausrCreator= <?php echo $data['users_detail'];?>;
		$( "#usrCreator" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: datausrCreator,
			focus: function( event, ui ) {
				$( "#usrCreator" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
			console.log(ui.item);
				$( "#usrCreator" ).val( ui.item.label );
				$("#usrCreatorValue").val(ui.item.id);  
				return false;
			}
		});
		
		var datausrSource= <?php echo $data['users_detail'];?>;
		$( "#usrSource" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: datausrSource,
			focus: function( event, ui ) {
				$( "#usrSource" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
			console.log(ui.item);
				$( "#usrSource" ).val( ui.item.label );
				$("#usrSourceValue").val(ui.item.id);  
				return false;
			}
		});
	
	
		//DATETIME
		$('#datestart').datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm",
		});
		$('#dateend').datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm",
		});
		
		$('input:text').bind({

		});
	
		$(".automedia").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getmediaid") }}',
		});
		$(".autocontent").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getcontenttitle") }}',
		});
		$(".autouser").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getusername") }}',
		});
		$(".autocontencategory").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getcategoryid") }}',
		});
		$(".autoscheduletype").autocomplete({
			minLength:1,
			autofocus: true,
			source: '{{ url("admin/autocomplete/getscheduletype") }}',
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
		var temp = $(".tempmediaid").val();
		if (temp == "") {
            $(".tempmediaid").val(nilai);
        }
		else{
			$(".tempmediaid").val(temp+","+nilai);
		}
		obj.value = "";
	}


</script>

@endsection