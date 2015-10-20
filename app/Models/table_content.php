<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class table_content extends Model
{
    //
    public $timestamps = false;
    protected $table = 'table_content';
    protected $primaryKey = 'content_id';
	protected $fillable = ['content_title', 'content_headline', 'content_detail', 'content_media_id', 'content_users_uploader', 'content_last_editor', 'content_date_insert', 'content_date_update', 'content_date_expired', 'content_publish', 'content_category_id', 'content_repost_from'];
}
