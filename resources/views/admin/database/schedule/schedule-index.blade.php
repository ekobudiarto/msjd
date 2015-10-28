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
        <b>Schedule</b>
        {!! Html::link('admin/schedule/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}
    </div>
    <div class="module-body">
        <div>
        <form action="{{ url("admin/schedule/search") }}" method="get">
            <select name="select">
                <option value="schedule_title">Title</option>
                <option value="schedule_type_name">Type</option>
            </select>
            <input type="text" name="query" />
            <input type="submit" value="Search" />
        </form>
        </div>
        <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-bordered table-condensed"
            width="100%">
            <thead>
                <tr>
                    <th>
                        No
                    </th>
                    <th>
                        Schedule Title
                    </th>
                    <th>
                        Schedule Type Name
                    </th>
                    <th>
                        Schedule Date Start
                    </th>
                    <th>
                        Schedule Date End
                    </th>
                    <th>
                        Schedule Media Name
                    </th>
                    <th>
                        Schedule Users Creator
                    </th>
                    <th>
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['schedule'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->schedule_title }}</td>
                        <td>{{ $value->schedule_type_name }}</td>
                        <td>{{ $value->schedule_date_start }}</td>
                        <td>{{ $value->schedule_date_end }}</td>
                        <td>{{ $value->schedule_media_id }}</td>
                        <td>{{ $value->users_name_creator }}</td>

                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/schedule/' . $value->schedule_id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/schedule/' . $value->schedule_id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/schedule/' . $value->schedule_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-small btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                @include('admin.include.pagination', ['paginator' => $data['schedule']])
            </tbody>
        </table>
    </div>
</div>

@endsection