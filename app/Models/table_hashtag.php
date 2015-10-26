<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_hashtag extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_hashtag';
    protected $primaryKey = 'hashtag_id';
	protected $fillable = ['hashtag_title'];
}
