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
                                    ->orderBy('content_id', 'desc')
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
            'content_type' => DB::select('select content_category_id, content_category_title from table_content_category'),
            'media_manager' => json_encode(DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager')),
            'users_detail' => json_encode(DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail')),
            'content_category' => json_encode(DB::select('select content_category_id as id, content_category_title as value, content_category_title as label from table_content_category')),
            'hashtag' => json_encode(DB::select('select hashtag_id as id, hashtag_title as name from table_hashtag')),
            'content' => json_encode(DB::select('select content_id as id, content_title as value, content_title as label from table_content'))
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
                'media_manager' => DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager'),
                'users_detail' => DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail'),
                'content_category' => DB::select('select content_category_id as id, content_category_title as value, content_category_title as label from table_content_category'),
                'hashtag' => json_encode(DB::select('select hashtag_id as id, hashtag_title as name from table_hashtag')),
                'content_from' => DB::select('select content_id as id, content_title as value, content_title as label from table_content')
         );
        
        //Ambil data nama media manager
        foreach($data['content'] as $key => $value){
            $exp = $value->content_media_id;
            $usrUp = $value->content_users_uploader;
            $usrEdit = $value->content_last_editor;
            $contCat = $value->content_category_id;
            $contFrom = $value->content_repost_from;
            $contHash = $value->hashtag_id;
        }
        $tempExp = explode(",", $exp);
        $i = 0;
        for($i;$i<count($tempExp);$i++){
            //$newArray = DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager where media_manager_id='.$tempExp[$i]);
            $newArray = DB::table('table_media_manager')->select('media_manager_id as id', 'media_manager_title as name')->where('media_manager_id', '=', $tempExp[$i])->first();
            if($newArray != null)
                $dataMediaManager[$newArray->id] = $newArray->name;
        }
        if(isset($dataMediaManager))
            $data['dataMediaManager'] = $dataMediaManager;


        $data['dataIdMediaManager'] = $exp;
        //END Ambil data nama media manager
        
        $tempHash = explode(",", $contHash);
        $i = 0;
        for($i;$i<count($tempHash);$i++){
            //$newArray = DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager where media_manager_id='.$tempExp[$i]);
            $newArray = DB::table('table_hashtag')->select('hashtag_id as id', 'hashtag_title as name')->where('hashtag_id', '=', $tempHash[$i])->first();
            if($newArray != null)
                $dataHashtag[$newArray->id] = $newArray->name;
        }
        if(isset($dataHashtag))
            $data['dataHashtag'] = $dataHashtag;


        $data['dataIdHashtag'] = $contHash;
        
        //Ambil data users_name
        $users_name = DB::table('table_users_detail')->select('users_id as id', 'users_name as value')->where('users_id', '=', $usrUp)->first();
        $users_name2 = DB::table('table_users_detail')->select('users_id as id', 'users_name as value')->where('users_id', '=', $usrEdit)->first();
        
        if($users_name !=null)
            $data['dataUsers'] = $users_name;
        else
            $data['dataUsers'] ='';

        if($users_name2 !=null)
            $data['dataUsers2'] = $users_name2;
        else
            $data['dataUsers2'] ='';
        //END Ambil data users_name
        
        //Ambil data Content Category
        $content_category = DB::table('table_content_category')->select('content_category_id as id', 'content_category_title as value')->where('content_category_id', '=', $contCat)->first();
        if($content_category !=null)
            $data['dataContentCategory'] = $content_category;
        else
            $data['dataContentCategory'] = '';
        //END Ambil data Content Category
        
        $content_from = DB::table('table_content')->select('content_id as id', 'content_title as value')->where('content_id', '=', $contFrom)->first();
        if($content_from != null)
            $data['dataContentFrom'] = $content_from;
        else
            $data['dataContentFrom'] = '';

               
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
                'media_manager' => DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager'),
                'users_detail' => DB::select('select users_id as id, users_name as value, users_name as label from table_users_detail'),
                'content_category' => DB::select('select content_category_id as id, content_category_title as value, content_category_title as label from table_content_category'),
                'hashtag' => json_encode(DB::select('select hashtag_id as id, hashtag_title as name from table_hashtag')),
                'content_from' => DB::select('select content_id as id, content_title as value, content_title as label from table_content')
         );
        
        //Ambil data nama media manager
        foreach($data['content'] as $key => $value){
            $exp = $value->content_media_id;
            $usrUp = $value->content_users_uploader;
            $usrEdit = $value->content_last_editor;
            $contCat = $value->content_category_id;
            $contFrom = $value->content_repost_from;
            $contHash = $value->hashtag_id;
        }
        $tempExp = explode(",", $exp);
        $i = 0;
        for($i;$i<count($tempExp);$i++){
            //$newArray = DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager where media_manager_id='.$tempExp[$i]);
            $newArray = DB::table('table_media_manager')->select('media_manager_id as id', 'media_manager_title as name')->where('media_manager_id', '=', $tempExp[$i])->first();
            if($newArray != null)
                $dataMediaManager[$newArray->id] = $newArray->name;
        }
        if(isset($dataMediaManager))
            $data['dataMediaManager'] = $dataMediaManager;


        $data['dataIdMediaManager'] = $exp;
        //END Ambil data nama media manager
        
        $tempHash = explode(",", $contHash);
        $i = 0;
        for($i;$i<count($tempHash);$i++){
            //$newArray = DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager where media_manager_id='.$tempExp[$i]);
            $newArray = DB::table('table_hashtag')->select('hashtag_id as id', 'hashtag_title as name')->where('hashtag_id', '=', $tempHash[$i])->first();
            if($newArray != null)
                $dataHashtag[$newArray->id] = $newArray->name;
        }
        if(isset($dataHashtag))
            $data['dataHashtag'] = $dataHashtag;


        $data['dataIdHashtag'] = $contHash;
        
        //Ambil data users_name
        $users_name = DB::table('table_users_detail')->select('users_id as id', 'users_name as value')->where('users_id', '=', $usrUp)->first();
        $users_name2 = DB::table('table_users_detail')->select('users_id as id', 'users_name as value')->where('users_id', '=', $usrEdit)->first();
        
        if($users_name !=null)
            $data['dataUsers'] = $users_name;
        else
            $data['dataUsers'] ='';

        if($users_name2 !=null)
            $data['dataUsers2'] = $users_name2;
        else
            $data['dataUsers2'] ='';
        //END Ambil data users_name
        
        //Ambil data Content Category
        $content_category = DB::table('table_content_category')->select('content_category_id as id', 'content_category_title as value')->where('content_category_id', '=', $contCat)->first();
        if($content_category !=null)
            $data['dataContentCategory'] = $content_category;
        else
            $data['dataContentCategory'] = '';
        //END Ambil data Content Category
        
        $content_from = DB::table('table_content')->select('content_id as id', 'content_title as value')->where('content_id', '=', $contFrom)->first();
        if($content_from != null)
            $data['dataContentFrom'] = $content_from;
        else
            $data['dataContentFrom'] = '';

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
