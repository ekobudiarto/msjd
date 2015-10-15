<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_schedule_type extends Model
{
    //
    protected $table = 'table_schedule_type';

	protected $fillable = ['schedule_type_name', 'schedule_type_desc', 'media_manager_id'];
}
