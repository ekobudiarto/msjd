@extends('/admin/include/admin-header-footer')

@section('content')

<div class="module">
    
    @if(Session::has('success'))
    <div class="alert alert-success">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Well done!</strong> {{ Session::get('success') }} 
    </div>          
    @elseif(Session::has('warning'))
    <div class="alert">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Done!</strong> {{ Session::get('warning') }} 
    </div>
    @elseif(Session::has('failed'))
    <div class="alert alert-error">
        <button type="button" class="close" data-dismiss="alert">×</button>
        <strong>Oh snap!</strong> {{ Session::get('failed') }}  
    </div>
    @endif


    <div class="module-head">
        <b>Banned Report</b>
		{!! Html::link('admin/banned-report/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}
    </div>
    <div class="module-body">
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-condensed"
            width="100%">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        User
                    </th>
                    <th>
                        Content
                    </th>
                    <th>
                        Users Target
                    </th>
                    <th>
                        Report Message
                    </th>
                    <th>
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['banned_report'] as $key => $value)
                    <tr>
                        <td>{{ $value->banned_report_id }}</td>
                        <td>{{ $value->users_name_by }}</td>
                        <td>{{ $value->content_id }}</td>
                        <td>{{ $value->users_name_dest }}</td>
                        <td>{{ $value->banned_report_message }}</td>

                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/banned-report/' . $value->banned_report_id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/banned-report/' . $value->banned_report_id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/banned-report/' . $value->banned_report_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-small btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                @include('admin.include.pagination', ['paginator' => $data['banned_report']])
            </tbody>
        </table>
    </div>
</div>

@endsection