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
        {!! Html::link('admin/users-detail/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}

    </div>
    <div class="module-body">
        @include('admin.include.pagination', ['paginator' => $data['users-detail']])
        <div style="float:right;">
        <form action="{{ url("admin/users-detail/search") }}" method="get">
            <select name="select">
                <option value="users_name">Users Name</option>
                <option value="users_email">Users Email</option>
            </select>
            <input type="text" name="query" />
            <input type="submit" class="btn" style="margin-bottom:10px" value="Search" />
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
                        User Name
                    </th>
                    <th>
                        User Email
                    </th>
                    <th>
                        User Group
                    </th>
                    <th>
                        Media title
                    </th>
                    <th style="width:160px">
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['users-detail'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->users_name }}</td>
                        <td>{{ $value->email }}</td>
                        <td>{{ $value->users_group_name }}</td>
                        <td>{{ $value->media_manager_title }}</td>

                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/users-detail/' . $value->id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/users-detail/' . $value->id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/users-detail/' . $value->id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-small btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
                
            </tbody>
        </table>
    </div>
</div>

@endsection