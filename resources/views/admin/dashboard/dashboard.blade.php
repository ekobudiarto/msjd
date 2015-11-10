@extends('/admin/include/admin-header-footer')

@section('content')

<script src="{{ URL::asset('public/css-js/morris/raphael.min.js') }}" type="text/javascript"></script>
<script src="{{ URL::asset('public/css-js/morris/morris.js') }}" type="text/javascript"></script>
<link type="text/css" href="{{ URL::asset('public/css-js/morris/morris.css') }}" rel="stylesheet">
<link type="text/css" href="{{ URL::asset('public/css-js/lte/css/AdminLTE.css') }}" rel="stylesheet">
		

	  <div class="content">
		 <div class="btn-controls">
			<div class="btn-box-row row-fluid">
			   <div class="btn-box custom-btn-box big span6">
				  <div class="module-head box-header with-border">
					 <h3 class="box-title">Statistic User</h3>
					 <div class="box-tools pull-right">
						<input type="text" name="tahun_user" value="<?php echo $data['tahunUser'];?>" style="width:50px;margin-bottom:0px;" id="tahun_user" />
						<input type="hidden" value="{{ url("admin/dashboard") }}" id="url" />
						<input type="button" class="btn btn-info" value="Go" onclick="tahunUser()" />
					 </div>
				  </div>
				  <div class="panel panel-primary">
					 <div class="panel-body">
						<div id="morris-bar-chart"></div>
					 </div>
				  </div>
			   </div>
				  
			   <div class="btn-box custom-btn-box big span6">
				  <div class="panel panel-primary">
					  <div class="panel-body">
						  <div>
						  <div class="module-head box-header with-border">
							<h3 class="box-title">Latest Members</h3>
							<div class="box-tools pull-right">
							  <span class="label label-danger">8 New Members</span>
							</div>
						  </div><!-- /.box-header -->
						  <div class="box-body no-padding">
							<ul class="users-list clearfix">
							  <?php foreach ($data['latest'] as $key2 => $value2) {?>
								 <li>
								   <img src="{{ URL::asset('public/css-js/lte/img/user1-128x128.jpg') }}" alt="User Image">
								   <a class="users-list-name" href="#"><Alexander Pierce><?php echo $value2->name;?></a>
								   <span class="users-list-date"><Today><?php echo date("d M",strtotime($value2->created_at));?></span>
								 </li>
							  <?php }?>
							</ul><!-- /.users-list -->
						  </div><!-- /.box-body -->
						  <div class="box-footer text-center">
							<a href="{{ url('admin/users-detail') }}" class="uppercase">View All Users</a>
						  </div><!-- /.box-footer -->
						</div><!--/.box -->
					  </div>
				  </div>
			   </div>
			</div>
		 </div>
	  </div>
		 
	  <div class="module">
		 <div class="module-head">
			 <h3>Content Repost</h3>
		 </div>
		 <div class="module-body">
			 <table class="table">
			   <thead>
				  <tr>
					<th>Title</th>
					<th>Total</th>
				  </tr>
			   </thead>
			   <tbody>
				  <?php foreach($data['repost'] as $keyRep => $valRep){ ?>
					 <tr>
					   <td><?php echo $valRep->content_title;?></td>
					   <td><?php echo $valRep->count_repost;?></td>
					 </tr>
				  <?php }?>
			   </tbody>
			 </table>
		 </div>
	 </div>

	  <div class="content">
		 <div class="btn-box-row row-fluid">
			<a class="btn-box big span4" href="#"><i class=" icon-random"></i><b><?php echo $data['provider'][0]->count_provider;?></b>
				<p class="text-muted">
					<?php echo $data['provider'][0]->providerID;?></p>
			</a><a class="btn-box big span4" href="#"><i class="icon-user"></i><b><?php echo $data['deviceVersion'][0]->count_deviceVersion;?></b>
				<p class="text-muted">
					<?php echo $data['deviceVersion'][0]->deviceVersion;?></p>
			</a><a class="btn-box big span4" href="#"><i class="icon-money"></i><b><?php echo $data['deviceBrand'][0]->count_deviceBrand;?></b>
				<p class="text-muted">
					<?php echo $data['deviceBrand'][0]->deviceBrand;?></p>
			</a>
		 </div>
	  </div>
   
<!-- CHART -->
<script>
   function tahunUser() {
	  var tahun = $("#tahun_user").val();
	  window.location = $("#url").val()+"?tahunUser="+tahun;
   }
   var bulan = new Array();
   bulan[1] = "Jan";
   bulan[2] = "Feb";
   bulan[3] = "Mar";
   bulan[4] = "Apr";
   bulan[5] = "May";
   bulan[6] = "Jun";
   bulan[7] = "Jul";
   bulan[8] = "Aug";
   bulan[9] = "Sep";
   bulan[10] = "Oct";
   bulan[11] = "Nov";
   bulan[12] = "Dec";

   Morris.Bar({
	   element: 'morris-bar-chart',
	   data: [
		 <?php foreach ($data['month'] as $key => $value) { ?>
			{
				month: bulan[<?php echo $value->MONTH;?>],
				total: <?php echo $value->COUNT;?>
			},
		 <?php } ?>
	   ],
	   xkey: 'month',
	   ykeys: ['total'],
	   labels: ['Total'],
	   barRatio: 100,
	   xLabelAngle: 35,
	   hideHover: 'auto',
	   resize: true
   });
</script>

@endsection