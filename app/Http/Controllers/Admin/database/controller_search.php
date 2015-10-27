<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\table_banned_report;
use DB;
use App\Library\authentication;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator;

class controller_search extends Controller
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

    public function getSearchBannedReport()
    {
        $select = input::get('select');
        $query = input::get('query');

        $where = "'".$select."','like','%".$query."%'";
      
        
        // $data=array(
          
        //     'banned_report' => DB::table('table_banned_report as br')
        //                             ->select('br.*',DB::raw('(select users_name from table_users_detail where users_id = br.users_by) as users_name_by'), 
        //                                            DB::raw('(select users_name from table_users_detail where users_id = br.users_dest) as users_name_dest'),
        //                                            DB::raw('(select content_title from table_content where content_id = br.content_id) as content_title') 
        //                                     )
        //                             ->paginate(10),
        //  );
        $query =  DB::select("select * FROM
                            (SELECT `br`.*, 
                            (select users_name from table_users_detail where users_id = br.users_by) as users_name_by, 
                            (select users_name from table_users_detail where users_id = br.users_dest) as users_name_dest, 
                            (select content_title from table_content where content_id = br.content_id) as content_title 
                            from `table_banned_report` as `br` ) as search
                            where ".$select." like '%".$query."%' limit 10 offset 0");

        $data = array(
            'banned_report' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );  

        return view('admin.database.banned-report.banned-report-index', compact('data'));
    }

    
}
