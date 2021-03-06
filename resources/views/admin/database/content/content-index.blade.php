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
        <b>Content</b>
        {!! Html::link('admin/content/create', 'Add Data', array('class' => 'btn btn-info', 'style' => 'float:right;'), false) !!}
    </div>
    <div class="module-body">
        @include('admin.include.pagination', ['paginator' => $data['content']])
        <div style="float:right;">
        <form action="{{ url("admin/content/search") }}" method="get">
            <select name="select">
                <option value="content_title">Content</option>
                <option value="media_manager_title">Media Manager</option>
                <option value="content_category_title">Content Category Title</option>
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
                        Media Manager
                    </th>
                    <th>
                        Publish
                    </th>
                    <th>
                        Category
                    </th>
                    <th>
                        Content Repost From
                    </th>
                    <th style="width:160px">
                        #
                    </th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['content'] as $key => $value)
                    <tr>
                        <td>{{ $key + 1 }}</td>
                        <td><?PHP $one = str_replace('<p>','',$value->content_title); echo str_replace('</p>','',$one); ?></td>
                        <td>{{ $value->content_media_id }}</td>
                        <td>
                            <center>
                            {!! Form::open(['method' => 'GET', 'url' => 'admin/ispublish/', 'onsubmit' => 'return confirm("Are you sure you want to change publish status for this item?");']) !!}
                                <input type="hidden" name="_token" value="{!! csrf_token() !!}">
                                <input type="hidden" name="id" value="{{ $value->content_id }}">
                                <input type="hidden" name="id_name" value="content_id">
                                <input type="hidden" name="table_name" value="table_content">
                                <input type="hidden" name="field_name" value="content_publish">
                                <input type="hidden" name="url" value="<?PHP echo $_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] ?>">
                                <input type="hidden" name="values" value="<?PHP if($value->content_publish == 1) echo 0; else echo 1;?>" >
                                
                                @if( $value->content_publish == 1 )
                                    <a href="#" onclick="$(this).closest('form').submit()" ><b class="label green">Yes</b></a>
                                @else
                                    <a href="#" onclick="$(this).closest('form').submit()" ><b class="label orange ">No</b></a>
                                @endif
                            {!! Form::close() !!}
                            </center>
                        </td>
                        <td>{{ $value->content_category_title }}</td>
                        <td>{{ $value->content_repost }}</td>
                        <!-- untuk menambahkan tombol tampil, edit, dan hapus -->
                        <td>
                            <a class="btn btn-small btn-success" href="{{ URL('admin/content/' . $value->content_id) }}">View</a>

                            <a class="btn btn-small btn-warning" href="{{ URL('admin/content/' . $value->content_id . '/edit') }}">Edit</a>

                            {!! Form::open(['method' => 'DELETE', 'url' => 'admin/content/' . $value->content_id, 'class' => 'pull-right', 'onsubmit' => 'return confirm("Are you sure you want to delete this item?");']) !!}
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