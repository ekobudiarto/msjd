<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_notification extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_notification';
    protected $primaryKey = 'notification_id';
	protected $fillable = ['users_id', 'datetime', 'status'];
}
