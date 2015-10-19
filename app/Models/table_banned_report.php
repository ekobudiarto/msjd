<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_banned_report extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_banned_report';

	protected $fillable = ['users_by', 'content_id', 'users_dest', 'banned_report_message'];
}
