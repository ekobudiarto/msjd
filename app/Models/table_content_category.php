<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_content_category extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_content_category';
    protected $primaryKey = 'content_category_id';

	protected $fillable = ['content_category_title', 'content_category_description', 'media_manager_id'];
}
