@extends('/admin/include/admin-header-footer')

@section('content')

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
						<textarea class="span8" rows="5" name="content_title" placeholder="text"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Headline</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="content_headline" placeholder="text"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Detail</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="content_detail" placeholder="text"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Media ID</label>
					<div class="controls">
						<input type="text" class="automedia" onchange="getidAll(this)" placeholder="it should media id, but you can search by name media" style="width: 65.812%;">
						<input type="text" class="tempmediaid" name="content_media_id" style="width: 65.812%;margin-top:10px;" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content users uploader</label>
					<div class="controls">
						<input type="text" id="autouser"  onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" name="content_users_uploader" style="width: 65.812%;" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Last Editor</label>
					<div class="controls">
						<input type="text" id="autouser2"  onchange="getid(this)" placeholder="it should user id, but you can search by name" class="autouser" name="content_last_editor" style="width: 65.812%;" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Date Insert</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Date" class="span8" name="content_date_insert" value="<?php echo date('Y-m-d h:i:s');?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Date Update</label>
					<div class="controls">
						<input type="text" id="datepicker" placeholder="Date" class="span8" name="content_date_update" value="<?php echo date('Y-m-d h:i:s');?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Date Expired</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Date" class="span8" name="content_date_expired" value="<?php echo date('Y-m-d h:i:s',strtotime('+3 days'));?>">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category</label>
					<div class="controls">
						<input type="text" id="autocontencategory"  onchange="getid(this)" placeholder="you can search by content category name" class="autocontencategory" name="content_category_id" style="width: 65.812%;" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content repost from</label>
					<div class="controls">
						<input type="text" id="autoconten"  onchange="getid(this)" placeholder="it should content id, but you can search by name" class="autocontent" name="content_repost_from" style="width: 65.812%;" required>
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
	$(document).ready(function(){
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