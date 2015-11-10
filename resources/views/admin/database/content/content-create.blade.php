@extends('/admin/include/admin-header-footer')

@section('content')
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input-facebook.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/css-js/scripts/jquery.tokeninput.js') }}" type="text/javascript"></script>

<div class="module">
	<div class="module-head">
		<h3>Forms Content</h3>
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

			{!! Form::open(array('url' => 'admin/content', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
			<form class="form-horizontal row-fluid" role="form" method="POST" action="/admin/content">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Title</label>
					<div class="controls">
						<textarea class="span8" id="editor" rows="5" name="content_title" placeholder="text"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Headline</label>
					<div class="controls">
						<textarea class="span8" rows="5" id="editor1" name="content_headline" placeholder="text"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Detail</label>
					<div class="controls">
						<textarea class="span8" rows="5" id="editor2" name="content_detail" placeholder="text"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Media ID</label>
					<div class="controls">
						<!--<input type="text" class="automedia" onchange="getidAll(this)" placeholder="it should media id, but you can search by name media" style="width: 65.812%;">
						<input type="text" class="tempmediaid" name="content_media_id" style="width: 65.812%;margin-top:10px;" required>-->
						
						<input type="text" id="tags" style="width: 65.812%;" />
						<input type="hidden" class="tagsValue" name="content_media_id" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content users uploader</label>
					<div class="controls">
						<!--<input type="text" id="autouser"  onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" name="content_users_uploader" style="width: 65.812%;" required>-->
						
						<input type="text" id="uploader" style="width: 65.812%;" />
						<input type="hidden" name="content_users_uploader" id="uploaderValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Last Editor</label>
					<div class="controls">
						<!--<input type="text" id="autouser2"  onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" name="content_last_editor" style="width: 65.812%;" required>-->
						
						<input type="text" id="lasteditor" style="width: 65.812%;" />
						<input type="hidden" name="content_last_editor" id="lasteditorValue" />
					</div>
				</div>
				<div class="control-group" style="display:none">
					<label class="control-label" for="basicinput">Content Date Insert</label>
					<div class="controls">
						<input type="text" id="dateinput" placeholder="Date" class="span8" name="content_date_insert">
					</div>
				</div>
				<div class="control-group" style="display:none">
					<label class="control-label" for="basicinput">Content Date Update</label>
					<div class="controls">
						<input type="text" id="dateupdate" placeholder="Date" class="span8" name="content_date_update">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Date Expired</label>
					<div class="controls">
						<input type="text" id="dateexpired" placeholder="Date" class="span8" name="content_date_expired">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category</label>
					<div class="controls">
						<!--<input type="text" id="autocontencategory"  onchange="getid(this)" placeholder="you can search by content category name" class="autocontencategory" name="content_category_id" style="width: 65.812%;" required>-->
						
						<input type="text" id="ccat" style="width: 65.812%;" />
						<input type="hidden" name="content_category_id" id="ccatValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content repost from</label>
					<div class="controls">
						<!--<input type="text" id="autoconten"  onchange="getid(this)" placeholder="it should content id, but you can search by name" class="autocontent" name="content_repost_from" style="width: 65.812%;" required>-->
						
						<input type="text" id="content" style="width: 65.812%;" />
						<input type="hidden" name="content_repost_from" id="contentValue" />
					</div>
				</div>
					
				<div class="control-group">
					<label class="control-label" for="basicinput">Content publish</label>
					<div class="controls">
						<!--<input type="text" id="basicinput" placeholder="varchar" class="span8" name="content_publish">-->
						{!! Form::select('content_publish', ['0' => 'No','1' => 'Yes']) !!}
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/content', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
				
			{!! Form::close() !!}
	</div>
</div>
<script type="text/javascript">

$(document).ready(function() {

		//MULTI AUTOCOMPLETE
		//var data = [{"id":"1","name":"Wife Swap"},{"id":"2","name":"Trading Spouses"},{"id":"e38303c71d98ba5afa8d42509e2ddd5b","name":"Trailer Park Boys"},{"id":"2499f2cb8636329169713e59961e497d","name":"Top Gear Australia"},{"id":"631b550716c21bcb342fb18e129a3e8e","name":"Torchwood"},{"id":"7cfc317ffb8ba69ea57c9ca10113e7db","name":"Tracey Takes On..."},{"id":"aa2d4f06e909219ea56940a32582abd8","name":"Top Gear"},{"id":"39c0b25a55e3a405b322125c1f220d3f","name":"Top Design"},{"id":"a0dd745e07064d2b70c92b853c4c2505","name":"Top Chef"},{"id":"bf62e98997138b1e9bebdfe51a52af9f","name":"Tom and Jerry"},{"id":"f0edf0f1a3017872c083da14bb4211e8","name":"Tom and Jerry Kids Show"}];
		var data = <?php echo $data['media_manager'];?>;
		$("#tags").tokenInput(data, {
			preventDuplicates: true,
			theme: "facebook"
		});
		$("#tags").on('change',function(){
			$(".tagsValue").val($('#tags').val());
		});
		
		//SINGLE AUTOCOMPLETE
		var dataUploader= <?php echo $data['users_detail'];?>;
		$( "#uploader" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: dataUploader,
			focus: function( event, ui ) {
				$( "#uploader" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				$( "#uploader" ).val( ui.item.label );
				$("#uploaderValue").val(ui.item.id);  
				return false;
			}
		});
		
		var dataEditor= <?php echo $data['users_detail'];?>;
		$( "#lasteditor" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: dataEditor,
			focus: function( event, ui ) {
				$( "#lasteditor" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				$( "#lasteditor" ).val( ui.item.label );
				$("#lasteditorValue").val(ui.item.id);  
				return false;
			}
		});
		
		var dataCat= <?php echo $data['content_category'];?>;
		$( "#ccat" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: dataCat,
			focus: function( event, ui ) {
				$( "#ccat" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				$( "#ccat" ).val( ui.item.label );
				$("#ccatValue").val(ui.item.id);  
				return false;
			}
		});
		
		var dataContent= <?php echo $data['content'];?>;
		$( "#content" )
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
				$( "#content" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
				$( "#content" ).val( ui.item.label );
				$("#contentValue").val(ui.item.id);  
				return false;
			}
		});
		
		
		//DATETIME
		$('#dateinput').datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm",
		});
		$('#dateupdate').datetimepicker({
			dateFormat: "yy-mm-dd",
			timeFormat: "HH:mm",
		});
		$('#dateexpired').datetimepicker({
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