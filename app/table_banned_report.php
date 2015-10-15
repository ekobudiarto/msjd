<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_banned_report extends Model
{
    //
    protected $table = 'table_banned_report';

	protected $fillable = ['users_by', 'content_id', 'users_dest', 'banned_report_message'];
}
