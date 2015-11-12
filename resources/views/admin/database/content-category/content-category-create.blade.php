@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Content Category</h3>
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

			{!! Form::open(array('url' => 'admin/content-category', 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
			
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category Title</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Title" class="span8" required name="content_category_title">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category Description</label>
					<div class="controls">
						<textarea class="span8" id="editor" rows="5" required name="content_category_description"></textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager ID</label>
					<div class="controls">
						
						<input type="text" id="Media" required placeholder="it should user id, but you can search by name" style="width: 65.812%;" />
						<input type="hidden" name="media_manager_id" id="idMedia" />
						
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/content-category', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			{!! Form::close() !!}
	</div>
</div>

<script>
$(document).ready(function(){
	var dataMedia= <?php echo $data['media_manager'];?>;
	$( "#Media" )
		.bind( "keydown", function( event ) {
			if ( event.keyCode === $.ui.keyCode.TAB &&
				$( this ).autocomplete( "instance" ).menu.active ) {
			  event.preventDefault();
			}
		})
		.autocomplete({
			minLength: 0,
			source: dataMedia,
			focus: function( event, ui ) {
				$( "#Media" ).val( ui.item.label );
				return false;
			},
			select: function( event, ui ) {
			console.log(ui.item);
				$( "#Media" ).val( ui.item.label );
				$("#idMedia").val(ui.item.id);  
				return false;
			}
		});
});
</script>

@endsection