<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_users extends Model
{
    //
    protected $table = 'table_users';

	protected $fillable = ['users_name', 'users_fullname', 'users_password','users_group_id','users_email','users_json_following','users_description','media_manager_id','users_avatar'];
}
