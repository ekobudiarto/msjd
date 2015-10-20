<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_schedule_type extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_schedule_type';
    protected $primaryKey = 'schedule_type_id';
	protected $fillable = ['schedule_type_name', 'schedule_type_desc', 'media_manager_id'];
}
