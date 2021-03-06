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
        <b>Users Group</b>
        {!! Html::link('admin/users-group/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}
    </div>
    <div class="module-body">
         @include('admin.include.pagination', ['paginator' => $data['users-group']])
        <div style="float:right;">
        <form action="{{ url("admin/users-group/search") }}" method="get">
            <select name="select">
                <option value="users_group_name">Name</option>
                <option value="users_group_description">Description</option>
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
                        Name
                    </th>
                    <th>
                        Description
                    </th>
                    <th>
                        Is Public
                    </th>
                    <th style="width:160px">
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['users-group'] as $key => $value)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td>{{ $value->users_group_name }}</td>
                        <td>{{ $value->users_group_description }}</td>
                        <td>
                            <center>
                            {!! Form::open(['method' => 'GET', 'url' => 'admin/ispublish/', 'onsubmit' => 'return confirm("Are you sure you want to change publish status for this item?");']) !!}
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <input type="hidden" name="id" value="{{ $value->users_group_id }}">
                                <input type="hidden" name="id_name" value="users_group_id">
                                <input type="hidden" name="table_name" value="table_users_group">
                                <input type="hidden" name="field_name" value="users_group_is_public">
                                <input type="hidden" name="url" value="<?PHP echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>">
                                <input type="hidden" name="values" value="<?PHP if($value->users_group_is_public == 1) echo 0; else echo 1;?>" >
                                
                                @if( $value->users_group_is_public == 1 )
                                    <a href="#" onclick="$(this).closest('form').submit()" ><b class="label green">Yes</b></a>
                                @else
                                    <a href="#" onclick="$(this).closest('form').submit()" ><b class="label orange ">No</b></a>
                                @endif
                            {!! Form::close() !!}
                            </center>
                            
                        </td>
                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/users-group/' . $value->users_group_id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/users-group/' . $value->users_group_id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/users-group/' . $value->users_group_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                    
                @endforeach
               

            </tbody>
        </table>
    </div>
</div>

@endsection