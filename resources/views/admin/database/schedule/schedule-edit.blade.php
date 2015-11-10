@extends('/admin/include/admin-header-footer')

@section('content')
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input-facebook.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/css-js/scripts/jquery.tokeninput.js') }}" type="text/javascript"></script>

<div class="module">
	<div class="module-head">
		<h3>Forms Edit Schedule</h3>
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

			@foreach($data['dataschedule'] as $key => $value)
			
			{!! Form::open(array('url' => 'admin/schedule/'.$value->schedule_id, 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Title</label>
					<div class="controls">
						<textarea class="span8" rows="5" id="editor" placeholder="text" name="schedule_title">{{ $value->schedule_title }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Type</label>
					<div class="controls">
						<!--<input type="text" id="autoscheduletype" value="{{ $value->schedule_type_id }}" name="schedule_type_id" class="autoscheduletype" onchange="getid(this)" placeholder="it should schedule type id, but you can search by name" style="width: 65.812%;" required>-->
						<input type="text" id="sType" style="width: 65.812%;" />
						<input type="hidden" name="schedule_type_id" id="sTypeValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Creator</label>
					<div class="controls">
						<!--<input type="text" id="autouser" value="{{ $value->schedule_users_creator }}" name="schedule_users_creator" onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" style="width: 65.812%;" required>-->
						<input type="text" id="usrCreator" style="width: 65.812%;" />
						<input type="hidden" name="schedule_users_creator" id="usrCreatorValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Users Source</label>
					<div class="controls">
						<!--<input type="text" id="autouser2" value="{{ $value->schedule_users_source }}" name="schedule_users_source" onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" style="width: 65.812%;" required>-->
						<input type="text" id="usrSource" style="width: 65.812%;" />
						<input type="hidden" name="schedule_users_source" id="usrSourceValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date Start</label>
					<div class="controls">
						<input type="text" id="datestart" placeholder="Schedule Date Start" class="span8" name="schedule_date_start" value="{{ $value->schedule_date_start }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Date End</label>
					<div class="controls">
						<input type="text" id="dateend" placeholder="Schedule Date End" class="span8" name="schedule_date_end" value="{{ $value->schedule_date_end }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Description</label>
					<div class="controls">
						<textarea class="span8" rows="5" id="editor1" placeholder="Schedule Description" name="schedule_description">{{ $value->schedule_description }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Headline</label>
					<div class="controls">
						<textarea class="span8" rows="5" id="editor2" placeholder="Schedule Description" name="schedule_description">{{ $value->schedule_headline }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Repeat</label>
					<div class="controls">
						<input type="text" class="span8" name="schedule_repeat" value="{{ $value->schedule_repeat}}" >
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Media ID</label>
					<div class="controls">
						<!--<input type="text" class="automedia" onchange="getidAll(this)" placeholder="it should media id, but you can search by name media" style="width: 65.812%;">
						<input type="text" class="tempmediaid" value="{{ $value->schedule_media_id }}" name="schedule_media_id" style="width: 65.812%;margin-top:10px;" required>-->
						
						<input type="text" id="mediaId" style="width: 65.812%;" />
						<input type="hidden" class="mediaIdValue" name="schedule_media_id" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Schedule Publish</label>
					<div class="controls">
						<select class="span8" name="schedule_publish">
						 		@if( $value->schedule_publish == 1 )
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
						{!! Html::link('admin/schedule', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			
			{!! Form::close() !!}
			
			@endforeach
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
		var med_man = "<?php echo $data['dataIdMediaManager'];?>";
		$(".mediaIdValue").val(med_man);
		
		<?php
			foreach($data['dataMediaManager'] as $key => $value){
		?>
				$("#mediaId").tokenInput("add", {id: "<?php echo $key;?>", name: "<?php echo $value;?>"});
		<?php
			}
		?>
		
		
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
		$( "#sType" ).val('<?php echo $data["dataScheduleType"]->value;?>');
		$("#sTypeValue").val('<?php echo $data["dataScheduleType"]->id;?>');
		
		
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
		$( "#usrCreator" ).val('<?php echo $data["dataUsers"]->value;?>');
		$("#usrCreatorValue").val('<?php echo $data["dataUsers"]->id;?>');
		
		
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
		$( "#usrSource" ).val('<?php echo $data["dataUsers2"]->value;?>');
		$("#usrSourceValue").val('<?php echo $data["dataUsers2"]->id;?>');
		
		
	
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