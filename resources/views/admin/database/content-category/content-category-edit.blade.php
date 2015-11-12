@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Edit Content Category</h3>
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

			@foreach($data['dataContentCategory'] as $key => $value)
			
			{!! Form::open(array('url' => 'admin/content-category/'.$value->content_category_id, 'files' => false, 'class' => 'form-horizontal row-fluid')) !!}
			
				<input name="_method" type="hidden" value="PUT">
				<input type="hidden" name="_token" value="{!! csrf_token() !!}">
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category Title</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="number" class="span8" name="content_category_title" value="{{ $value->content_category_title }}" required>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category Description</label>
					<div class="controls">
						<textarea class="span8" id="editor" rows="5" name="content_category_description" required>{{ $value->content_category_description }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager ID</label>
					<div class="controls">
						<input type="text" id="Media" value="<?PHP echo $data['media_manager_name'] ?>"  style="width: 65.812%;" required />
						<input type="hidden" name="media_manager_id" id="idMedia" value="{{ $value->media_manager_id}} "/>
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/content-category', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>

			{!! Form::close() !!}
				
			@endforeach
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