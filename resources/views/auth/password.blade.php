@extends('/auth/include/auth-header')
@section('content')

<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					@if (session('status'))
						<div class="alert alert-success">
							{{ session('status') }}
						</div>
					@endif

					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> There were some problems with your input.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
					<form class="form-vertical" role="form" method="POST" action="{{url('password/email')}}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="module-head">
							<h3>Reset Password</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<label class="col-md-4 control-label">E-Mail Address</label>
								<div class="controls row-fluid">
									<input type="email" class="span12" name="email" value="{{ old('email') }}" required>
								</div>
							</div>
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right">Send Password Reset Link</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2015 Mesjid Apps </b> All rights reserved.
		</div>
	</div>
@endsection
