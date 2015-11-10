<?php


namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_schedule_type;
use App\Library\authentication;
use Auth;
use DB;

class controller_schedule_type extends Controller
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
            'schedule-type' => table_schedule_type::latest('schedule_type_id')->paginate(10),
         );


        return view('admin.database.schedule-type.schedule-type-index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data=array(
            'media_manager' => json_encode(DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager')),
         );
        
       return view('admin.database.schedule-type.schedule-type-create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        table_schedule_type::create(Request::all());
        return redirect('admin/schedule-type')->with('success', 'Data saved successfully!');
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
                'schedule-type' => table_schedule_type::where('schedule_type_id', '=', $id)->get(),
         );     
        return view('admin.database.schedule-type.schedule-type-show', compact('data'));
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
                'schedule-type' => table_schedule_type::where('schedule_type_id', '=', $id)->get(),
                'media_manager' => json_encode(DB::select('select media_manager_id as id, media_manager_title as name from table_media_manager')),
         );
         
         //Ambil data schedule
        foreach($data['schedule-type'] as $key => $value){
            $exp = $value->media_manager_id;
        }
        $tempExp = explode(",", $exp);
        $i = 0;
        for($i;$i<count($tempExp);$i++){
            $newArray = DB::table('table_media_manager')->select('media_manager_id as id', 'media_manager_title as name')->where('media_manager_id', '=', $tempExp[$i])->first();
            $dataMediaManager[$newArray->id] = $newArray->name;
        }
        $data['dataMediaManager'] = $dataMediaManager;
        $data['dataIdMediaManager'] = $exp;
        //END Ambil data schedule
         
        return view('admin.database.schedule-type.schedule-type-edit', compact('data'));
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
        $data = table_schedule_type::find($id);
        $data->update($dataUpdate);
        return redirect('admin/schedule-type')->with('message', 'Data successfully changed!');
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        table_schedule_type::find($id)->delete();
        return redirect('admin/schedule-type')->with('warning', 'Data have been removed!');
    
    }
}
