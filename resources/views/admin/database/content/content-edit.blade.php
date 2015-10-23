@extends('/admin/include/admin-header-footer')

@section('content')
<div class="module">
	<div class="module-head">
		<h3>Forms Content Edit</h3>
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
						<textarea class="span8" rows="5" name="content_title" placeholder="text">{{ $value->content_title }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Headline</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="content_headline" placeholder="text">{{ $value->content_headline }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Detail</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="content_detail" placeholder="text">{{ $value->content_detail }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Media ID</label>
					<div class="controls">
						<textarea class="span8" rows="5" name="content_media_id" placeholder="text">{{ $value->content_media_id }}</textarea>
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content users uploader</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="integer" class="span8" name="content_users_uploader" value="{{ $value->content_users_uploader }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Last Editor</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="integer" class="span8" name="content_last_editor" value="{{ $value->content_last_editor }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Date Insert</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Date" class="span8" name="content_date_insert" value="{{ $value->content_date_insert }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Date Update</label>
					<div class="controls">
						<input type="text" id="datepicker" placeholder="Date" class="span8" name="content_date_update" value="{{ $value->content_date_update }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Date Expired</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="Date" class="span8" name="content_date_expired" value="{{ $value->content_date_expired }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content Category</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="integer" class="span8" name="content_category_id" value="{{ $value->content_category_id }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content repost from</label>
					<div class="controls">
						<input type="text" id="basicinput" placeholder="integer" class="span8" name="content_repost_from" value="{{ $value->content_repost_from }}">
					</div>
				</div>
				<div class="control-group">
					<label class="control-label" for="basicinput">Content publish</label>
					<div class="controls">
						<select name="content_publish">
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
						<button type="submit" class="btn btn-small btn-success">Submit</button>
						{!! Html::link('admin/content', 'Back', array('class' => 'btn btn-small btn-info'), false) !!}
					</div>
				</div>
			
			{!! Form::close() !!}
			
			@endforeach
	</div>
</div>

@endsection