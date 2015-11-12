@extends('/admin/include/admin-header-footer')

@section('content')
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('public/css-js/css/token-input-facebook.css') }}" rel="stylesheet">
<script src="{{ URL::asset('public/css-js/scripts/jquery.tokeninput.js') }}" type="text/javascript"></script>
	
<div class="module">
	<div class="module-head">
		<h3>Show Content </h3>
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
			
			@foreach($data['content'] as $key => $value)
			
			{!! Form::open(array('url' => 'admin/content/'.$value->content_id, 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Title</label>
					<div class="controls">
						<textarea class="span8" disabled rows="5" id="editor" name="content_title" placeholder="text">{{ $value->content_title }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Headline</label>
					<div class="controls">
						<textarea class="span8" disabled id="editor1" rows="5" name="content_headline" placeholder="text">{{ $value->content_headline }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Detail</label>
					<div class="controls">
						<textarea class="span8" disabled id="editor2" rows="5" name="content_detail" placeholder="text">{{ $value->content_detail }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Media ID</label>
					<div class="controls">
						<!--<input type="text" class="automedia" onchange="getidAll(this)" placeholder="it should media id, but you can search by name media" style="width: 65.812%;">
						<input type="text" class="tempmediaid" name="content_media_id" value="{{ $value->content_media_id }}" style="width: 65.812%;margin-top:10px;" disabled>-->
						
						<input type="text" disabled id="tags" style="width: 65.812%;"  />
						<input type="hidden" class="tagsValue" name="content_media_id"  />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content users uploader</label>
					<div class="controls">
						<!--<input type="text" id="autouser"  placeholder="it should user id, but you can search by name" class="autouser" name="content_users_uploader" style="width: 65.812%;" disabled>-->
						<input type="text" disabled id="uploader" style="width: 65.812%;" />
						<input type="hidden" name="content_users_uploader" id="uploaderValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" disabled for="basicinput">Content Last Editor</label>
					<div class="controls">
						<!--<input type="text" id="autouser2"  onchange="getid(this)" value="{{ $value->content_last_editor }}" placeholder="it should user id, but you can search by name" class="autouser" name="content_last_editor" style="width: 65.812%;" disabled>-->
						<input type="text" disabled id="lasteditor"style="width: 65.812%;" />
						<input type="hidden" name="content_last_editor" id="lasteditorValue" />
					</div>
				</div>
				<div class="control-group" style="display:none">
					<label class="control-label" for="basicinput">Content Date Insert</label>
					<div class="controls">
						<input type="text" id="dateinput" placeholder="Date" class="span8" name="content_date_insert" value="{{ $value->content_date_insert }}">
					</div>
				</div>
				<div class="control-group" style="display:none">
					<label class="control-label" for="basicinput">Content Date Update</label>
					<div class="controls">
						<input type="text" id="dateupdate" placeholder="Date" class="span8" name="content_date_update" value="<?PHP echo date('Y-m-d H:i:s');?>" >
					</div>
				</div>
				<div class="control-group" >
					<label class="control-label" for="basicinput">Content Date Expired</label>
					<div class="controls">
						<input type="text" disabled id="dateexpired" placeholder="Date" class="span8" name="content_date_expired" value="{{ $value->content_date_expired }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category</label>
					<div class="controls">
						<!--<input type="text" id="autocontencategory"  onchange="getid(this)" value="{{ $value->content_category_id }}" placeholder="you can search by content category name" class="autocontencategory" name="content_category_id" style="width: 65.812%;" disabled>-->
						<input type="text" disabled id="ccat" style="width: 65.812%;" />
						<input type="hidden" name="content_category_id" id="ccatValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content repost from</label>
					<div class="controls">
						<!--<input type="text" id="autoconten"  onchange="getid(this)" value="{{ $value->content_repost_from }}" placeholder="it should content id, but you can search by name" class="autocontent" name="content_repost_from" style="width: 65.812%;" disabled>-->
						<input type="text" disabled id="content" style="width: 65.812%;" />
						<input type="hidden" name="content_repost_from" id="contentValue" />
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content publish</label>
					<div class="controls">
						<select disabled name="content_publish">
							<option value="">Pilih</option>
						@if( $value->content_publish == 0)
							<option selected value="0">No</option>
							<option value="1">Yes</option>
						@else
							<option value="0">No</option>
							<option selected value="1">Yes</option>
						@endif
						</select>
						<!--<input type="text" id="basicinput" placeholder="varchar" class="span8" name="content_publish" value="{{ $value->content_publish }}">-->
						<!--{!! Form::select('content_publish', ['0' => 'No','1' => 'Yes']) !!}-->
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						{!! Html::link('admin/content', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			
			{!! Form::close() !!}
			
			@endforeach
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		var data = <?php echo json_encode($data['media_manager']);?>;
		$("#tags").tokenInput(data, {
			preventDuplicates: true,
			theme: "facebook"
		});
		$("#tags").on('change',function(){
			$(".tagsValue").val($('#tags').val());
		});
		var med_man = "<?php echo $data['dataIdMediaManager'];?>";
		$(".tagsValue").val(med_man);
		
		<?php
			foreach($data['dataMediaManager'] as $key => $value){
		?>
				$("#tags").tokenInput("add", {id: "<?php echo $key;?>", name: "<?php echo $value;?>"});
		<?php
			}
		?>
		
		
		//SINGLE AUTOCOMPLETE
		var dataUploader= <?php echo json_encode($data['users_detail']);?>;
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

		<?PHP if($data['dataUsers'] != ''){ ?>
		$( "#uploader" ).val('<?php echo $data["dataUsers"]->value;?>');
		$("#uploaderValue").val('<?php echo $data["dataUsers"]->id;?>');
		<?PHP } ?>
		
		
		var dataEditor= <?php echo json_encode($data['users_detail']);?>;
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

		<?PHP if($data['dataUsers2'] != ''){ ?>
		$( "#lasteditor" ).val('<?php echo $data["dataUsers2"]->value;?>');
		$("#lasteditorValue").val('<?php echo $data["dataUsers2"]->id;?>');
		<?PHP }?>


		var dataCat= <?php echo json_encode($data['content_category']);?>;
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
		<?PHP if($data['dataContentCategory'] != ''){ ?>
		$( "#ccat" ).val('<?php echo $data["dataContentCategory"]->value;?>');
		$("#ccatValue").val('<?php echo $data["dataContentCategory"]->id;?>');
		<?PHP } ?>
		
		var dataContent= <?php echo json_encode($data['content_from']);?>;
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
		

		<?PHP if($data['dataContentFrom'] != ''){ ?>
		$( "#content" ).val("<?php echo preg_replace('/[\r\n]+/', '', $data['dataContentFrom']->value);?>");
		$("#contentValue").val('<?php echo $data["dataContentFrom"]->id;?>');
		<?PHP } ?>
	
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