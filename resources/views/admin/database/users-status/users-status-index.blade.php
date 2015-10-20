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
        <a href="/admin/users-status/create" class="btn btn-info" style="float:right;">Add Data</a>

    </div>
    <div class="module-body table">
        <table cellpadding="0" cellspacing="0" border="0" class="datatable-1 table table-bordered table-striped	 display"
            width="100%">
            <thead>
                <tr>
                    <th>
                        users status id
                    </th>
                    <th>
                        users status title
                    </th>
                    <th>
                        users status desc
                    </th>
                    <th>
                        Editor
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['users_status'] as $key => $value)
                    <tr>
                        <td>{{ $value->users_status_id }}</td>
                        <td>{{ $value->users_status_title }}</td>
                        <td>{{ $value->users_status_desc }}</td>

                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/users-status/' . $value->users_status_id) }}">Tampilkan Data</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/users-status/' . $value->users_status_id . '/edit') }}">Ubah Data</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/users-status/' . $value->users_status_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
                                {!! Form::submit('Hapus Data', ['class' => 'btn btn-danger']) !!}
                            {!! Form::close() !!}

                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <th>
                        users status id
                    </th>
                    <th>
                        users status title
                    </th>
                    <th>
                        users status desc
                    </th>
                    <th>
                        Editor
                    </th>
                </tr>
            </tfoot>
        </table>
    </div>
</div>

@endsection