<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_schedule extends Model
{
    //
    public $timestamps = false;
    protected $primaryKey = 'schedule_id';
    protected $table = 'table_schedule';

	protected $fillable = ['schedule_title', 'schedule_type_id', 'schedule_users_creator','schedule_users_source','schedule_date_start','schedule_date_end','schedule_description','schedule_headline','schedule_media_id','schedule_repeat','schedule_publish'];
}
