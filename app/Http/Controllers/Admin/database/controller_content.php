<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_content;
use App\Models\table_media_manager;
use DB;
use App\Library\authentication;
use Auth;

class controller_content extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
        authentication::SuperAdminOrAdministrator();      

    }
    
    public function index()
    {
        
        $result = DB::table('table_content as ct')
                                    ->select('ct.*',DB::raw('(select content_category_title from table_content_category where content_category_id = ct.content_category_id) as content_category_title'),
                                             DB::raw('(select content_title from table_content where content_id = ct.content_repost_from) as content_repost')
                                            )
                                    ->paginate(10);

        foreach( $result as $res=>$value ){
             $idsplit = explode(',', $value->content_media_id);
             
             $length = count($idsplit);
             $name = '';
             for($i = 0; $i<$length;$i++){
                $cek = table_media_manager::where('media_manager_id', '=', $idsplit[$i])->first();
                if($cek!= null){
                    $name=$name.$cek->media_manager_title.', ';
                }
             }
             $value->content_media_id = $name;
        }
         $data=array(
            // 'content' => table_content::latest('content_id')->paginate(10),
            'content' => $result
         );


        return view('admin.database.content.content-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       $data=array(
            'content_type' => DB::select('select content_category_id, content_category_title from table_content_category')
         );
       return view('admin.database.content.content-create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        table_content::create(Request::all());
        return redirect('admin/content')->with('success', 'Data saved successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   public function show($id)
    {
        $data = array(
                'content' => table_content::where('content_id', '=', $id)->get(),
         );     
        return view('admin.database.content.content-show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
           
         $data = array(
                'content' => table_content::where('content_id', '=', $id)->get(),
         );     
        return view('admin.database.content.content-edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $dataUpdate = Request::all();
        $data = table_content::find($id);
        $data->update($dataUpdate);
        return redirect('admin/content')->with('message', 'Data successfully changed!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_content::find($id)->delete();
        return redirect('admin/content')->with('warning', 'Data have been removed!');
    
    }
}
