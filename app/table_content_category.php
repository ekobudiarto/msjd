<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class table_content_category extends Model
{
    //
    protected $table = 'table_content_category';

	protected $fillable = ['content_category_title', 'content_category_description', 'media_manager_id'];
}
