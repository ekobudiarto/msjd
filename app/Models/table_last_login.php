<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_last_login extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_last_login';
    protected $primaryKey = 'last_login_id';
	protected $fillable = ['users_id', 'datetime', 'regional','long','lat'];
}
