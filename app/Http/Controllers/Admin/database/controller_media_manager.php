<?php


namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_media_manager;
use App\Library\authentication;
use Auth;
use Validator;

class controller_media_manager extends Controller
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
            'media-manager' => table_media_manager::latest('media_manager_id')->paginate(10),
         );


        return view('admin.database.media-manager.media-manager-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.database.media-manager.media-manager-create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function test()
    {
        echo 'haha';
        die();
    }
    public function store(Request $request)
    {
        
        $title = input::get('media_manager_title');
        $publish = input::get('media_manager_publish');
        $link = input::get('media_manager_link');
        
        if (Input::hasFile('file'))
        {

            $rules = array('file' => 'mimes:pdf,png,jpeg,jpg,bmp,doc,docx,xls,xlsx,csv,mp4,mp3,flv,');
            $validator = Validator::make(input::all(), $rules);
            if ($validator->fails()) {
                return redirect('admin/media-manager')->with('failed', 'file that allowed to upload are pdf, png, jpeg, jpg, bmp, doc, docx, xls, xlsx, csv, mp4, mp3, or flv ');
            }
            else{
                $file     = Input::file('file');
                $filename = date("Y-m-d").'-'.str_random(8).'-'.$file->getClientOriginalName();
                $destinationPath = 'UPLOADED';
                $file->move($destinationPath, $filename);
                $type = $file->getClientOriginalExtension();
                
                $field_media_manager = array(
                    'media_manager_title' => $title,
                    'media_manager_type' => $type,
                    'media_manager_filename' => $filename,
                    'media_manager_publish' => $publish,
                );
                $user = table_media_manager::create($field_media_manager);
            }
   
        }
        elseif($link != ''){
            $field_media_manager = array(
                    'media_manager_title' => $title,
                    'media_manager_type' => 'url',
                    'media_manager_filename' => $link,
                    'media_manager_publish' => $publish,
            );
            $user = table_media_manager::create($field_media_manager);
        }
        else{
            return redirect('admin/media-manager')->with('failed', 'You did not select anything to upload!'); 
        }
        
        return redirect('admin/media-manager')->with('success', 'Data berhasil ditambahkan!');
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
                'media-manager' => table_media_manager::where('media_manager_id', '=', $id)->get(),
         );     
        return view('admin.database.media-manager.media-manager-show', compact('data'));
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
                'media-manager' => table_media_manager::where('media_manager_id', '=', $id)->get(),
         );     
        return view('admin.database.media-manager.media-manager-edit', compact('data'));
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
        $data = table_media_manager::find($id);
        $data->update($dataUpdate);
        return redirect('admin/media-manager')->with('message', 'Data berhasil dirubah!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_media_manager::find($id)->delete();
        return redirect('admin/media-manager')->with('warning', 'Data berhasil dihapus!');
    
    }
}
