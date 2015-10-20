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
        <b>Media Manager</b>
        <a href="/admin/media-manager/create" class="btn btn-info" style="float:right;">Add Data</a>

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
                        Title
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        Filename
                    </th>
                    <th>
                        Publish
                    </th>
                    <th>
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['media-manager'] as $key => $value)
                    <tr>
                        <td>{{ $value->media_manager_id }}</td>
                        <td>{{ $value->media_manager_title }}</td>
                        <td>{{ $value->media_manager_type }}</td>
                        <td>{{ $value->media_manager_filename }}</td>
                        <td>{{ $value->media_manager_publish }}</td>

                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/media-manager/' . $value->media_manager_id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/media-manager/' . $value->media_manager_id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/media-manager/' . $value->media_manager_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
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