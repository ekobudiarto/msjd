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
        {!! Html::link('admin/media-manager/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}
    </div>
    <div class="module-body">
        @include('admin.include.pagination', ['paginator' => $data['media-manager']])
        <div style="float:right;">
        <form action="{{ url("admin/media-manager/search") }}" method="get">
            <select name="select">
                <option value="media_manager_title">Title</option>
                <option value="media_manager_type">Type</option>
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
                        Title
                    </th>
                    <th>
                        Type
                    </th>
                    <th>
                        file
                    </th>
                    <th>
                        Publish
                    </th>
                    <th style="width:160px">
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['media-manager'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td>{{ $value->media_manager_title }}</td>
                        <td>{{ $media = $value->media_manager_type }}</td>
                        <td> 
                        <center>
                            @if($media == 'png' || $media == 'jpeg'|| $media == 'jpg' )
                            <img src="{{url()}}/UPLOADED/{{ $value->media_manager_filename }}" width="100px" />
                            @elseif($media == 'url')
                                <a href="{{ $value->media_manager_filename }}" target="_blank" class="btn btn-info">Go to Resource</a>
                            @else
                                <a href="{{url()}}/UPLOADED/{{ $value->media_manager_filename }}" class="btn btn-success">Download</a>
                            @endif

                            </center>
                        </td>
                        <td>
                            <center>
                                @if( $value->media_manager_publish == 1 )
                                    <b class="label green">Yes</b>
                                @else
                                    <b class="label orange ">No</b>
                                @endif
                            </center>

                        </td>

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