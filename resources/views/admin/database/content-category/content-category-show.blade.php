@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
	<div class="module-head">
		<h3>Forms Show Content Category</h3>
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
						<input type="text" disabled id="basicinput" placeholder="number" class="span8" name="content_category_title" value="{{ $value->content_category_title }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category Description</label>
					<div class="controls">
						<textarea class="span8" disabled rows="5" name="content_category_description">{{ $value->content_category_description }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Media Manager ID</label>
					<div class="controls">
						<input type="text" disabled value="{{ $data['media_manager_name'] }}">
					</div>
				</div>
				<div class="control-group">
					<div class="controls">
						{!! Html::link('admin/content-category', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
				
			{!! Form::close() !!}
				
			@endforeach
	</div>
</div>

@endsection