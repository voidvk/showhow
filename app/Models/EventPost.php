<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EventPost extends Model
{
    protected $fillable =
        [
            'category_id',
            'creator_id',
            'slug',
            'title',
            'excerpt',
            'content',
            'coordinates',
            'users_count',
            'users_limit',
            'auth_users_ids',
            'event_date',
            'status',
            'messages_ids'
        ];
}
