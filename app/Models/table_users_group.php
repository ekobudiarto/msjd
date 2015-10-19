<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_users_group extends Model
{
    //
    protected $table = 'table_users_group';

	protected $fillable = ['users_group_name', 'users_group_description'];
}
