<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_request_follow extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_request_follow';
    protected $primaryKey = 'requst_follow_id';
	protected $fillable = ['users_id', 'json_request_follow'];
}
