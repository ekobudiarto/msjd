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
        <b>Last Login</b>
        {!! Html::link('admin/last-login/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}
    </div>
    <div class="module-body">
        @include('admin.include.pagination', ['paginator' => $data['last_login']])
        <div style="float:right;">
        <form action="{{ url("admin/last-login/search") }}" method="get">
            <select name="select">
                <option value="users_name">user name</option>
                <option value="datetime">datetime</option>
                <option value="regional">Regional</option>
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
                        User
                    </th>
                    <th>
                        Datetime
                    </th>
                    <th>
                        Regional
                    </th>
                    <th>
                        Longitude
                    </th>
                    <th>
                        Latitude
                    </th>
                    <th style="width:160px">
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['last_login'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->users_name }}</td>
                        <td>{{ $value->datetime }}</td>
                        <td>{{ $value->regional }}</td>
						<td>{{ $value->long }}</td>
						<td>{{ $value->lat }}</td>

                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/last-login/' . $value->last_login_id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/last-login/' . $value->last_login_id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/last-login/' . $value->last_login_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
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