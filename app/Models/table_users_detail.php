<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_users_detail extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_users_detail';
    protected $primaryKey = 'users_detail_id';
	protected $fillable = ['users_name', 'users_id', 'users_fullname', 'users_password','users_group_id','users_email','users_json_following','users_description','media_manager_id','users_avatar'];
}
