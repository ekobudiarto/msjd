<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_content_category;

class controller_content_category extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
         $data=array(
            'content_category' => table_content_category::latest('content_category_id')->get(),
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
       return view('admin.database.content-category.content-category-create');
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
        return redirect('admin/content-category')->with('success', 'Data berhasil ditambahkan!');
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
        return redirect('admin/content-category')->with('message', 'Data berhasil dirubah!');
    
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
        return redirect('admin/content-category')->with('warning', 'Data berhasil dihapus!');
    
    }
}