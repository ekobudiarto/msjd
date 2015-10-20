<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_users_status extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_users_status';
    protected $primaryKey = 'users_status_id';

	protected $fillable = ['users_status_id', 'users_status_title', 'users_status_desc'];
}
