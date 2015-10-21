@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
   <center><h1>Dashboard is under construction</h1></center>
   <div style="margin-left:50px">
	   menu that can be accessed: 
	   <ul>
	        <li>Database</li>
	            <ul>
	                <li><a href="<?PHP echo url()?>/admin/banned-report"><i class="icon-inbox"></i>Banned Report </a></li>
	                <li><a href="<?PHP echo url()?>/admin/content"><i class="icon-inbox"></i>Content </a></li>
	                <li><a href="<?PHP echo url()?>/admin/content-category"><i class="icon-inbox"></i>Content Category </a></li>
	                <li><a href="<?PHP echo url()?>/admin/media-manager"><i class="icon-inbox"></i>Media Manager </a></li>
	                <li><a href="<?PHP echo url()?>/admin/schedule"><i class="icon-inbox"></i>Schedule </a></li>
	                <li><a href="<?PHP echo url()?>/admin/schedule-type"><i class="icon-inbox"></i>Schedule Type</a></li>
	                <li><a href="<?PHP echo url()?>/admin/users"><i class="icon-inbox"></i>Users </a></li>
	                <li><a href="<?PHP echo url()?>/admin/users-group"><i class="icon-inbox"></i>Users Group </a></li>
	                <li><a href="<?PHP echo url()?>/admin/users-status"><i class="icon-inbox"></i>Users Status </a></li>
	            </ul>
	   </ul>
   </div>
</div>

@endsection