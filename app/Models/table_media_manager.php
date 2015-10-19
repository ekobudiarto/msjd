<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_media_manager extends Model
{
    //
    protected $table = 'table_media_manager';

	protected $fillable = ['media_manager_title', 'media_manager_type', 'media_manager_filename','media_manager_publish'];

}
