<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_content_category;
use DB;
use App\Models\table_media_manager;
use App\Library\authentication;
use Auth;

class controller_content_category extends Controller
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

         $data=array(
            //'content_category' => table_content_category::latest('content_category_id')->paginate(10),
            'content_category' => DB::table('table_content_category as ct')
                                    ->select('ct.*',DB::raw('(select media_manager_title from table_media_manager where media_manager_id = ct.media_manager_id) as media_manager_title') )
                                    ->paginate(10),
         );


        return view('admin.database.content-category.content-category-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=array(
            'media_manager' => table_media_manager::select('media_manager_id','media_manager_title')->get(),
        );
       return view('admin.database.content-category.content-category-create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        table_content_category::create(Request::all());
        return redirect('admin/content-category')->with('success', 'Data saved successfully!');
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
                'dataContentCategory' => table_content_category::where('content_category_id', '=', $id)->get(),
                'media_manager' => table_media_manager::select('media_manager_id','media_manager_title')->get(),
         );     
        return view('admin.database.content-category.content-category-show', compact('data'));
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
                'dataContentCategory' => table_content_category::where('content_category_id', '=', $id)->get(),
                'media_manager' => table_media_manager::select('media_manager_id','media_manager_title')->get(),
         );     
        return view('admin.database.content-category.content-category-edit', compact('data'));
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
        $data = table_content_category::find($id);
        $data->update($dataUpdate);
        return redirect('admin/content-category')->with('message', 'Data successfully changed!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_content_category::find($id)->delete();
        return redirect('admin/content-category')->with('warning', 'Data have been removed!');
    
    }
}
