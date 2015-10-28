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
        <b>Users Status</b>
        {!! Html::link('admin/users-status/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}

    </div>
    <div class="module-body">
        <div>
            <form action="{{ url("admin/users-status/search") }}" method="get">
                <select name="select">
                    <option value="users_status_title">Status Title</option>
                    <option value="users_status_desc">Desc</option>
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
                        Status Title
                    </th>
                    <th>
                        Status Desc
                    </th>
                    <th>
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['users_status'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->users_status_title }}</td>
                        <td>{{ $value->users_status_desc }}</td>

                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/users-status/' . $value->users_status_id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/users-status/' . $value->users_status_id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/users-status/' . $value->users_status_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-small btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                @include('admin.include.pagination', ['paginator' => $data['users_status']])
            </tbody>
        </table>
    </div>
</div>

@endsection