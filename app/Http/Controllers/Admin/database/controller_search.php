<?php

namespace App\Http\Controllers\Admin\database;

use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use App\Library\authentication;
use Auth;
use Illuminate\Pagination\LengthAwarePaginator as Paginator;

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
        
        $applicants =  DB::select("select * FROM
                            (SELECT `br`.*, 
                            (select users_name from table_users_detail where users_id = br.users_by) as users_name_by, 
                            (select users_name from table_users_detail where users_id = br.users_dest) as users_name_dest, 
                            (select content_title from table_content where content_id = br.content_id) as content_title 
                            from `table_banned_report` as `br` ) as search
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $pageNumber = Input::get('page', 1);
        $perpage = 4;
        $slice = array_slice($applicants, $perpage * ($pageNumber - 1), $perpage);
        $applicants = new \Illuminate\Pagination\LengthAwarePaginator($slice, count($applicants), $perpage);
        $applicants->setPath('search?select='.$select.'&query='.$query.'%%%');

        $data = array(
            //'banned_report' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2),
            'banned_report'   => $applicants
        );


        return view('admin.database.banned-report.banned-report-index', compact('data'));
    }
    
    public function getSearchContent()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM
                            (SELECT `ct`.*, 
                            (select content_category_title from table_content_category where content_category_id = ct.content_category_id) as content_category_title, 
                            (select media_manager_title from table_media_manager where media_manager_id = ct.content_media_id) as media_manager_title, 
                            (select content_title from table_content where content_repost_from = ct.content_id) as content_repost 
                            from `table_content` as `ct` ) as search
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'content' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.content.content-index', compact('data'));
    }
    
    public function getSearchContentCategory()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM
                            (SELECT `cct`.*, 
                            (select media_manager_title from table_media_manager where media_manager_id = cct.media_manager_id) as media_manager_title
                            from `table_content_category` as `cct` ) as search
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'content_category' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.content-category.content-category-index', compact('data'));
    }
    public function getSearchHashtag()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM `table_hashtag`
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'hashtag' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.hashtag.hashtag-index', compact('data'));
    }
    
    public function getSearchMediaManager()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM `table_media_manager`
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'media-manager' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.media-manager.media-manager-index', compact('data'));
    }
    
    public function getSearchSchedule()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM
                            (SELECT `sch`.*, 
                            (select users_name from table_users_detail where users_id = sch.schedule_users_creator) as users_name_creator, 
                            (select users_name from table_users_detail where users_id = sch.schedule_users_source) as users_name_source,
                            (select schedule_type_name from table_schedule_type where schedule_type_id = sch.schedule_type_id) as schedule_type_name,
                            (select media_manager_title from table_media_manager where media_manager_id = sch.schedule_media_id) as media_manager_title
                            from `table_schedule` as `sch` ) as search
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'schedule' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.schedule.schedule-index', compact('data'));
    }
    
    public function getSearchScheduleType()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM `table_schedule_type`
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'schedule-type' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.schedule-type.schedule-type-index', compact('data'));
    }
    
    public function getSearchUsersGroup()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM `table_users_group`
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'users-group' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.users-group.users-group-index', compact('data'));
    }
    
    public function getSearchUsersStatus()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM `table_users_status`
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'users_status' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.users-status.users-status-index', compact('data'));
    }
    
    public function getSearchUsersDetail()
    {
        $select = input::get('select');
        $query = input::get('query');
        
        $query =  DB::select("select * FROM `table_users_detail`
                            where ".$select." like '%".$query."%' limit 10 offset 0");
        
        $data = array(
            'users-detail' => new \Illuminate\Pagination\LengthAwarePaginator($query, count($query), 2)
        );

        return view('admin.database.users-detail.users-detail-index', compact('data'));
    }
    
}
